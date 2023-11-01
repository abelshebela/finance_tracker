<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_SESSION['id'];
    $goal_id = $_GET['id'];

    // Check if the goal belongs to the user
    $goalQuery = "SELECT * FROM financial_goals WHERE id = $goal_id AND user_id = $user_id";
    $goalResult = mysqli_query($conn, $goalQuery);

    if (mysqli_num_rows($goalResult) > 0) {
        // Delete the goal from the database
        $deleteGoalQuery = "DELETE FROM financial_goals WHERE id = $goal_id";
        mysqli_query($conn, $deleteGoalQuery);

        // Redirect to the financial goals list or show a success message
        header("Location: financial_goals.php");
        exit;
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
?>
