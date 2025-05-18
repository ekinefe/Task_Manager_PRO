<h2>Edit Task</h2>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post">
    Title: <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>"><br>
    Description: <textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea><br>
    Category:
    <select name="category_id">
        <option value="">None</option>
        <?php foreach ($categories as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $task['category_id'] == $c['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    Priority:
    <select name="priority">
        <?php foreach (['low', 'medium', 'high'] as $p): ?>
            <option value="<?= $p ?>" <?= $task['priority'] == $p ? 'selected' : '' ?>><?= ucfirst($p) ?></option>
        <?php endforeach; ?>
    </select><br>
    Due Date: <input type="datetime-local" name="due_date" value="<?= $task['due_date'] ? date('Y-m-d\TH:i', strtotime($task['due_date'])) : '' ?>"><br>
    Status:
    <select name="status">
        <?php foreach (['todo', 'in_progress', 'done'] as $s): ?>
            <option value="<?= $s ?>" <?= $task['status'] == $s ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', $s)) ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Update Task</button>
</form>
