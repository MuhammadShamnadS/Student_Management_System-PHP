<?php
session_start();
include "db.php";

$_SESSION['old'] = $_POST; 
$errors = [];

// Get input
$name    = trim($_POST['name']);
$reg_no  = trim($_POST['reg_no']);
$age     = intval($_POST['age']);
$email   = trim($_POST['email']);
$phone   = trim($_POST['phone']);
$course  = trim($_POST['course']);

// Validation with field-specific error storage
if (!preg_match("/^[A-Za-z ]{2,}$/", $name)) {
    $errors['name'] = "Name must be at least 2 alphabetic characters.";
}
if (!preg_match("/^REG-[0-9]{4}-[0-9]{4}$/", $reg_no)) {
    $errors['reg_no'] = "Registration number must follow REG-YYYY-NNNN format.";
}
if ($age < 18 || $age > 25) {
    $errors['age'] = "Age must be between 18 and 25.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
}
if (!preg_match("/^[0-9]{10}$/", $phone)) {
    $errors['phone'] = "Phone number must be 10 digits.";
}
if (!in_array($course, ['BCA','BSc','MCA'])) {
    $errors['course'] = "Please select a valid course.";
}

// Sends the error back to form
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: studentadd.php");
    exit;
}

// Insert into DB if no errors
$stmt = $conn->prepare("INSERT INTO students (name, reg_no, age, email, phone, course) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssisss", $name, $reg_no, $age, $email, $phone, $course);

if ($stmt->execute()) {
    $_SESSION['msg'] = "Student registered successfully!";
    unset($_SESSION['old']);
} else {
    $_SESSION['errors']['db'] = "Database error: " . $conn->error;
}

$stmt->close();
$conn->close();
header("Location: studentadd.php");
exit;
