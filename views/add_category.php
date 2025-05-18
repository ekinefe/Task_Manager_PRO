<h2>Add Category</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    Category Name: <input type="text" name="name"><br>
    <button type="submit">Add</button>
</form>
<a href="index.php?action=category_list">Back to Categories</a>
