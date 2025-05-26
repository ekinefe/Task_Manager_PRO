<!-- public/install_data.php -->
<?php
require_once '../config.php';

$pdo = getPDO();

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute(['testuser']);
$user = $stmt->fetch();

if ($user) {
    echo "✅ Test user already exists. Skipping data insertion.";
    exit;
}

$username = 'testuser';
$password = password_hash('123456', PASSWORD_DEFAULT);
$email = 'test@example.com';

$pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)")
    ->execute([$username, $password, $email]);

$userId = $pdo->lastInsertId();

$cat1 = 'Work';
$cat2 = 'Personal';

$stmt = $pdo->prepare("INSERT INTO categories (user_id, name) VALUES (?, ?)");
$stmt->execute([$userId, $cat1]);
$cat1Id = $pdo->lastInsertId();

$stmt->execute([$userId, $cat2]);
$cat2Id = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO tasks (user_id, category_id, title, description, priority, due_date, status) 
VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->execute([$userId, $cat1Id, 'Finish report', 'Complete by Friday', 'high', '2025-04-10 17:00:00', 'in_progress']);
$stmt->execute([$userId, $cat2Id, 'Buy groceries', 'Milk, eggs, bread', 'medium', null, 'todo']);
$stmt->execute([$userId, null, 'Meditate', '10 minutes of mindfulness', 'low', null, 'done']);

echo "✅ Test data inserted successfully!";
