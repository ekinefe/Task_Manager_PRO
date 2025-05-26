<!-- views/add_task.php -->
<?php include __DIR__ . '/nav.php'; ?>

<h2>➕ Add Task</h2>
<form method="POST" style="max-width:500px;">
    <label>Title:</label><br>
    <input name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="3"></textarea><br><br>

    <label>Category:</label><br>
    <select name="category_id">
        <option value="">-- None --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Priority:</label><br>
    <select name="priority">
        <option value="low">Low</option>
        <option value="medium" selected>Medium</option>
        <option value="high">High</option>
    </select><br><br>

    <label>Due Date:</label><br>
    <input name="due_date" type="datetime-local"><br><br>

    <button type="submit">Create Task</button>
</form>

<?= isset($error) ? "<p style='color:red'>$error</p>" : '' ?>

<?php include __DIR__ . '/nav.php'; ?>
