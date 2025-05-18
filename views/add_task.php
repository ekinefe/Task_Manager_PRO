<h2>Add Task</h2>
<form method="POST">
    <label>Title: <input type="text" name="title" required></label><br>
    <label>Description: <textarea name="description"></textarea></label><br>
    <label>Category:
        <select name="category_id">
            <option value="">None</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Priority:
        <select name="priority">
            <option value="low">Low</option>
            <option value="medium" selected>Medium</option>
            <option value="high">High</option>
        </select>
    </label><br>
    <label>Due Date (optional): <input type="datetime-local" name="due_date"></label><br>
    <button type="submit">Add Task</button>
</form>

<?php if (!empty($errors)): ?>
    <ul style="color: red;">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
