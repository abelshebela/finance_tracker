<?php
session_start(); // Start the PHP session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: index.php");
    exit;
}

// User is authenticated; you can display the dashboard content here
?>

<!DOCTYPE html>
<html>
<head>
    <title>Finance Tracker - Dashboard</title>
    <!-- Add CSS links for styling, Bootstrap, and Chart.js (if used) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include 'nav.php'?>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="income-expense-chart">
                    <!-- Chart.js will render the income vs. expenses chart here -->
                </div>
            </div>
            <div class="col-md-6">
                <div id="budget-status-chart">
                    <!-- Chart.js will render the budget status chart here -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Income and Expense Overview</h2>
                <!-- Display income and expense overviews here -->
            </div>
        </div>
    </div>
    <footer>
        <!-- Footer content -->
    </footer>
    <!-- Add JavaScript links for scripting, including Chart.js (if used) -->
</body>
</html>
