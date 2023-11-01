<?php
session_start(); // Start the PHP session

if (!isset($_SESSION['id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit;
}

include 'includes/db.php';

// Fetch and display user-specific income and expense transactions

// Fetch and display income transactions
$income_sql = "SELECT * FROM income WHERE user_id = ?";
$income_stmt = $conn->prepare($income_sql);
$income_stmt->bind_param("i", $_SESSION['id']);
$income_stmt->execute();
$income_result = $income_stmt->get_result();

// Fetch and display expense transactions
$expense_sql = "SELECT * FROM expense WHERE user_id = ?";
$expense_stmt = $conn->prepare($expense_sql);
$expense_stmt->bind_param("i", $_SESSION['id']);
$expense_stmt->execute();
$expense_result = $expense_stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Transactions</title>
    <!-- Add CSS links for styling, Bootstrap, and any additional styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
    <div class="container">

        <h4 class="mt-4">Income Transactions</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Source</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $income_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['source'] . "</td>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h4>Expense Transactions</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $expense_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
