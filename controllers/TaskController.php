// ../controller/TaskController.php

<?php
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Category.php';

class TaskController
{
    public function list() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $sortField = $_GET['sort'] ?? 'due_date'; // Default sort
        $sortOrder = $_GET['order'] ?? 'asc';

        $tasks = Task::getByUser($_SESSION['user_id'], $sortField, $sortOrder);

        require_once __DIR__ . '/../views/task_list.php';
    }


    public function add()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $errors = [];
        $categories = Category::getByUser($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description'] ?? '');
            $categoryId = $_POST['category_id'] ?? null;
            $priority = $_POST['priority'] ?? 'medium';
            $dueDate = $_POST['due_date'] ?? null;

            if ($title === '') {
                $errors[] = 'Title is required.';
            }

            if ($dueDate !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}( \d{2}:\d{2}(:\d{2})?)?$/', $dueDate)) {
                $errors[] = 'Invalid due date format.';
            }

            if (empty($errors)) {
                Task::add($_SESSION['user_id'], $title, $description, $categoryId, $priority, $dueDate);
                header('Location: index.php?action=task_list');
                exit;
            }
        }

        require_once __DIR__ . '/../views/add_task.php';
    }

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?action=login");
            exit;
        }
    
        $userId = $_SESSION['user_id'];
        $id = $_GET['id'] ?? null;
        if (!$id) {
            require '../views/error.php';
            return;
        }
    
        $task = Task::getById($id, $userId);
        if (!$task) {
            require '../views/error.php';
            return;
        }
    
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $category_id = $_POST['category_id'] ?? null;
            $priority = $_POST['priority'] ?? 'low';
            $due_date = $_POST['due_date'] ?? null;
            $status = $_POST['status'] ?? 'todo';
    
            if ($title === '') {
                $errors[] = "Title is required.";
            }
    
            if (empty($errors)) {
                Task::update($id, $userId, [
                    'title' => $title,
                    'description' => $description,
                    'category_id' => $category_id,
                    'priority' => $priority,
                    'due_date' => $due_date,
                    'status' => $status
                ]);
                header("Location: ?action=task_list");
                exit;
            }
        }
    
        $categories = Category::getByUser($userId);
        require '../views/edit_task.php';
    }

    public function setStatus() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?action=login");
            exit;
        }
    
        $userId = $_SESSION['user_id'];
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;
    
        if (!$id || !$status) {
            require '../views/error.php';
            return;
        }
    
        Task::setStatus($id, $userId, $status);
        header("Location: ?action=task_list");
        exit;
    }
    
    public function search() {
        $user_id = $_SESSION['user_id'];
        $term = $_GET['term'] ?? '';
        $filters = [
            'category_id' => $_GET['category_id'] ?? null,
            'priority' => $_GET['priority'] ?? null,
            'status' => $_GET['status'] ?? null,
        ];
    
        $categories = Category::getByUser($user_id);
        $results = [];
    
        if (!empty($term)) {
            $results = Task::search($user_id, $term, $filters);
        }
    
        include '../views/search_tasks.php';
    }
    public function report() {
        $user_id = $_SESSION['user_id'];
        $statusCounts = Task::getTaskCountByStatus($user_id);
        $overdueCount = Task::getOverdueTaskCount($user_id);
        $categorySummary = Task::getCategorySummary($user_id);
    
        include '../views/report.php';
    }
    public function delete() {
        $userId = $_SESSION['user_id'] ?? null;
        $id = $_GET['id'] ?? null;
    
        if (!$id || !$userId) {
            header("Location: /tasks");
            exit;
        }
    
        $taskModel = new Task();
        $taskModel->delete($id, $userId);
        header("Location: /tasks");
    }
}
