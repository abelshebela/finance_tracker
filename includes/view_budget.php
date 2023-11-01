<?php
session_start(); // Start the PHP session

include '../includes/db.php';

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: index.php");
    exit;
}

// User is authenticated; you can display the dashboard content here

// Retrieve the user's budgets from the database
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM budget WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch and display the budgets
$budgets = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Finance Tracker - View Budgets</title>
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
                <h2 class="mt-5">View Budgets</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($budgets as $budget) : ?>
                            <tr>
                                <td><?= $budget['category'] ?></td>
                                <td><?= $budget['amount'] ?></td>
                                <td><?= $budget['start_date'] ?></td>
                                <td><?= $budget['end_date'] ?></td>
                                <td>
                                    <a href="edit_budget.php?id=<?= $budget['id'] ?>" class="btn btn-primary">Edit</a>
                                    <a href="delete_budget.php?id=<?= $budget['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

