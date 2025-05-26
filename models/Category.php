<!-- models/Category -->
<?php
require_once __DIR__ . '/../config.php';

class Category {
    public static function add($userId, $name) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE user_id = ? AND name = ?");
        $stmt->execute([$userId, $name]);
        if ($stmt->fetchColumn() > 0) return "Category already exists.";

        $stmt = $pdo->prepare("INSERT INTO categories (user_id, name) VALUES (?, ?)");
        $stmt->execute([$userId, $name]);
        return true;
    }

    public static function getAll($userId) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    public static function getById($id, $userId) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $userId]);
    return $stmt->fetch();
}

public static function update($id, $userId, $name) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("
        UPDATE categories SET name = :name 
        WHERE id = :id AND user_id = :user_id
    ");
    $stmt->execute([
        'name' => $name,
        'id' => $id,
        'user_id' => $userId
    ]);
}

public static function delete($id, $userId) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $userId]);
}

}
?>
