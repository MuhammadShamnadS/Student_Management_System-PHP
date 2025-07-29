<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$old = $_SESSION['old'] ?? [];
$errors = $_SESSION['errors'] ?? [];

function old($key) {
    global $old;
    return isset($old[$key]) ? htmlspecialchars($old[$key]) : '';
}
function error($key) {
    global $errors;
    return isset($errors[$key]) ? "<div class='text-danger small'>{$errors[$key]}</div>" : "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Admin - Add Student</span>
    </div>
</nav>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">

        <!-- Flexbox to align Back button left and Title center -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="admindashboard.php" class="btn btn-sm btn-outline-secondary">← Back</a>
            <h3 class="m-0 flex-grow-1 text-center">Register New Student</h3>
        </div>

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-success"><?= $_SESSION['msg'] ?></div>
        <?php endif; ?>

        <form action="studentsave.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" value="<?= old('name') ?>">
                <?= error('name') ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Registration No (e.g., REG-2024-0001)</label>
                <input type="text" name="reg_no" class="form-control <?= isset($errors['reg_no']) ? 'is-invalid' : '' ?>" value="<?= old('reg_no') ?>">
                <?= error('reg_no') ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Age (18-25)</label>
                <input type="number" name="age" class="form-control <?= isset($errors['age']) ? 'is-invalid' : '' ?>" value="<?= old('age') ?>">
                <?= error('age') ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" value="<?= old('email') ?>">
                <?= error('email') ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone (10 digits)</label>
                <input type="text" name="phone" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" value="<?= old('phone') ?>">
                <?= error('phone') ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Course</label>
                <select name="course" class="form-select <?= isset($errors['course']) ? 'is-invalid' : '' ?>">
                    <option value="">Select Course</option>
                    <option value="BCA" <?= old('course') == 'BCA' ? 'selected' : '' ?>>BCA</option>
                    <option value="BSc" <?= old('course') == 'BSc' ? 'selected' : '' ?>>BSc</option>
                    <option value="MCA" <?= old('course') == 'MCA' ? 'selected' : '' ?>>MCA</option>
                </select>
                <?= error('course') ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register Student</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php unset($_SESSION['old'], $_SESSION['errors'], $_SESSION['msg']); ?>
