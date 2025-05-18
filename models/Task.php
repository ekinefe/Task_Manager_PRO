<?php
require_once __DIR__ . '/../config.php';

class Task
{
    public static function add($userId, $title, $description, $categoryId, $priority, $dueDate) {
        $pdo = getPDO();
        $stmt = $pdo->prepare('INSERT INTO tasks (user_id, category_id, title, description, priority, due_date, status)
                               VALUES (?, ?, ?, ?, ?, ?, "todo")');
        $stmt->execute([
            $userId,
            $categoryId ?: null,
            $title,
            $description ?: null,
            $priority,
            $dueDate ?: null
        ]);
    }

    public static function getByUser($userId, $sortField = 'due_date', $sortOrder = 'asc') {
        $allowedFields = ['title', 'priority', 'due_date', 'status'];
        $allowedOrder = ['asc', 'desc'];
    
        // Sanitize input
        if (!in_array($sortField, $allowedFields)) {
            $sortField = 'due_date';
        }
    
        if (!in_array($sortOrder, $allowedOrder)) {
            $sortOrder = 'asc';
        }
    
        $db = Database::getInstance();
        $stmt = $db->prepare("
            SELECT tasks.*, categories.name AS category_name 
            FROM tasks 
            LEFT JOIN categories ON tasks.category_id = categories.id 
            WHERE tasks.user_id = ? 
            ORDER BY $sortField $sortOrder
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    public static function getById($id, $userId) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $userId, $data) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, category_id = ?, priority = ?, due_date = ?, status = ? WHERE id = ? AND user_id = ?");
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['category_id'] ?: null,
            $data['priority'],
            $data['due_date'] ?: null,
            $data['status'],
            $id,
            $userId
        ]);
    }
    
    public static function setStatus($id, $userId, $status) {
        $pdo = getPDO();
        if ($status === 'done') {
            $stmt = $pdo->prepare("UPDATE tasks SET status = ?, completed_at = NOW() WHERE id = ? AND user_id = ?");
        } else {
            $stmt = $pdo->prepare("UPDATE tasks SET status = ?, completed_at = NULL WHERE id = ? AND user_id = ?");
        }
        return $stmt->execute([$status, $id, $userId]);
    }
    
    public static function search($user_id, $term, $filters = []) {
        $db = Database::getInstance();
        $sql = "SELECT tasks.*, categories.name AS category_name
                FROM tasks
                LEFT JOIN categories ON tasks.category_id = categories.id
                WHERE tasks.user_id = :user_id AND (tasks.title LIKE :term OR tasks.description LIKE :term)";
        
        $params = [
            ':user_id' => $user_id,
            ':term' => '%' . $term . '%',
        ];
    
        if (!empty($filters['category_id'])) {
            $sql .= " AND tasks.category_id = :category_id";
            $params[':category_id'] = $filters['category_id'];
        }
        if (!empty($filters['priority'])) {
            $sql .= " AND tasks.priority = :priority";
            $params[':priority'] = $filters['priority'];
        }
        if (!empty($filters['status'])) {
            $sql .= " AND tasks.status = :status";
            $params[':status'] = $filters['status'];
        }
    
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getTaskCountByStatus($user_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT status, COUNT(*) as count FROM tasks WHERE user_id = :user_id GROUP BY status");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    public static function getOverdueTaskCount($user_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) FROM tasks WHERE user_id = :user_id AND status != 'done' AND due_date < CURDATE()");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchColumn();
    }
    public static function getCategorySummary($user_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("
            SELECT c.name, 
                   COUNT(t.id) AS total, 
                   SUM(CASE WHEN t.status = 'done' THEN 1 ELSE 0 END) AS done
            FROM categories c
            LEFT JOIN tasks t ON c.id = t.category_id AND t.user_id = :user_id
            WHERE c.user_id = :user_id
            GROUP BY c.name
        ");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete($id, $userId) {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :userId");
        return $stmt->execute(['id' => $id, 'userId' => $userId]);
    }
    public function getTasks($userId, $sort = 'due_date') {
        $allowed = ['priority', 'due_date', 'status'];
        $sortColumn = in_array($sort, $allowed) ? $sort : 'due_date';
    
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :userId ORDER BY $sortColumn ASC");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
