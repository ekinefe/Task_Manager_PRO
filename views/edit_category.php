<!-- views/edit_catagroy.php -->
<?php include __DIR__ . '/nav.php'; ?>

<h2>✏️ Edit Category</h2>
<form method="POST" style="max-width:400px;">
    <label>Category Name:</label><br>
    <input name="name" value="<?= htmlspecialchars($category['name']) ?>" required><br><br>

    <button type="submit">Save</button>
</form>

<?= isset($error) ? "<p style='color:red'>$error</p>" : '' ?>
