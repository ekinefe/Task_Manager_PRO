<!-- views/register.php -->
<?php include __DIR__ . '/nav.php'; ?>

<h2>🧾 Register</h2>
<form method="POST" style="max-width:400px;">
    <label>Username:</label><br>
    <input name="username" required><br><br>

    <label>Email:</label><br>
    <input name="email" type="email" required><br><br>

    <label>Password:</label><br>
    <input name="password" type="password" required><br><br>

    <button type="submit">Register</button>
</form>

<?= isset($error) ? "<p style='color:red'>$error</p>" : '' ?>
