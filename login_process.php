<?php
// Include database connection
require_once 'db_config.php'; // Ensure this file contains your DB connection

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check user credentials
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password (if using password_hash, use password_verify here)
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch ($user['role']) {
                case 'admin':
                    header("Location: dashboard.php");
                    break;
                case 'staff':
                    header("Location: staffdashboard.php");
                    break;
                case 'patient':
                    header("Location: patientdashboard.php");
                    break;
                default:
                    echo "Invalid role!";
                    exit();
            }
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
    $conn->close();
}
?>
