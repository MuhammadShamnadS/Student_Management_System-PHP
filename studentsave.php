<?php
session_start();
include "db.php";

// Get input values
$name    = $_POST['name'];
$reg_no  = $_POST['reg_no'];
$age     = $_POST['age'];
$email   = $_POST['email'];
$phone   = $_POST['phone'];
$course  = $_POST['course'];

// Server-side Validations
if (!preg_match("/^[A-Za-z ]{2,}$/", $name)) {
    $_SESSION['error'] = "Name must be at least 2 alphabets.";
    header("Location: studentadd.php"); exit;
}

if (!preg_match("/^REG-[0-9]{4}-[0-9]{4}$/", $reg_no)) {
    $_SESSION['error'] = "Registration number format invalid. Use REG-YYYY-NNNN.";
    header("Location: studentadd.php"); exit;
}

if ($age < 18 || $age > 25) {
    $_SESSION['error'] = "Age must be between 18 and 25.";
    header("Location: studentadd.php"); exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format.";
    header("Location: studentadd.php"); exit;
}

if (!preg_match("/^[0-9]{10}$/", $phone)) {
    $_SESSION['error'] = "Phone number must be 10 digits.";
    header("Location: studentadd.php"); exit;
}

if (!in_array($course, ['BCA','BSc','MCA'])) {
    $_SESSION['error'] = "Invalid course selection.";
    header("Location: studentadd.php"); exit;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO students(name, reg_no, age, email, phone, course) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssisss", $name, $reg_no, $age, $email, $phone, $course);

if ($stmt->execute()) {
    $_SESSION['msg'] = "Student registered successfully!";
} else {
    $_SESSION['error'] = "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
header("Location: studentadd.php");
?>