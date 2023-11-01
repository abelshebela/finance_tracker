<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}
// Add the following code to the budget addition logic in add_budget.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $user_id = $_SESSION["id"];
    $category = $_POST["category"];
    $amount = $_POST["amount"];

    // Check if the budget amount is greater than the total income
    $incomeQuery = "SELECT SUM(amount) AS total_income FROM income WHERE user_id = $user_id";
    $incomeResult = mysqli_query($conn, $incomeQuery);
    $incomeRow = mysqli_fetch_assoc($incomeResult);
    $totalIncome = $incomeRow['total_income'];

    if ($amount > $totalIncome) {
        // Budget amount exceeds total income, display an error message
        echo "Budget amount cannot exceed total income.";
    } else {
        // Budget amount is valid, add it to the database
        $sql = "INSERT INTO budget (user_id, category, amount, start_date, end_date, created_at) 
                VALUES ('$user_id', '$category', '$amount', NOW(), NOW(), NOW())";
        
        if (mysqli_query($conn, $sql)) {
            // Budget added successfully
            header("Location: dashboard.php");
            exit();
        } else {
            // Error handling, display an error message
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Budget</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'nav.php'?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-5">Add Budget</h2>
                <form method="POST" action="add_budget.php">
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category" class="form-control">
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
                        <label for="amount">Budget Amount:</label>
                        <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <button type="submit" name="add_budget" class="btn btn-primary">Add Budget</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
