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

// Fetch doctor details
$sql = "SELECT * FROM doctors WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Handle form submission for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];
    $instagram = $_POST['instagram'];

    $update_sql = "UPDATE doctors SET name='$name', specialty='$specialty', description='$description', image='$image', twitter='$twitter', linkedin='$linkedin', instagram='$instagram' WHERE id=$id";
    if ($conn->query($update_sql)) {
        echo "Doctor updated successfully.";
    } else {
        echo "Error updating doctor: " . $conn->error;
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
    <title>Edit Doctor</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #007bff; /* Blue heading */
            font-weight: bold;
        }
        .form-container label {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #007bff; /* Blue button */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Doctor</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="specialty">Specialty:</label>
                <input type="text" id="specialty" name="specialty" value="<?php echo $row['specialty']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image">Image URL:</label>
                <input type="text" id="image" name="image" value="<?php echo $row['image']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="twitter">Twitter:</label>
                <input type="text" id="twitter" name="twitter" value="<?php echo $row['twitter']; ?>">
            </div>
            <div class="mb-3">
                <label for="linkedin">LinkedIn:</label>
                <input type="text" id="linkedin" name="linkedin" value="<?php echo $row['linkedin']; ?>">
            </div>
            <div class="mb-3">
                <label for="instagram">Instagram:</label>
                <input type="text" id="instagram" name="instagram" value="<?php echo $row['instagram']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>