
<?php
session_start(); // Start the PHP session

include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: index.php");
    exit;
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Now, fetch user-specific income data (you will need to adjust the SQL query)
//$sql_income = "SELECT * FROM income WHERE user_id = $user_id";
//$result_income = mysqli_query($conn, $sql_income);

// Fetch user-specific expense data
//$sql_expense = "SELECT * FROM expense WHERE user_id = $user_id";
//$result_expense = mysqli_query($conn, $sql_expense);
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
