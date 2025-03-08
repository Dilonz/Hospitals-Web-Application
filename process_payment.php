<?php
// payment_gateway.php

// Database connection
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

// Check if the payment form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set
    if (isset($_POST['name'], $_POST['email'], $_POST['amount'], $_POST['card_number'], $_POST['expiry_date'], $_POST['cvv'])) {
        // Retrieve and sanitize form data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $amount = htmlspecialchars($_POST['amount']);
        $card_number = htmlspecialchars($_POST['card_number']);
        $expiry_date = htmlspecialchars($_POST['expiry_date']);
        $cvv = htmlspecialchars($_POST['cvv']);

        // Placeholder for payment processing (e.g., integration with a payment gateway like Stripe or PayPal)
        $payment_status = true; // Simulate successful payment for now

        // Insert payment data into the database
        if ($payment_status) {
            $status = 'success';
        } else {
            $status = 'failed';
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO payments (name, email, amount, card_number, expiry_date, cvv, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdssss", $name, $email, $amount, $card_number, $expiry_date, $cvv, $status);

        if ($stmt->execute()) {
            if ($payment_status) {
                echo "<h2>Payment Successful</h2>";
                echo "<p>Thank you, " . htmlspecialchars($name) . ". Your payment of $" . htmlspecialchars($amount) . " has been processed successfully.</p>";
                // Add "Back to Home" button
                echo "<a href='index.html' class='btn btn-primary'>Back to Home</a>";
            } else {
                echo "<h2>Payment Failed</h2>";
                echo "<p>There was an error processing your payment. Please try again later.</p>";
                // Add "Back to Home" button
                echo "<a href='index.html' class='btn btn-primary'>Back to Home</a>";
            }
        } else {
            echo "<h2>Database Error</h2>";
            echo "<p>Error: " . $stmt->error . "</p>";
            // Add "Back to Home" button
            echo "<a href='index.html' class='btn btn-primary'>Back to Home</a>";
        }

        $stmt->close();
    } else {
        echo "<h2>Form Error</h2>";
        echo "<p>All fields are required. Please fill out the form completely.</p>";
        // Add "Back to Home" button
        echo "<a href='index.html' class='btn btn-primary'>Back to Home</a>";
    }
} else {
    echo "<h2>Online Payment</h2>";
    echo "<form action='payment_gateway.php' method='post'>
        <label for='name'>Name</label>
        <input type='text' id='name' name='name' placeholder='Your Name' required>

        <label for='email'>Email</label>
        <input type='email' id='email' name='email' placeholder='Your Email' required>

        <label for='amount'>Amount</label>
        <input type='number' id='amount' name='amount' placeholder='Enter Amount' required>

        <label for='card_number'>Card Number</label>
        <input type='text' id='card_number' name='card_number' placeholder='Enter Card Number' required>

        <label for='expiry_date'>Expiry Date</label>
        <input type='text' id='expiry_date' name='expiry_date' placeholder='MM/YY' required>

        <label for='cvv'>CVV</label>
        <input type='text' id='cvv' name='cvv' placeholder='CVV' required>

        <button type='submit'>Pay Now</button>
    </form>";
}

// Close the database connection
$conn->close();
?>