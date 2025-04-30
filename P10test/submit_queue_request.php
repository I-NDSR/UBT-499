<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $courses = $_POST['courses'] ?? [];

    $stmt = $conn->prepare("INSERT INTO queue_requests (user_id, course_id) VALUES (?, ?)");
    foreach ($courses as $course_id) {
        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();
    }
    $stmt->close();

    echo "Your queue request has been submitted.";
    echo '<br><a href="main_page.php">Go back to main page</a>';
}
?>