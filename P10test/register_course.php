<?php
session_start();
include('includes/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Check if courses were selected
if (isset($_POST['courses'])) {
    $selected_courses = $_POST['courses'];
    
    // Prepare to insert each selected course into the registrations table
    $stmt = $conn->prepare("INSERT INTO schedules (user_id, course_name) VALUES (?, ?)");
    foreach ($selected_courses as $course) {
        $stmt->bind_param("is", $_SESSION['user_id'], $course);
        if ($stmt->execute()) {
            echo "You have successfully registered for the course: " . htmlspecialchars($course) . "<br>";
        } else {
            // Output error message if the query fails
            echo "Error: " . $stmt->error . "<br>";
        }
    }
    $stmt->close();
} else {
    echo "No courses selected.";
}

// Close the database connection
mysqli_close($conn);
?>