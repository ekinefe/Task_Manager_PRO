<!-- views/add_category.php -->
<?php include __DIR__ . '/nav.php'; ?>

<h2>➕ Add Category</h2>
<form method="POST" style="max-width:400px;">
    <label>Category Name:</label><br>
    <input name="name" required><br><br>

    <button type="submit">Add Category</button>
</form>

<?= isset($error) ? "<p style='color:red'>$error</p>" : '' ?>

<?php include __DIR__ . '/nav.php'; ?>
