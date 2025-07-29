<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
<h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
<a href="studentadd.php">Add Student</a> | 
<a href="studentlist.php">View Students</a> | 
<a href="logout.php">Logout</a>
</body>
</html>