<?php
class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = require_once '../config.php';
            $userModel = new User($pdo);
            $userModel->register($_POST['username'], $_POST['email'], $_POST['password']);
            header('Location: ?action=login');
        } else {
            require_once '../views/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = require_once '../config.php';
            $userModel = new User($pdo);
            if ($userModel->login($_POST['username'], $_POST['password'])) {
                $_SESSION['user_id'] = $userModel->login($_POST['username'], $_POST['password']);
                header('Location: ?action=task_list');
            } else {
                echo "Login failed";
            }
        } else {
            require_once '../views/login.php';
        }
    }
}