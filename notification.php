<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mark all notifications as read when the user clicks the notification count
    $user_id = $_SESSION['id'];
    $markReadQuery = "UPDATE notifications SET read_status = 1 WHERE user_id = $user_id AND read_status = 0";
    mysqli_query($conn, $markReadQuery);
}

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM notifications WHERE user_id = $user_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Finance Tracker - Notifications</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include 'includes/nav.php' ?>
    </header>
    <div class="container mt-4">
        <h1 class="mb-4">Notifications</h1>
        <?php
        // Display the number of unread notifications and make it clickable
        $unreadNotificationsCount = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['read_status'] == 0) {
                $unreadNotificationsCount++;
            }
        }

        echo '<a href="#" data-toggle="modal" data-target="#notificationModal">';
        echo "<p class='alert alert-info'>You have $unreadNotificationsCount unread notifications.</p>";
        echo '</a>';
        ?>
        <ul class="list-group">
            <?php
            // Display the notifications
            mysqli_data_seek($result, 0); // Reset the result set to the beginning
            while ($row = mysqli_fetch_assoc($result)) {
                $notificationId = $row['id'];
                $message = $row['message'];
                $readStatus = $row['read_status'];
                $timestamp = $row['created_at'];

                // Display unread notifications in a different style
                $notificationClass = $readStatus == 0 ? 'list-group-item unread' : 'list-group-item';

                echo "<li class='$notificationClass'>$message <span class='badge badge-success'>$timestamp</span></li>";
            }
            ?>
        </ul>
    </div>

    <!-- Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Unread Notifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <?php
                        // Display the unread notifications in the modal
                        mysqli_data_seek($result, 0); // Reset the result set to the beginning
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['read_status'] == 0) {
                                echo "<li class='list-group-item'>{$row['message']}</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
