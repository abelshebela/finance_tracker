<?php
// Database configuration
$host = "localhost"; // Typically 'localhost'
$username = "root";
$password = "";
$database = "finance_tracker";

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to utf8 (if needed)
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
}

// To close the database connection when you're done:
// $conn->close();
?>
