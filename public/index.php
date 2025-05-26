<!-- public/index.php -->
<?php
session_start();

require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/CategoryController.php';
require_once __DIR__ . '/../controllers/TaskController.php';

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'register':
        UserController::register(); break;
    case 'login':
        UserController::login(); break;
    case 'logout':
        UserController::logout(); break;
    case 'category_list':
        CategoryController::list(); break;
    case 'add_category':
        CategoryController::add(); break;
    case 'tasks':
        TaskController::list(); break;
    case 'add_task':
        TaskController::add(); break;
    case 'edit_task':
        TaskController::edit(); break;
    case 'setStatus':
        TaskController::setStatus(); break;
    case 'delete':
        TaskController::delete(); break;
    case 'search':
        TaskController::search(); break;
    case 'report':
        TaskController::report(); break;
    case 'edit_category':
        CategoryController::edit(); break;
    case 'delete_category':
        CategoryController::delete(); break;
    default:
        include __DIR__ . '/../views/error.php';
}
