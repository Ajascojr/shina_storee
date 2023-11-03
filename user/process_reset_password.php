<?php
require_once('../dashboard/includes/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate passwords
    if ($newPassword !== $confirmPassword) {
        echo "Passwords do not match.";
        exit();
    }

    // Validate password strength (you may want to add more checks)
    if (strlen($newPassword) < 8) {
        echo "Password should be at least 8 characters long.";
        exit();
    }

    // Hash the new password (you should use password_hash() function)
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $stmt = $my_conn->prepare("UPDATE user_tb SET password = ? WHERE reset_token = ?");
    $stmt->bind_param("ss", $hashedPassword, $token);

    if ($stmt->execute()) {
        // Password successfully updated
        echo "Password reset successfully. You can now login with your new password.";
    } else {
        echo "Error updating password: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
