<h2>Search Tasks</h2>
<form method="get" action="index.php">
    <input type="hidden" name="action" value="search">
    <label>Search:</label>
    <input type="text" name="term" value="<?= htmlspecialchars($_GET['term'] ?? '') ?>" required>
    
    <label>Category:</label>
    <select name="category_id">
        <option value="">-- All --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ($_GET['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Priority:</label>
    <select name="priority">
        <option value="">-- All --</option>
        <option value="low" <?= ($_GET['priority'] ?? '') == 'low' ? 'selected' : '' ?>>Low</option>
        <option value="medium" <?= ($_GET['priority'] ?? '') == 'medium' ? 'selected' : '' ?>>Medium</option>
        <option value="high" <?= ($_GET['priority'] ?? '') == 'high' ? 'selected' : '' ?>>High</option>
    </select>

    <label>Status:</label>
    <select name="status">
        <option value="">-- All --</option>
        <option value="todo" <?= ($_GET['status'] ?? '') == 'todo' ? 'selected' : '' ?>>To Do</option>
        <option value="in_progress" <?= ($_GET['status'] ?? '') == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
        <option value="done" <?= ($_GET['status'] ?? '') == 'done' ? 'selected' : '' ?>>Done</option>
    </select>

    <button type="submit">Search</button>
</form>

<?php if (!empty($results)): ?>
    <h3>Search Results</h3>
    <table border="1" style="width:100%; margin-top:15px;">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Priority</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= $task['category_name'] ?? '-' ?></td>
                <td><?= ucfirst($task['priority']) ?></td>
                <td><?= ucfirst($task['status']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif (!empty($_GET['term'])): ?>
    <p>No results found.</p>
<?php endif; ?>
