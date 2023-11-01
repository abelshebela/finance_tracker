<?php
$server = "DESKTOP-55K5Q8Q"; // Your local MySQL server hostname
$username = "abbk"; // Your local MySQL server username
$password = "abbk@2023"; // Your local MySQL server password
$database = "finance_tracker"; // The name of your database


// Create a database connection
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully. It works!";
}
?>