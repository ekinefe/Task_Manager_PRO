<!-- views/search_tasks.php -->
 <?php include __DIR__ . '/nav.php'; ?>

<h2>🔍 Search Tasks</h2>
<form method="POST" style="max-width:500px;">
    <label>Search Term:</label><br>
    <input name="term" value="<?= htmlspecialchars($_POST['term'] ?? '') ?>"><br><br>

    <label>Category:</label><br>
    <select name="category_id">
        <option value="">-- Any --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ($_POST['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Priority:</label><br>
    <select name="priority">
        <option value="">-- Any --</option>
        <?php foreach (['low', 'medium', 'high'] as $p): ?>
            <option value="<?= $p ?>" <?= ($_POST['priority'] ?? '') == $p ? 'selected' : '' ?>><?= ucfirst($p) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="">-- Any --</option>
        <?php foreach (['todo', 'in_progress', 'done'] as $s): ?>
            <option value="<?= $s ?>" <?= ($_POST['status'] ?? '') == $s ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', $s)) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Search</button>
</form>

<?php if (!empty($results)): ?>
    <h3>Results</h3>
    <ul>
    <?php foreach ($results as $task): ?>
        <li>
            <strong><?= htmlspecialchars($task['title']) ?></strong><br>
            <?= $task['description'] ? htmlspecialchars($task['description']) . "<br>" : '' ?>
            Category: <?= htmlspecialchars($task['category_name'] ?? 'None') ?><br>
            Priority: <?= htmlspecialchars($task['priority']) ?><br>
            Status: <?= htmlspecialchars($task['status']) ?><br>
            Due: <?= $task['due_date'] ?: 'N/A' ?><br>
            <hr>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include __DIR__ . '/nav.php'; ?>
