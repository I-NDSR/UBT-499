<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
    // Save feedback to the database or send it via email
    // Example: mysqli_query($conn, "INSERT INTO feedback (user_id, feedback) VALUES ('{$_SESSION['user_id']}', '$feedback')");
    echo "Thank you for your feedback!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
</head>
<body>
    <form action="feedback.php" method="POST">
        <h2>Your Feedback</h2>
        <textarea name="feedback" required></textarea>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
