<!-- views/edit_task.php -->
<?php include __DIR__ . '/nav.php'; ?>

<h2>✏️ Edit Task</h2>
<form method="POST" style="max-width:500px;">
    <label>Title:</label><br>
    <input name="title" value="<?= htmlspecialchars($task['title']) ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="3"><?= htmlspecialchars($task['description']) ?></textarea><br><br>

    <label>Category:</label><br>
    <select name="category_id">
        <option value="">-- None --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $task['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Priority:</label><br>
    <select name="priority">
        <?php foreach (['low', 'medium', 'high'] as $p): ?>
            <option value="<?= $p ?>" <?= $task['priority'] == $p ? 'selected' : '' ?>><?= ucfirst($p) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Due Date:</label><br>
    <input type="datetime-local" name="due_date" value="<?= $task['due_date'] ? date('Y-m-d\TH:i', strtotime($task['due_date'])) : '' ?>"><br><br>

    <label>Status:</label><br>
    <select name="status">
        <?php foreach (['todo', 'in_progress', 'done'] as $s): ?>
            <option value="<?= $s ?>" <?= $task['status'] == $s ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', $s)) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Save Changes</button>
</form>

<?= isset($error) ? "<p style='color:red'>$error</p>" : '' ?>

<?php include __DIR__ . '/nav.php'; ?>
