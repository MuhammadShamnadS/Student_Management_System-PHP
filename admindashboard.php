<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Welcome, <?php echo $_SESSION['admin']; ?>!</span>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
</nav>

<div class="container-fluid d-flex flex-column align-items-center justify-content-center vh-100">
    <h3 class="mb-4">Admin Dashboard</h3>

    <div class="d-flex justify-content-center gap-3 w-75">
        <a href="studentadd.php" class="btn btn-outline-dark flex-fill">Add Student</a>
        <a href="studentlist.php" class="btn btn-outline-dark flex-fill">View Students</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
