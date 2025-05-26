<!-- views/login.php -->
<h2>🔐 Login</h2>
<form method="POST" style="max-width:400px;">
    <label>Username:</label><br>
    <input name="username" required><br><br>

    <label>Password:</label><br>
    <input name="password" type="password" required><br><br>

    <button type="submit">Login</button>
</form>

<?= isset($error) ? "<p style='color:red'>$error</p>" : '' ?>

<p>Don't have an account? <a href="?action=register">Register here</a></p>
