<!-- views/category_list.php -->
<?php include __DIR__ . '/nav.php'; ?>

<h2>📁 Your Categories</h2>
<ul>
<?php foreach ($categories as $cat): ?>
    <li>
        <?= htmlspecialchars($cat['name']) ?> |
        <a href="?action=edit_category&id=<?= $cat['id'] ?>">✏️ Edit</a> |
        <a href="?action=delete_category&id=<?= $cat['id'] ?>" onclick="return confirm('Delete this category?')">🗑 Delete</a>
    </li>
<?php endforeach; ?>
</ul>

<a href="?action=add_category">➕ Add Category</a>

<?php include __DIR__ . '/nav.php'; ?>
