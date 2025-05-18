<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($email) || empty($password)) {
                $error = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            } else {
                $user = new User();
                $result = $user->register($username, $email, $password);
                if ($result === true) {
                    header("Location: index.php?action=login");
                    exit;
                } else {
                    $error = $result;
                }
            }
        }
        include __DIR__ . '/../views/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $error = "All fields are required.";
            } else {
                $user = new User();
                if ($user->login($username, $password)) {
                    header("Location: index.php?action=category_list");
                    exit;
                } else {
                    $error = "Invalid credentials.";
                }
            }
        }
        include __DIR__ . '/../views/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
    }
}
