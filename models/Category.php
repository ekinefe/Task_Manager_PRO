<?php
require_once __DIR__ . '/../config.php';

class Category {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDO();
    }

    public function add($userId, $name) {
        // Check uniqueness
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE user_id = ? AND name = ?");
        $stmt->execute([$userId, $name]);
        if ($stmt->fetch()) return "Category name already exists.";

        $stmt = $this->pdo->prepare("INSERT INTO categories (user_id, name) VALUES (?, ?)");
        return $stmt->execute([$userId, $name]);
    }

    public function getAllByUser($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    public static function getByUser($userId) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
