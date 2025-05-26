<!-- controller/TaskController.php -->

<?php
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Category.php';

class TaskController {
    public static function list() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?action=login");
        exit;
    }

    $sort = $_GET['sort'] ?? 'created_at';
    $validSorts = ['priority', 'due_date', 'status', 'created_at'];
    if (!in_array($sort, $validSorts)) $sort = 'created_at';

    $pdo = getPDO();
    $stmt = $pdo->prepare("
        SELECT tasks.*, categories.name AS category_name 
        FROM tasks 
        LEFT JOIN categories ON tasks.category_id = categories.id 
        WHERE tasks.user_id = ?
        ORDER BY $sort DESC
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $tasks = $stmt->fetchAll();

    include __DIR__ . '/../views/task_list.php';
}


    public static function add() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?action=login");
            exit;
        }

        $categories = Category::getAll($_SESSION['user_id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $category_id = $_POST['category_id'] ?: null;
            $priority = $_POST['priority'];
            $due_date = $_POST['due_date'] ?: null;

            if (strlen($title) < 3) {
                $error = "Title must be at least 3 characters.";
            } else {
                Task::add($_SESSION['user_id'], [
                    'title' => $title,
                    'description' => $description,
                    'category_id' => $category_id,
                    'priority' => $priority,
                    'due_date' => $due_date
                ]);
                header("Location: ?action=tasks");
                exit;
            }
        }

        include __DIR__ . '/../views/add_task.php';
    }
    public static function edit() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?action=login");
        exit;
    }

    $task = Task::getById($_GET['id'], $_SESSION['user_id']);
    if (!$task) {
        echo "Task not found or access denied.";
        return;
    }

    $categories = Category::getAll($_SESSION['user_id']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $category_id = $_POST['category_id'] ?: null;
        $priority = $_POST['priority'];
        $due_date = $_POST['due_date'] ?: null;
        $status = $_POST['status'];

        if (strlen($title) < 3) {
            $error = "Title must be at least 3 characters.";
        } else {
            Task::update($_GET['id'], $_SESSION['user_id'], [
                'title' => $title,
                'description' => $description,
                'category_id' => $category_id,
                'priority' => $priority,
                'due_date' => $due_date,
                'status' => $status
            ]);
            header("Location: ?action=tasks");
            exit;
        }
    }

    include __DIR__ . '/../views/edit_task.php';
}

public static function setStatus() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?action=login");
        exit;
    }

    $id = $_GET['id'];
    $status = $_GET['status'];
    if (in_array($status, ['todo', 'in_progress', 'done'])) {
        Task::setStatus($id, $_SESSION['user_id'], $status);
    }

    header("Location: ?action=tasks");
}

public static function search() {
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    if (!isset($_SESSION['user_id'])) {
        header("Location: ?action=login");
        exit;
    }

    $categories = Category::getAll($_SESSION['user_id']);
    $results = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filters = [
        'term' => trim($_POST['term'] ?? ''),
        'category_id' => $_POST['category_id'] ?? null,
        'priority' => $_POST['priority'] ?? null,
        'status' => $_POST['status'] ?? null
    ];

    if (!empty($filters['term'])) {
        $results = Task::search($_SESSION['user_id'], $filters);
    } else {
        header("Location: ?action=tasks");
        exit;
    }
}


    include __DIR__ . '/../views/search_tasks.php';
}
public static function report() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?action=login");
        exit;
    }

    $statusCounts = Task::countByStatus($_SESSION['user_id']);
    $overdue = Task::countOverdue($_SESSION['user_id']);
    $categorySummary = Task::categorySummary($_SESSION['user_id']);

    include __DIR__ . '/../views/report.php';
}
public static function delete() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?action=login");
        exit;
    }

    $id = $_GET['id'];
    Task::delete($id, $_SESSION['user_id']);
    header("Location: ?action=tasks");
}


}
?>
