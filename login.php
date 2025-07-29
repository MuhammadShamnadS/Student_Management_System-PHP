<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title >Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body class="bg-dark text-light">
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 400px;">
<h2 class="text-center mb-4">Admin Login</h2>

<?php 
if(isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>

<form action="authenticate.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
</body>
</html>