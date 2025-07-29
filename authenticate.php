<?php
session_start();
include "db.php";

$username = $_POST['username'];
$password = md5($_POST['password']);  
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Check if user is locked
    if ($user['failed_attempts'] >= 3 && strtotime($user['last_attempt']) > strtotime("-5 minutes")) {
        $_SESSION['error'] = "Login failed. Try again after 5 minutes.";
        header("Location: login.php");
        exit;
    }

    if ($user['password'] == $password) {
        // Reset failed attempts on success
        $conn->query("UPDATE users SET failed_attempts=0, last_attempt=NULL WHERE id=".$user['id']);
        
        $_SESSION['admin'] = $username;
        header("Location: admindashboard.php");
    } else {
        // Wrong password: increase failed attempts
        $conn->query("UPDATE users SET failed_attempts=failed_attempts+1, last_attempt=NOW() WHERE id=".$user['id']);
        $_SESSION['error'] = "Invalid Password!";
        header("Location: login.php");
    }
} else {
    $_SESSION['error'] = "User not found!";
    header("Location: login.php");
}
?>