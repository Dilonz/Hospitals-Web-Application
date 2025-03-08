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

// Get form data
$patient_name = $_POST['name'];
$patient_email = $_POST['email'];
$patient_phone = $_POST['phone'];
$doctor_name = $_POST['doctor'];
$appointment_date = $_POST['date'];
$appointment_time = $_POST['time'];
$additional_info = $_POST['message'];

// Check if the doctor is already booked at the requested time
$sql_check = "SELECT * FROM appointments WHERE doctor_name = '$doctor_name' AND appointment_date = '$appointment_date' AND appointment_time = '$appointment_time'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Doctor is already booked at this time
    echo "Error: The selected doctor is already booked at this time. Please choose a different time or date.";
} else {
    // Insert the appointment into the database
    $sql_insert = "INSERT INTO appointments (patient_name, patient_email, patient_phone, doctor_name, appointment_date, appointment_time, additional_info)
                   VALUES ('$patient_name', '$patient_email', '$patient_phone', '$doctor_name', '$appointment_date', '$appointment_time', '$additional_info')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>