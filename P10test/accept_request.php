<?php
session_start();
include('includes/db.php');

if (isset($_POST['request_id'])) {
    $request_id = intval($_POST['request_id']);

    $query = "SELECT user_id, course_id FROM queue_requests WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $request = $result->fetch_assoc();
        $user_id = $request['user_id'];
        $course_id = $request['course_id'];

        $insert_query = "INSERT INTO schedules (user_id, course_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ii", $user_id, $course_id);

        if ($insert_stmt->execute()) {
            $delete_query = "DELETE FROM queue_requests WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $request_id);
            $delete_stmt->execute();

            header("Location: admin_dashboard.php?success=Course accepted successfully.");
        } else {
            die("Error adding course: " . $conn->error);
        }
    } else {
        die("Request not found.");
    }
} else {
    die("Invalid request.");
}
?>