<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_SESSION['id'];
    $goal_id = $_GET['id'];

    $goalQuery = "SELECT * FROM financial_goals WHERE id = $goal_id AND user_id = $user_id";
    $goalResult = mysqli_query($conn, $goalQuery);

    if (mysqli_num_rows($goalResult) > 0) {
        $goalData = mysqli_fetch_assoc($goalResult);
    } else {
        // Goal not found or doesn't belong to the user, handle the error
        header("Location: dashboard.php"); // Redirect back to the dashboard or show an error message
        exit;
    }
} else {
    // Goal ID is not provided, handle the error
    header("Location: dashboard.php"); // Redirect back to the dashboard or show an error message
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_goal_name = $_POST['goal_name'];
    $new_goal_amount = $_POST['goal_amount'];
    $new_goal_description = $_POST['goal_description'];
    $new_goal_date = $_POST['goal_date'];

    // Update the goal in the database
    $updateGoalQuery = "UPDATE financial_goals SET goal_name = ?, goal_amount = ?, goal_description = ?, goal_date = ? WHERE id = ?";
    $stmt = $conn->prepare($updateGoalQuery);
    $stmt->bind_param("ssssi", $new_goal_name, $new_goal_amount, $new_goal_description, $new_goal_date, $goal_id);

    if ($stmt->execute()) {
        // Goal updated successfully
        header("Location: financial_goals.php");
        // You can redirect to the financial goals list or display a success message
    } else {
        // Goal update failed
        // You can redirect back to the edit goal form or display an error message
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Financial Goal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header>
        <?php include '../includes/nav.php' ?>
    </header>
    <div class="container mt-4">
        <h3 class="mb-4">Edit Financial Goal</h3>

        <form method="POST" action="">
            <div class="form-group">
                <label for="goal_name">Goal Name:</label>
                <input type="text" name="goal_name" id="goal_name" class="form-control" value="<?php echo $goalData['goal_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="goal_amount">Goal Amount:</label>
                <input type="number" name="goal_amount" id="goal_amount" step="0.01" class="form-control" value="<?php echo $goalData['goal_amount']; ?>" required>
            </div>
            <div class="form-group">
                <label for="goal_description">Description:</label>
                <textarea name="goal_description" id="goal_description" class="form-control"><?php echo $goalData['goal_description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="goal_date">Target Date:</label>
                <input type="date" name="goal_date" id="goal_date" class="form-control" value="<?php echo $goalData['goal_date']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
