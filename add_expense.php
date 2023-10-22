<?php
session_start(); // Start the PHP session

if (!isset($_SESSION['id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $date = $_POST["date"];
    $category = $_POST["category"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    // Prepare and execute an SQL statement to insert the expense data
    $sql = "INSERT INTO expense (user_id, date, category, amount, description, created_at) VALUES (?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issds", $user_id, $date, $category, $amount, $description);
    if ($stmt->execute()) {
        // Insertion was successful, redirect to a success page or the dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        // Insertion failed, display an error message
        echo '<p class="error text-center">Expense could not be added.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
    <!-- Add CSS links for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include 'nav.php' ?>
    </header>
    <div class="container">
        <h1>Add Expense</h1>
        <form method="POST" action="add_expense.php">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" name="date" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" name="category" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" step="0.01" class="form-control" name="amount" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Expense</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>