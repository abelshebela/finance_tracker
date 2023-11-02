<?php
$server = "project-phase2.mysql.database.azure.com"; // Your local MySQL server hostname
$username = "projectphase2"; // Your local MySQL server username
$password = "Nedamcoacademy2"; // Your local MySQL server password
$database = "finance-tracker"; // The name of your database


// Create a database connection
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_close($conn);
?>