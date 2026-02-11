<?php
session_start();
require_once "admin_guard.php";
require_once "../db.php";

/* শুধু Admin ই Sub-Admin বানাতে পারবে */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../admin/admin_login.php");
    exit();
}

$msg = "";

if (isset($_POST['register'])) {

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO sub_admins (name, email, password) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $name, $email, $pass);

    if ($stmt->execute()) {
        $msg = "✅ Sub Admin Created Successfully";
    } else {
        $msg = "❌ Email already exists";
    }
}
?>

<form method="POST">
    <h2>Create Sub Admin</h2>
    <p style="color:green"><?= $msg ?></p>

    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <button name="register">Create</button>
</form>
