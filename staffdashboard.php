<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function showSection(section) {
            document.getElementById("content").innerText = section + " Section";
        }
    </script>
</head>

<body>
    <div class="nav-container">
        <nav class="nav">
            <ul>
                <li><a href="#" onclick="showSection('Dashboard')">Dashboard</a></li>
                <li><a href="#" onclick="showSection('Users')">Users</a></li>
                <li><a href="#" onclick="showSection('Doctors')">Doctors</a></li>
                <li><a href="#" onclick="showSection('Messages')">Messages</a></li>
                <li><a href="#" onclick="showSection('Reviews')">Reviews</a></li>
                <li><a href="#" onclick="showSection('Logout')">Logout</a></li>
            </ul>
        </nav>
    </div>
    <div id="content" class="content-area">Dashboard Section</div>
</body>

</html>
