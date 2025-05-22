<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_code = $_POST['mfa_code'];
    if ($entered_code == $_SESSION['mfa_code']) {
        // MFA successful, redirect to main page
        header("Location: main_page.php");
        exit();
    } else {
        echo "Invalid MFA code.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MFA Verification</title>
</head>
<body>
    <form action="verify_mfa.php" method="POST">
        <h2>Enter MFA Code</h2>
        <input type="text" name="mfa_code" placeholder="MFA Code" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
