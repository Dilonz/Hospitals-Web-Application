<?php
session_start(); // Start the session (if needed)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="authenticate.php" method="POST"> <!-- Replace with your authentication script -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>