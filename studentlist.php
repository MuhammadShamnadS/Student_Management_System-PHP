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
<html>
<head>
    <title>Student List</title>
</head>
<body>
<h2>Registered Students</h2>
<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Reg No</th>
    <th>Age</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Course</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['reg_no']; ?></td>
    <td><?php echo $row['age']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['course']; ?></td>
</tr>
<?php } ?>
</table>
<br><a href="admindashboard.php">⬅ Back to Dashboard</a>
</body>
</html>