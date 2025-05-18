<?php
// ../public/index.php

require_once '../models/User.php';
require_once '../models/Category.php';
require_once '../models/Task.php';
require_once '../controllers/UserController.php';
require_once '../controllers/CategoryController.php';
require_once '../controllers/TaskController.php';

session_start();

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'home':
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?action=task_list");
            exit;
        } else {
            header("Location: index.php?action=login");
            exit;
        }
        break;

    case 'register':
        (new UserController())->register();
        break;

    case 'login':
        (new UserController())->login();
        break;

    case 'logout':
        (new UserController())->logout();
        break;

    case 'category_list':
        (new CategoryController())->list();
        break;

    case 'add_category':
        (new CategoryController())->add();
        break;

    case 'task_list':
        (new TaskController())->list();
        break;

    case 'add_task':
        (new TaskController())->add();
        break;

    case 'edit':
        (new TaskController())->edit();
        break;

    case 'delete':
        (new TaskController())->delete();
        break;

    case 'setStatus':
        (new TaskController())->setStatus();
        break;

    case 'search':
        (new TaskController())->search();
        break;

    case 'report':
        (new TaskController())->report();
        break;

    default:
        $message = "The page you are looking for doesn't exist.";
        require_once '../views/error.php';
        break;
}
