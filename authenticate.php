<?php
session_start(); // Start a PHP session

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Replace the query with one that retrieves user data based on the provided email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password']; // Assuming 'password' is the column name in your database

        if (password_verify($password, $stored_password)) {
            // User authenticated, store user ID in the session and redirect to the dashboard
            $_SESSION['id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Authentication failed, show an error message
            header("Location: index.php?error=1"); // Redirect to login page with error code
            exit();
        }
    } else {
        // User not found, show an error message
        header("Location: index.php?error=1"); // Redirect to login page with error code
        exit();
    }
}
?>
