<?php
session_start(); // Start the PHP session

include 'includes/db.php';

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to delete the budget
    $budget_id = $_POST["budget_id"];

    // Delete the budget from the database
    $user_id = $_SESSION['id'];
    $sql = "DELETE FROM budget WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $budget_id, $user_id);
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
    <title>Delete Budget</title>
    <!-- Add CSS links for styling, Bootstrap, and any additional styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include 'nav.php'?>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Delete Budget</h2>
                <p>Are you sure you want to delete this budget?</p>
                <p><strong>Category:</strong> <?= $budget['category'] ?></p>
                <p><strong>Amount:</strong> <?= $budget['amount'] ?></p>
                <p><strong>Start Date:</strong> <?= $budget['start_date'] ?></p>
                <p><strong>End Date:</strong> <?= $budget['end_date'] ?></p>
                <form method="POST" action="delete_budget.php">
                    <input type="hidden" name="budget_id" value="<?= $budget['id'] ?>">
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    <a href="view_budget.php" class="btn btn-secondary">No, Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>