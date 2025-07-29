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
    <title>Add Student</title>
</head>
<body>
<h2>Register New Student</h2>

<?php 
if (isset($_SESSION['msg'])) {
    echo "<p style='color:green'>" . $_SESSION['msg'] . "</p>";
    unset($_SESSION['msg']);
}
if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>

<form action="studentsave.php" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Registration No (e.g. REG-2024-0001):</label><br>
    <input type="text" name="reg_no" required><br><br>

    <label>Age (18-25):</label><br>
    <input type="number" name="age" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone (10 digits):</label><br>
    <input type="text" name="phone" required><br><br>

    <label>Course:</label><br>
    <select name="course" required>
        <option value="">Select Course</option>
        <option value="BCA">BCA</option>
        <option value="BSc">BSc</option>
        <option value="MCA">MCA</option>
    </select><br><br>

    <button type="submit">Register Student</button>
</form>

<br><a href="admindashboard.php">⬅ Back to Dashboard</a>
</body>
</html>