<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle user registration form submission
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $full_name = $_POST["full_name"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $picture = $_POST["picture"];
    // Add other registration fields here

    // Insert user data into the database
    $query = "INSERT INTO users (username, email, password, full_name, phone_number, address, gender, picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $username, $email, $password, $full_name, $phone_number, $address, $gender, $picture);

    if ($stmt->execute()) {
        // Registration was successful, display a success message
        echo "Registration successful! You can now <a href='index.php'>login</a>.";
        $stmt->close(); // Close the statement here

        // Redirect to login page upon successful registration
        header("Location: index.php");
        exit();
    } else {
        // Registration failed, display an error message
        echo "Registration failed. Please try again.";
    }
    $stmt->close(); // Close the statement here
}
?>

<!-- HTML registration form -->
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Register</h1>
                <form method="POST" action="registration.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="picture" accept="image/*" placeholder="Profile Picture">
                    </div>
                    <!-- Add other registration fields here -->
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <p>Already have an account? <a href="index.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
