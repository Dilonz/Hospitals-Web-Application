<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dilanka";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Delete doctor from database
$sql = "DELETE FROM doctors WHERE id = $id";
if ($conn->query($sql)) {
    echo "Doctor deleted successfully.";
} else {
    echo "Error deleting doctor: " . $conn->error;
}

$conn->close();
header("Location: index.php");
?>