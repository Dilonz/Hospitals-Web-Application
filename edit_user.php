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

// Fetch user data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the input
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = $conn->real_escape_string($_POST['username']);
    $role = $conn->real_escape_string($_POST['role']);

    // Prepare and execute the SQL query
    $sql = "UPDATE users SET username = '$username', role = '$role' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST" action="">
        Username: <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required><br>
        Role: 
        <select name="role" required>
            <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="staff" <?php if ($row['role'] == 'staff') echo 'selected'; ?>>Staff</option>
            <option value="patient" <?php if ($row['role'] == 'patient') echo 'selected'; ?>>Patient</option>
        </select><br>
        <input type="submit" value="Update User">
    </form>
</body>
</html>