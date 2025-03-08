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
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $amount = $_POST['amount'];
    $payment_status = $_POST['payment_status'];
    $transaction_id = $_POST['transaction_id'];

    $sql = "UPDATE payments SET user_id='$user_id', doctor_id='$doctor_id', amount='$amount', 
            payment_status='$payment_status', transaction_id='$transaction_id' WHERE id='$id'";

    if ($conn->query($sql) {
        echo "Payment updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM payments WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
</head>
<body>
    <h2>Edit Payment</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>" required><br><br>

        <label for="doctor_id">Doctor ID:</label>
        <input type="number" id="doctor_id" name="doctor_id" value="<?php echo $row['doctor_id']; ?>" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" step="0.01" id="amount" name="amount" value="<?php echo $row['amount']; ?>" required><br><br>

        <label for="payment_status">Status:</label>
        <select id="payment_status" name="payment_status" required>
            <option value="pending" <?php echo ($row['payment_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="completed" <?php echo ($row['payment_status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
            <option value="failed" <?php echo ($row['payment_status'] == 'failed') ? 'selected' : ''; ?>>Failed</option>
        </select><br><br>

        <label for="transaction_id">Transaction ID:</label>
        <input type="text" id="transaction_id" name="transaction_id" value="<?php echo $row['transaction_id']; ?>" required><br><br>

        <button type="submit">Update Payment</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>