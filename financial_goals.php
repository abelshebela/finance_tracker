    <?php
    session_start(); // Start the PHP session
    include 'includes/db.php'; // Include your database connection code

    // Check if the user is logged in
    if (!isset($_SESSION['id'])) {
        // Redirect to the login page or handle unauthorized access
        header("Location: index.php");
        exit;
    }

    // Check if the "Add Goal" form is submitted
    if (isset($_POST['goal_name']) && isset($_POST['goal_amount']) && isset($_POST['goal_date'])) {
        $user_id = $_SESSION['id'];
        $goal_name = $_POST['goal_name'];
        $goal_amount = $_POST['goal_amount'];
        $goal_description = $_POST['goal_description'];
        $goal_date = $_POST['goal_date'];

        // Insert the new goal into the database
        $sql = "INSERT INTO financial_goals (user_id, goal_name, goal_amount, goal_description, goal_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $user_id, $goal_name, $goal_amount, $goal_description, $goal_date);

        if ($stmt->execute()) {
            // Goal added successfully
            // You can redirect to the financial goals list or display a success message
        } else {
            // Goal add failed
            // You can redirect back to the add goal form or display an error message
        }
    }
    ?>

    <!DOCTYPE html>
   <html> 
   <head>
    <title>Finance Tracker - Financial Goals</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
    <div class="container mt-4">
    <!-- Add Goal Form -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="goal_name">Goal Name:</label>
            <input type="text" name="goal_name" id="goal_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="goal_amount">Goal Amount:</label>
            <input type="number" name="goal_amount" id="goal_amount" step="0.01" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="goal_description">Description:</label>
            <textarea name="goal_description" id="goal_description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="goal_date">Target Date:</label>
            <input type="date" name="goal_date" id="goal_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Goal</button>
    </form>

    <!-- List of Financial Goals -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Goal Name</th>
                <th>Goal Amount</th>
                <th>Description</th>
                <th>Target Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_id = $_SESSION['id'];
            $goalsQuery = "SELECT id, goal_name, goal_amount, goal_description, goal_date FROM financial_goals WHERE user_id = $user_id";
            $goalsResult = mysqli_query($conn, $goalsQuery);

            while ($row = mysqli_fetch_assoc($goalsResult)) {
                echo "<tr>";
                echo "<td>" . $row['goal_name'] . "</td>";
                echo "<td>$" . number_format($row['goal_amount'], 2) . "</td>";
                echo "<td>" . $row['goal_description'] . "</td>";
                echo "<td>" . $row['goal_date'] . "</td>";
                echo "<td><a href='edit_goal.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a></td>";
                echo "<td><a href='delete_goal.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>