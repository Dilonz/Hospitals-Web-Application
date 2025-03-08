<?php
$servername = "localhost"; // Database host
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "dilanka"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from database
$sql_users = "SELECT id, username, role FROM users";
$result_users = $conn->query($sql_users);

// Fetch doctors from database
$sql_doctors = "SELECT * FROM doctors";
$result_doctors = $conn->query($sql_doctors);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telemedicine Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            color: #333;
        }

        .nav-container {
            background-color: #4caf9f;
            padding: 15px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .nav ul li {
            margin-right: 20px;
        }

        .nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .content-area {
            padding: 20px;
            background-color: #fff;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #5aa0ad;
            margin-bottom: 20px;
        }

        /* Table Styles */
        .user-table, .doctor-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-table th, .user-table td, .doctor-table th, .doctor-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th, .doctor-table th {
            background-color: #5aa0ad;
            color: white;
        }

        .user-table tr:hover, .doctor-table tr:hover {
            background-color: #f5f5f5;
        }

        .user-table td a, .doctor-table button {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            font-size: 14px;
        }

        .edit-btn, .edit {
            background-color: #5aa0ad;
        }

        .edit-btn:hover, .edit:hover {
            background-color: #5aa0ad;
        }

        .delete-btn, .delete {
            background-color: #f44336;
        }

        .delete-btn:hover, .delete:hover {
            background-color: #e53935;
        }

        .remove {
            background-color: #ff9800;
        }

        .remove:hover {
            background-color: #e68900;
        }

        /* Button Styles */
        button {
            padding: 10px 20px;
            background-color: #5aa0ad;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5aa0ad;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav ul {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav ul li {
                margin: 10px 0;
            }

            .content-area {
                margin: 10px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="nav-container">
        <nav class="nav">
            <ul>
                <li><a href="#" onclick="showSection('Dashboard')"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="#" onclick="showSection('Users')"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="#" onclick="showSection('Doctors')"><i class="fas fa-user-md"></i> Doctors</a></li>
                <li><a href="#" onclick="showSection('Appointments')"><i class="fas fa-calendar-check"></i> Appointments</a></li>
                <li><a href="#" onclick="showSection('Messages')"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="#" onclick="showSection('Reviews')"><i class="fas fa-star"></i> Reviews</a></li>
                <li><a href="#" onclick="showSection('Payments')"><i class="fas fa-credit-card"></i> Payments</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
    </div>
    <div id="content" class="content-area">
        <h2>Dashboard</h2>
        <p>Welcome to the Telemedicine Dashboard. Manage your platform efficiently.</p>
    </div>

    <script>
     
     function showSection(section) {
    const content = document.getElementById("content");
    if (section === "Dashboard") {
        content.innerHTML = `
            <h2>Dashboard</h2>
            <p>Welcome to the Telemedicine Dashboard. Manage your platform efficiently.</p>
        `;
    } else if (section === "Users") {
        // Existing code for Users section
        content.innerHTML = `
        
        <h2>User Management</h2>
<p>Here you can view and manage users for the telemedicine platform.</p>
<table class="user-table">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result_users->num_rows > 0) {
            while($row = $result_users->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>
                        <a href='edit_user.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a>
                        <a href='delete_user.php?id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </tbody>
</table>
<br>
<button onclick="location.href='add_user.php'">Add New User</button>
        `;



    } else if (section === "Doctors") {
        // Existing code for Doctors section
        content.innerHTML = `
            <h2>Doctors List</h2>
            <p>Here you can view and manage doctors for the telemedicine platform.</p>
            <table class="doctor-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Twitter</th>
                        <th>LinkedIn</th>
                        <th>Instagram</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_doctors->num_rows > 0) {
                        while($row = $result_doctors->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['specialty'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td><img src='" . $row['image'] . "' alt='Doctor Image' width='50'></td>";
                            echo "<td>" . $row['twitter'] . "</td>";
                            echo "<td>" . $row['linkedin'] . "</td>";
                            echo "<td>" . $row['instagram'] . "</td>";
                            echo "<td>
                                    <button class='edit' onclick='editDoctor(" . $row['id'] . ")'>Edit</button>
                                    <button class='delete' onclick='deleteDoctor(" . $row['id'] . ")'>Delete</button>
                                    <button class='remove' onclick='removeDoctor(" . $row['id'] . ")'>Remove</button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No doctors found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <button onclick="location.href='add_doctor.php'">Add New Doctor</button>
        `;
    } else if (section === "Appointments") {
        
        
        
        
     // Appointments section
content.innerHTML = `
    <h2 style="color: #4CAF50; font-size: 24px; margin-bottom: 20px;">Appointments</h2>
    <p style="font-size: 16px; color: #555; margin-bottom: 20px;">Here you can view and manage appointments.</p>
    <div style="overflow-x: auto; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #4CAF50; color: white;">
                    <th style="padding: 12px; text-align: left;">ID</th>
                    <th style="padding: 12px; text-align: left;">Patient Name</th>
                    <th style="padding: 12px; text-align: left;">Doctor Name</th>
                    <th style="padding: 12px; text-align: left;">Date</th>
                    <th style="padding: 12px; text-align: left;">Time</th>
                    <th style="padding: 12px; text-align: left;">Additional Info</th>
                    <th style="padding: 12px; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_appointments = "SELECT * FROM appointments";
                $result_appointments = $conn->query($sql_appointments);

                if ($result_appointments->num_rows > 0) {
                    while($row = $result_appointments->fetch_assoc()) {
                        echo "<tr style='border-bottom: 1px solid #ddd;'>";
                        echo "<td style='padding: 12px;'>" . $row['id'] . "</td>";
                        echo "<td style='padding: 12px;'>" . $row['patient_name'] . "</td>";
                        echo "<td style='padding: 12px;'>" . $row['doctor_name'] . "</td>";
                        echo "<td style='padding: 12px;'>" . $row['appointment_date'] . "</td>";
                        echo "<td style='padding: 12px;'>" . $row['appointment_time'] . "</td>";
                        echo "<td style='padding: 12px;'>" . $row['additional_info'] . "</td>";
                        echo "<td style='padding: 12px;'>
                                <button style='padding: 8px 12px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 5px;' onclick='editAppointment(" . $row['id'] . ")'>Edit</button>
                                <button style='padding: 8px 12px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer;' onclick='deleteAppointment(" . $row['id'] . ")'>Delete</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='padding: 12px; text-align: center;'>No appointments found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        `;

    } else if (section === "Payments") {
                fetch('get_payments.php') // Fetch payments data
                    .then(response => response.text())
                    .then(data => {
                        content.innerHTML = `
                            <h2>Payment Management</h2>
                            <p>Here you can view and manage payments for the telemedicine platform.</p>
                            ${data}
                        `;
                    })
                    .catch(error => console.error('Error fetching payments:', error));
            } else {
                content.innerHTML = `<h2>${section} Section</h2>`;
            }
        }




        // Function to handle editing a doctor
        function editDoctor(id) {
            if (confirm('Are you sure you want to edit this doctor?')) {
                window.location.href = 'edit_doctor.php?id=' + id;
            }
        }

        // Function to handle deleting a doctor
        function deleteDoctor(id) {
            if (confirm('Are you sure you want to delete this doctor?')) {
                window.location.href = 'delete_doctor.php?id=' + id;
            }
        }

        // Function to handle removing a doctor
        function removeDoctor(id) {
            if (confirm('Are you sure you want to remove this doctor?')) {
                window.location.href = 'remove_doctor.php?id=' + id;
            }
        }

// Function to handle editing a payment
function editPayment(id) {
            if (confirm('Are you sure you want to edit this payment?')) {
                window.location.href = 'edit_payment.php?id=' + id;
            }
        }

        // Function to handle deleting a payment
        function deletePayment(id) {
            if (confirm('Are you sure you want to delete this payment?')) {
                window.location.href = 'delete_payment.php?id=' + id;
            }
        }


    </script>
</body>

</html>

<?php
// Close the connection
$conn->close();
?>