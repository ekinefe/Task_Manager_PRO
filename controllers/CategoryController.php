<!-- controller/CategoryController. -->
<?php
require_once __DIR__ . '/../models/Category.php';

class CategoryController {
    public static function list() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?action=login");
            exit;
        }
        $categories = Category::getAll($_SESSION['user_id']);
        include __DIR__ . '/../views/category_list.php';
    }

    public static function add() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?action=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            if (strlen($name) < 3) {
                $error = "Category name too short.";
            } else {
                $result = Category::add($_SESSION['user_id'], $name);
                if ($result === true) {
                    header("Location: ?action=category_list");
                    exit;
                } else {
                    $error = $result;
                }
            }
        }

        include __DIR__ . '/../views/add_category.php';
    }
    public static function edit() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?action=login");
        exit;
    }

    $category = Category::getById($_GET['id'], $_SESSION['user_id']);
    if (!$category) {
        echo "Category not found or access denied.";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        if (strlen($name) < 3) {
            $error = "Category name must be at least 3 characters.";
        } else {
            Category::update($_GET['id'], $_SESSION['user_id'], $name);
            header("Location: ?action=category_list");
            exit;
        }
    }

    include __DIR__ . '/../views/edit_category.php';
}

public static function delete() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?action=login");
        exit;
    }

    if (isset($_GET['id'])) {
        Category::delete($_GET['id'], $_SESSION['user_id']);
    }
    header("Location: ?action=category_list");
}

}
?>
