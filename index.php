<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle user login form submission
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Replace this with code to retrieve user data from the database based on the provided email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password']; // Assuming 'password' is the column name in your database

        if (password_verify($password, $stored_password)) {
            // User authenticated, redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Authentication failed, show an error message
            echo '<p class="error text-center">Authentication failed. Please check your username and password.</p>';
        }
    } else {
        // User not found, show an error message
        echo '<p class="error text-center">User not found.</p>';
    }
}

?>

<!-- HTML login form -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Login</h1>
                <form method="POST" action="index.php">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <p>Don't have an account? <a href="registration.php">Register</a></p>
            </div>
        </div>
    </div>
</body>
</html>
