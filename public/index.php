<?php
session_start();
require_once '../config.php';
require_once '../controllers/UserController.php';
require_once '../controllers/CategoryController.php';
require_once '../controllers/TaskController.php';

$action = $_GET['action'] ?? 'login';

switch ($action) {
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
    default:
        require_once '../views/error.php';
        break;
}