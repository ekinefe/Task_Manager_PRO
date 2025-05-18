<?php
require_once __DIR__ . '/../models/Category.php';

class CategoryController {
    public function list() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $category = new Category();
        $categories = $category->getAllByUser($_SESSION['user_id']);
        include __DIR__ . '/../views/category_list.php';
    }

    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            if (empty($name)) {
                $error = "Category name is required.";
            } else {
                $category = new Category();
                $result = $category->add($_SESSION['user_id'], $name);
                if ($result === true) {
                    header("Location: index.php?action=category_list");
                    exit;
                } else {
                    $error = $result;
                }
            }
        }
        include __DIR__ . '/../views/add_category.php';
    }
}
