<!-- models/TAsk.php -->
<?php
require_once __DIR__ . '/../config.php';

class Task {
    public static function add($userId, $data) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO tasks 
            (user_id, category_id, title, description, priority, due_date, status)
            VALUES (:user_id, :category_id, :title, :description, :priority, :due_date, 'todo')");

        $stmt->execute([
            'user_id' => $userId,
            'category_id' => $data['category_id'] ?: null,
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $data['priority'],
            'due_date' => $data['due_date'] ?: null
        ]);
    }

    public static function getAll($userId) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("
            SELECT tasks.*, categories.name AS category_name
            FROM tasks
            LEFT JOIN categories ON tasks.category_id = categories.id
            WHERE tasks.user_id = ?
            ORDER BY tasks.created_at DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    public static function getById($id, $userId) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $userId]);
    return $stmt->fetch();
    }

    public static function update($id, $userId, $data) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("
            UPDATE tasks SET 
                title = :title,
                description = :description,
                category_id = :category_id,
                priority = :priority,
                due_date = :due_date,
                status = :status
            WHERE id = :id AND user_id = :user_id
        ");
        $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'category_id' => $data['category_id'] ?: null,
            'priority' => $data['priority'],
            'due_date' => $data['due_date'] ?: null,
            'status' => $data['status'],
            'id' => $id,
            'user_id' => $userId
        ]);
    }

    public static function setStatus($id, $userId, $status) {
        $pdo = getPDO();
        $completedAt = $status === 'done' ? date('Y-m-d H:i:s') : null;
        $stmt = $pdo->prepare("
            UPDATE tasks 
            SET status = :status, completed_at = :completed_at 
            WHERE id = :id AND user_id = :user_id
        ");
        $stmt->execute([
            'status' => $status,
            'completed_at' => $completedAt,
            'id' => $id,
            'user_id' => $userId
        ]);
    }

public static function search($userId, $filters) {
    $pdo = getPDO();
    $sql = "
        SELECT tasks.*, categories.name AS category_name 
        FROM tasks 
        LEFT JOIN categories ON tasks.category_id = categories.id 
        WHERE tasks.user_id = :user_id
    ";

    $params = ['user_id' => $userId];

    if (!empty($filters['term'])) {
        $sql .= " AND (tasks.title LIKE :term1 OR tasks.description LIKE :term2)";
        $params['term1'] = '%' . $filters['term'] . '%';
        $params['term2'] = '%' . $filters['term'] . '%';
    }
    if (!empty($filters['category_id'])) {
        $sql .= " AND tasks.category_id = :category_id";
        $params['category_id'] = $filters['category_id'];
    }
    if (!empty($filters['priority'])) {
        $sql .= " AND tasks.priority = :priority";
        $params['priority'] = $filters['priority'];
    }
    if (!empty($filters['status'])) {
        $sql .= " AND tasks.status = :status";
        $params['status'] = $filters['status'];
    }

    $sql .= " ORDER BY tasks.created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}



public static function countByStatus($userId) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("
        SELECT status, COUNT(*) as count 
        FROM tasks 
        WHERE user_id = ? 
        GROUP BY status
    ");
    $stmt->execute([$userId]);
    $data = [];
    foreach ($stmt->fetchAll() as $row) {
        $data[$row['status']] = $row['count'];
    }
    return $data;
}

public static function countOverdue($userId) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM tasks 
        WHERE user_id = ? AND due_date IS NOT NULL AND due_date < NOW() AND status != 'done'
    ");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

public static function categorySummary($userId) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("
        SELECT c.name, COUNT(t.id) as total, 
               SUM(CASE WHEN t.status = 'done' THEN 1 ELSE 0 END) as completed
        FROM categories c
        LEFT JOIN tasks t ON c.id = t.category_id
        WHERE c.user_id = ?
        GROUP BY c.id
    ");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}
public static function delete($id, $userId) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $userId]);
}


}
?>
