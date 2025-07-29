<?php
session_start();
include "db.php";
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a href="admindashboard.php" class="btn btn-outline-light btn-sm me-3">Back</a>
        <span class="navbar-brand mb-0 h1">Admin - Registered Students</span>
    </div>
</nav>

<div class="container">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Student List</h5>
            <a href="studentadd.php" class="btn btn-light btn-sm">+ Add Student</a>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($result->num_rows > 0) { 
                        while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['reg_no']); ?></td>
                                <td><?= $row['age']; ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['phone']); ?></td>
                                <td><?= htmlspecialchars($row['course']); ?></td>
                            </tr>
                        <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No students registered yet.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
