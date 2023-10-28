<?php
session_start(); // Start the PHP session

include '../includes/db.php';

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update the budget
    $budget_id = $_POST["budget_id"];
    $category = $_POST["category"];
    $amount = $_POST["amount"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Update the budget in the database
    $sql = "UPDATE budget SET category = ?, amount = ?, start_date = ?, end_date = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $category, $amount, $start_date, $end_date, $budget_id, $_SESSION['id']);
    if ($stmt->execute()) {
        header("Location: view_budget.php");
        exit;
    }
}

// Check if a budget ID is provided in the query parameter
if (isset($_GET['id'])) {
    $budget_id = $_GET['id'];

    // Retrieve the budget data from the database
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM budget WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $budget_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Budget not found or does not belong to the user
        header("Location: view_budget.php");
        exit;
    }

    $budget = $result->fetch_assoc();
} else {
    // Budget ID not provided in the query parameter
    header("Location: view_budget.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Budget</title>
    <!-- Add CSS links for styling, Bootstrap, and any additional styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include '../includes/nav.php'?>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Edit Budget</h2>
                <form method="POST" action="edit_budget.php">
                    <input type="hidden" name="budget_id" value="<?= $budget['id'] ?>">
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <input type="text" class="form-control" name="category" value="<?= $budget['category'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="text" class="form-control" name="amount" value="<?= $budget['amount'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" class="form-control" name="start_date" value="<?= $budget['start_date'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" class="form-control" name="end_date" value="<?= $budget['end_date'] ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Budget</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
