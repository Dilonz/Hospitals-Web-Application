<?php
// search_results.php

// Check if a search query is provided
if (isset($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']);

    // Database connection (replace placeholders with actual values)
    $host = 'localhost';
    $db = 'medinova';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Search doctors, services, and records
        $sql = "SELECT 'Doctor' AS type, name AS title, specialty AS details FROM doctors WHERE name LIKE :query
                UNION
                SELECT 'Service' AS type, name AS title, description AS details FROM services WHERE name LIKE :query
                UNION
                SELECT 'Record' AS type, patient_name AS title, test_results AS details FROM medical_records WHERE patient_name LIKE :query";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':query' => "%$query%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>Search Results for '" . htmlspecialchars($query) . "'</h2>";

        if ($results) {
            echo "<ul>";
            foreach ($results as $result) {
                echo "<li><strong>" . $result['type'] . ":</strong> " . htmlspecialchars($result['title']) . " - " . htmlspecialchars($result['details']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No results found.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Please provide a search query.</p>";
}
?>


