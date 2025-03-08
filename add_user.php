<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dilanka";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $conn->real_escape_string($_POST['role']);

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "New user added successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
</head>
<body style="font-family: 'Arial', sans-serif; background-color: #f4f7fa; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px;">
        <h2 style="color: #4CAF50; text-align: center; margin-bottom: 20px;">Add New User</h2>

        <!-- Success Message -->
        <?php if (isset($success_message)): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (isset($error_message)): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <!-- Add User Form -->
        <form method="POST" action="" style="display: flex; flex-direction: column;">
            <label for="username" style="font-weight: bold; margin-bottom: 5px; color: #333;">Username:</label>
            <input type="text" name="username" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 15px; font-size: 14px;">

            <label for="password" style="font-weight: bold; margin-bottom: 5px; color: #333;">Password:</label>
            <input type="password" name="password" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 15px; font-size: 14px;">

            <label for="role" style="font-weight: bold; margin-bottom: 5px; color: #333;">Role:</label>
            <select name="role" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="patient">Patient</option>
            </select>

            <button type="submit" style="background-color: #4CAF50; color: white; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease;">
                Add User
            </button>
        </form>
    </div>
</body>
</html>