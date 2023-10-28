<?php
session_start(); // Start the PHP session
include '../includes/db.php'; // Include your database connection code

if (!isset($_SESSION['id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["id"];
    $date = $_POST["date"];
    $category = $_POST["category"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    // Check if a budget exists for the selected category
    $budgetQuery = "SELECT amount FROM budget WHERE user_id = $user_id AND category = '$category'";
    $budgetResult = mysqli_query($conn, $budgetQuery);

    if ($budgetResult && mysqli_num_rows($budgetResult) > 0) {
        $row = mysqli_fetch_assoc($budgetResult);
        $budgetAmount = $row['amount'];

        // Check if the user's cumulative expenses for this category exceed the budget
        $cumulativeExpensesQuery = "SELECT cumulative_expenses FROM budget WHERE user_id = $user_id AND category = '$category'";
        $cumulativeExpensesResult = mysqli_query($conn, $cumulativeExpensesQuery);

        if ($cumulativeExpensesResult && mysqli_num_rows($cumulativeExpensesResult) > 0) {
            $row = mysqli_fetch_assoc($cumulativeExpensesResult);
            $cumulativeExpenses = $row['cumulative_expenses'];

            if ($cumulativeExpenses + $amount > $budgetAmount) {
                // Redirect to an error page or display an error message
                echo "Expense exceeds the budget. You cannot spend more than the budget amount.";
                exit();
            }
        }

        // Insert the new expense into the expense table
        $sql = "INSERT INTO expense (user_id, category, date, amount, description, created_at) 
                VALUES ('$user_id', '$category', '$date', '$amount', '$description', NOW())";
        mysqli_query($conn, $sql);

        // Update the budget table with new cumulative expenses
        $updateBudgetQuery = "UPDATE budget SET cumulative_expenses = cumulative_expenses + $amount 
                              WHERE user_id = $user_id AND category = '$category'";
        mysqli_query($conn, $updateBudgetQuery);

        // Check if cumulative expenses exceed 80% or 100% of the budget
        $expensePercentage = ($cumulativeExpenses + $amount) / $budgetAmount * 100;

        if ($expensePercentage >= 80 && $expensePercentage < 100) {
            // Notify the user (insert a notification into the notifications table)
            $message = "You have reached 80% of your budget for the category: $category.";
            $insertNotificationQuery = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$message')";
            mysqli_query($conn, $insertNotificationQuery);
        }

        if ($expensePercentage >= 100) {
            // Notify the user (insert a notification into the notifications table)
            $message = "You have reached 100% of your budget for the category: $category.";
            $insertNotificationQuery = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$message')";
            mysqli_query($conn, $insertNotificationQuery);
        }

        // Redirect to the dashboard or display a success message
        header("Location: dashboard.php");
        exit();
    } else {
        // No budget found for this category
        echo "No budget found for this category. Please set a budget first.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include '../includes/nav.php' ?>
    <div class="container">
        <h2 class="mt-5">Add Expense</h2>
        <form action="add_expense.php" method="POST">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" name="date" required>
            </div>
            
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <?php
                    $query = "SELECT name FROM categories";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                    } else {
                        echo '<option value="No Categories Found">No Categories Found</option>';
                    }

                    mysqli_close($conn);
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Expense</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
