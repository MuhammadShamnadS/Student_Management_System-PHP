<?php
session_start();
include "db.php";

$username = $_POST['username'];
$password = md5($_POST['password']); 

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $isLocked = false;
    $remaining = 0;

    if ($user['failed_attempts'] >= 3 && !is_null($user['last_attempt'])) {
        $lockTime = strtotime($user['last_attempt']) + (5 * 60);
        $remaining = $lockTime - time();

        if ($remaining > 0) {
            $isLocked = true;
        }
    }

    if ($isLocked) {
        $minutes = floor($remaining / 60);
        $seconds = $remaining % 60;
        $_SESSION['error'] = "Account locked! Try again in {$minutes}m {$seconds}s";
        header("Location: login.php");
        exit;
    }

    // Password Check
    if ($user['password'] === $password) {
        // Reset failed attempts
        $conn->query("UPDATE users SET failed_attempts=0, last_attempt=NULL WHERE id=".$user['id']);
        $_SESSION['admin'] = $username;
        header("Location: admindashboard.php");
        exit;
    } else {
        // Increment failed attempts using PHP time
        $phpTime = date('Y-m-d H:i:s');
        $conn->query("UPDATE users SET failed_attempts=failed_attempts+1, last_attempt='$phpTime' WHERE id=".$user['id']);
        $_SESSION['error'] = "Invalid password!";
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['error'] = "User not found!";
    header("Location: login.php");
    exit;
}
?>
