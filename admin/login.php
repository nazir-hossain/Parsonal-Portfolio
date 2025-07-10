<?php
// Start session to handle user authentication
session_start();

// If the user is already logged in, redirect to dashboard
if (!empty($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="login-box">
        <h2>Admin Panel Login</h2>

        <?php
        // Show error message if login fails
        if (isset($_GET['error'])) {
            echo '<p class="error-text">Username or password is incorrect.</p>';
        }
        ?>

        <form action="auth.php" method="post">
            <div class="input-group">
                <label for="user">Username:</label>
                <input type="text" id="user" name="username" required>
            </div>

            <div class="input-group">
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="password" required>
            </div>

            <div class="button-group">
                <button type="submit">Log In</button>
            </div>
        </form>
    </main>
</body>
</html>