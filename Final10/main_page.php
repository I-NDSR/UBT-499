<!-- In main_page.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Welcome to the Course Management System</h1>
    <nav>
        <ul>
            <li><a href="registration.php">Registration</a></li>
            <li><a href="schedule_page.php">My schedule</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="safety_resources.php">Safety Resources</a></li> <!-- New link for safety resources -->
            <li><a href="feedback.php">Feedback</a></li> <!-- New link for feedback -->
        </ul>
    </nav>
</body>
</html>



