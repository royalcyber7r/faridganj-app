<?php
session_start();
require_once __DIR__ . "/../db.php";

if (isset($_SESSION['role']) && $_SESSION['role'] === 'sub_admin') {
    header("Location: ../admin/sub_dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM sub_admins WHERE email=? AND status=1 LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $sub = $res->fetch_assoc();

        if (password_verify($password, $sub['password'])) {
            session_regenerate_id(true);

            $_SESSION['SUB_ADMIN_LOGIN'] = 1;
            $_SESSION['ADMIN_LOGIN'] = 0;
            $_SESSION['role'] = 'sub_admin';
            $_SESSION['sub_admin_id'] = $sub['id'];

            header("Location: ../admin/sub_dashboard.php");
            exit();
        }
    }

    $error = "Login failed";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sub Admin Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "Segoe UI", sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background: radial-gradient(circle at top,#1b1f2a,#0b0e14);
    color:#fff;
}

.login-card{
    width:360px;
    padding:35px 30px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border-radius:16px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.6);
    text-align:center;
}

.login-card h2{
    margin-bottom:25px;
    font-size:26px;
    background: linear-gradient(90deg,#ff6ec4,#7873f5);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.input-box{
    margin-bottom:15px;
}

.input-box input{
    width:100%;
    padding:12px 14px;
    background: rgba(255,255,255,0.15);
    border:none;
    border-radius:10px;
    color:#fff;
    font-size:15px;
}

.input-box input::placeholder{
    color:#ddd;
}

.input-box input:focus{
    outline:none;
    background: rgba(255,255,255,0.22);
}

.login-btn{
    width:100%;
    padding:12px;
    margin-top:10px;
    border:none;
    border-radius:30px;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    background: linear-gradient(90deg,#ff6ec4,#6dd5fa);
    color:#111;
    transition:0.3s;
}

.login-btn:hover{
    transform: scale(1.04);
}

.error{
    background: rgba(255,0,0,0.15);
    color:#ffb3b3;
    padding:8px;
    border-radius:8px;
    margin-bottom:15px;
    font-size:14px;
}

.back-link{
    margin-top:15px;
    display:block;
    font-size:13px;
    color:#8ab4ff;
    text-decoration:none;
}

.back-link:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<div class="login-card">
    <h2>Sub Admin Login</h2>

    <?php if (!empty($error)) : ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="input-box">
            <input type="email" name="email" placeholder="Sub Admin Email" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button class="login-btn" type="submit">LOGIN</button>
    </form>

    <a href="../login.php" class="back-link">← Back to User Login</a>
</div>

</body>
</html>