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

// Handle form submission for adding a new doctor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $instagram = $_POST['instagram'];

    $insert_sql = "INSERT INTO doctors (name, specialty, description, image, twitter, linkedin, instagram) VALUES ('$name', '$specialty', '$description', '$image', '$twitter', '$linkedin', '$instagram')";
    if ($conn->query($insert_sql)) {
        echo "Doctor added successfully.";
    } else {
        echo "Error adding doctor: " . $conn->error;
    }
    header("Location: index.php");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Doctor</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-container label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Doctor</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="specialty" class="form-label">Specialty:</label>
                <input type="text" id="specialty" name="specialty" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL:</label>
                <input type="text" id="image" name="image" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter:</label>
                <input type="text" id="twitter" name="twitter" class="form-control">
            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">LinkedIn:</label>
                <input type="text" id="linkedin" name="linkedin" class="form-control">
            </div>
            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram:</label>
                <input type="text" id="instagram" name="instagram" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Doctor</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>