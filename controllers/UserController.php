<!-- controllers/UserController.php -->
<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (strlen($username) < 3 || strlen($username) > 50) {
                $error = "Username must be 3–50 characters.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            } elseif (strlen($password) < 6) {
                $error = "Password must be at least 6 characters.";
            }
            else {
                $result = User::register($username, $email, $password);
                if ($result === true) {
                    header("Location: ?action=login");
                    exit;
                } else {
                    $error = $result;
                }
            }
        }
        include __DIR__ . '/../views/register.php';
    }

    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $userId = User::login($username, $password);
            if ($userId) {
                session_start();
                $_SESSION['user_id'] = $userId;
                header("Location: ?action=category_list");
                exit;
            } else {
                $error = "Invalid credentials.";
            }
        }
        include __DIR__ . '/../views/login.php';
    }

    public static function logout() {
        session_start();
        session_destroy();
        header("Location: ?action=login");
    }
}
?>
