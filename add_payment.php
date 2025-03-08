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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $amount = $_POST['amount'];
    $payment_status = $_POST['payment_status'];
    $transaction_id = $_POST['transaction_id'];

    $sql = "INSERT INTO payments (user_id, doctor_id, amount, payment_date, payment_status, transaction_id)
            VALUES ('$user_id', '$doctor_id', '$amount', NOW(), '$payment_status', '$transaction_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment</title>
</head>
<body>
    <h2>Add New Payment</h2>
    <form method="POST">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="doctor_id">Doctor ID:</label>
        <input type="number" id="doctor_id" name="doctor_id" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" step="0.01" id="amount" name="amount" required><br><br>

        <label for="payment_status">Status:</label>
        <select id="payment_status" name="payment_status" required>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="failed">Failed</option>
        </select><br><br>

        <label for="transaction_id">Transaction ID:</label>
        <input type="text" id="transaction_id" name="transaction_id" required><br><br>

        <button type="submit">Add Payment</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>