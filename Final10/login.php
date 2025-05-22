<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Updated SQL query to fetch the hashed password
    $sql = "SELECT id, role, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            // Generate and send MFA code
            $mfa_code = rand(100000, 999999); // Generate a random 6-digit code
            $_SESSION['mfa_code'] = $mfa_code;
            // Send $mfa_code to user's email or phone (implement email/SMS sending here)
            
            // Redirect to MFA verification page
            header("Location: verify_mfa.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>
