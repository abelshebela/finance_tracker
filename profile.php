<?php
session_start();

include 'includes/db.php';
// Check if the user is logged in
if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];

    $host = "localhost"; // Typically 'localhost'
    $username = "root";
    $password = "";
    $database = "finance_tracker";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Fetch user profile from the database
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    // Close the database connection
    $conn->close();
 ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <?php include 'nav.php';?>
        </header>
    <div class="container mt-3">
        <!-- Display database info of the user -->
        <div class="card mb-4">
            <div class="card-body">
                <?php if ($user) {
                    echo "<p>First Name: " . $user['first_name'] . "</p>";
                    echo "<p>Last Name: " . $user['last_name'] . "</p>";
                    echo "<p>Email: " . $user['email'] . "</p>";
                    echo "<p>Phone Number: " . $user['phone_number'] . "</p>";
                    echo "<p>Address: " . $user['address'] . "</p>";
                    echo "<p>Date of Birth: " . $user['date_of_birth'] . "</p>";
                    echo "<p>Gender: " . $user['gender'] . "</p>";
                } ?>
            </div>
        </div>

        <!-- Change password section -->
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Change Password</h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="current_password">Current Password:</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>
                    <input type="submit" value="Change Password" name="change_password" class="btn btn-primary">
                </form>
            </div>
        </div>

    </div>
    </body>
    </html>

    <?php
    // Process the password change request
    if (isset($_POST['change_password'])) {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        // Verify if the current password matches the one in the database
        $conn = new mysqli($host, $username, $password, $database);
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if (password_verify($currentPassword, $storedPassword)) {
            // Validate the new password and update it in the database
            if ($newPassword === $confirmPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('si', $hashedPassword, $userID);
                $stmt->execute();

                // Display a success message
                echo '<p class="text-success">Password changed successfully.</p>';
            } else {
                // Display an error message if the new passwords don't match
                echo '<p class="text-danger">New passwords do not match.</p>';
            }
        } else {
            // Display an error message if thecurrent password is incorrect
            echo '<p class="text-danger">Incorrect current password.</p>';
        }

        // Close the database connection
        $conn->close();
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>