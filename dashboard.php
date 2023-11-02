<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['id'];

// SQL Query to Calculate Total Income
$incomeQuery = "SELECT SUM(amount) AS total_income FROM income WHERE user_id = $user_id";
$incomeResult = mysqli_query($conn, $incomeQuery);
$incomeData = mysqli_fetch_assoc($incomeResult);
$totalIncome = $incomeData['total_income'];

// SQL Query to Calculate Total Expenses
$expenseQuery = "SELECT SUM(amount) AS total_expenses FROM expense WHERE user_id = $user_id";
$expenseResult = mysqli_query($conn, $expenseQuery);
$expenseData = mysqli_fetch_assoc($expenseResult);
$totalExpenses = $expenseData['total_expenses'];

// SQL Query to Calculate Total Budget
$budgetQuery = "SELECT SUM(amount) AS total_budget FROM budget WHERE user_id = $user_id";
$budgetResult = mysqli_query($conn, $budgetQuery);
$budgetData = mysqli_fetch_assoc($budgetResult);
$totalBudget = $budgetData['total_budget'];

// SQL Query to Get Expense Categories and Total Expenses
$expenseCategoriesQuery = "SELECT category, SUM(amount) AS total_expense FROM expense WHERE user_id = $user_id GROUP BY category";
$expenseCategoriesResult = mysqli_query($conn, $expenseCategoriesQuery);

// Initialize arrays to store labels and data for the pie chart
$expenseCategoriesLabels = [];
$expenseCategoriesData = [];

while ($row = mysqli_fetch_assoc($expenseCategoriesResult)) {
    $expenseCategoriesLabels[] = $row['category'];
    $expenseCategoriesData[] = $row['total_expense'];
}

// SQL Query to Get Budget Categories and Total Budget
$budgetCategoriesQuery = "SELECT category, SUM(amount) AS total_budget FROM budget WHERE user_id = $user_id GROUP BY category";
$budgetCategoriesResult = mysqli_query($conn, $budgetCategoriesQuery);

// Initialize arrays to store labels and data for the pie chart
$budgetCategoriesLabels = [];
$budgetCategoriesData = [];

while ($row = mysqli_fetch_assoc($budgetCategoriesResult)) {
    $budgetCategoriesLabels[] = $row['category'];
    $budgetCategoriesData[] = $row['total_budget'];
}

// SQL Query to Retrieve Income Over Time
$incomeQuery = "SELECT DATE_FORMAT(date, '%Y-%m') AS month_year, SUM(amount) AS total_income
                FROM income
                WHERE user_id = $user_id
                GROUP BY month_year
                ORDER BY month_year";

// Query for Expense Over Time
$expenseQuery = "SELECT DATE_FORMAT(date, '%Y-%m') AS month_year, SUM(amount) AS total_expenses
                FROM expense
                WHERE user_id = $user_id
                GROUP BY month_year
                ORDER BY month_year";

$incomeResult = mysqli_query($conn, $incomeQuery);
$expenseResult = mysqli_query($conn, $expenseQuery);

$months = [];
$totalIncomeData = [];
$totalExpensesData = [];

// Create arrays for income data
$incomeData = [];
while ($row = mysqli_fetch_assoc($incomeResult)) {
    $incomeData[$row['month_year']] = $row['total_income'];
}

// Create arrays for expense data
$expenseData = [];
while ($row = mysqli_fetch_assoc($expenseResult)) {
    $expenseData[$row['month_year']] = $row['total_expenses'];
}

// Combine income and expense data into one array
foreach (array_keys($incomeData) as $key) {
    $months[] = $key;
    $totalIncomeData[] = $incomeData[$key];
    $totalExpensesData[] = isset($expenseData[$key]) ? $expenseData[$key] : 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Finance Tracker - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Income</div>
                    <div class="card-body">
                        <h5 class="card-title">$<?php echo number_format($totalIncome, 2); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total Expenses</div>
                    <div class="card-body">
                        <h5 class="card-title">$<?php echo number_format($totalExpenses, 2); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Budget Usage</div>
                    <div class="card-body">
                        <h5 class="card-title">$<?php echo number_format($totalBudget, 2); ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Placeholder for the pie chart (to be added later) -->
        <div class="row mt-5 ml-sm-2 ml-md-4">
            <div class="col-md-5 ml-sm-2 ml-md-4">
                <canvas id="expenseCategoriesChart"></canvas>
                
                <!-- Add the following script after the placeholders for total income, total expenses, and budget usage -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Get the canvas element for the pie chart
    var ctx = document.getElementById('expenseCategoriesChart').getContext('2d');
    
    // Create a pie chart
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($expenseCategoriesLabels); ?>,
            datasets: [{
                data: <?php echo json_encode($expenseCategoriesData); ?>,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
            }],
        },
    });
</script>
</div>

            <div class="col-md-5 ml-sm-2 ml-md-4">
                <canvas id="budgetCategoriesChart"></canvas>
                
                <!-- Add the following script after the placeholders for total income, total expenses, and budget usage -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Get the canvas element for the pie chart
    var ctx = document.getElementById('budgetCategoriesChart').getContext('2d');
    
    // Create a pie chart
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($budgetCategoriesLabels); ?>,
            datasets: [{
                data: <?php echo json_encode($budgetCategoriesData); ?>,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
            }],
        },
    });
</script>
            </div>

        </div>
    </div>

    <!-- Add the necessary Chart.js and Bootstrap CSS links -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/Chart.min.js"></script>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Income vs Expense Over Time</h5>
            <canvas id="incomeExpensesChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Get the canvas element
    var ctx = document.getElementById('incomeExpensesChart').getContext('2d');

    // Define the data for the chart
    var chartData = {
        labels: <?php echo json_encode($months); ?>,
        datasets: [
            {
                label: 'Total Income',
                borderColor: 'rgba(75, 192, 192, 1)',
                data: <?php echo json_encode($totalIncomeData); ?>
            },
            {
                label: 'Total Expenses',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: <?php echo json_encode($totalExpensesData); ?>
            }
        ]
    };

    // Create the line chart
    var incomeExpensesChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month-Year'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Amount ($)'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>