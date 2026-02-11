<?php
session_start();
require_once "../config/db.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT id, password FROM admins WHERE email=? AND status=1 LIMIT 1"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {

        $admin = $res->fetch_assoc();

        if (password_verify($password, $admin['password'])) {

            session_regenerate_id(true);

            // Clear other roles
            unset($_SESSION['SUB_ADMIN_LOGIN'], $_SESSION['sub_admin_id']);

            // Admin session
            $_SESSION['ADMIN_LOGIN'] = 1;
            $_SESSION['role'] = 'admin';
            $_SESSION['admin_id'] = $admin['id'];

            header("Location: dashboard.php");
            exit();
        }
    }

    $error = "Invalid email or password";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{box-sizing:border-box}
body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Segoe UI',system-ui;
    background:radial-gradient(circle at top,#2a2f38,#0f1115 70%);
    color:#fff;
}

/* ===== Glass Card ===== */
.login-card{
    width:380px;
    padding:38px 34px;
    border-radius:22px;
    background:rgba(255,255,255,.06);
    backdrop-filter:blur(18px);
    box-shadow:
        0 40px 80px rgba(0,0,0,.65),
        inset 0 1px 0 rgba(255,255,255,.08);
    position:relative;
    animation:fadeUp .7s ease;
}

@keyframes fadeUp{
    from{opacity:0; transform:translateY(30px);}
    to{opacity:1; transform:none;}
}

.login-card h2{
    margin:0 0 24px;
    font-size:30px;
    font-weight:700;
    text-align:center;
    background:linear-gradient(90deg,#ff4ecd,#6ae3ff);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

/* ===== Inputs ===== */
.input-group{
    margin-bottom:18px;
}

.input-group input{
    width:100%;
    padding:14px 16px;
    border-radius:14px;
    border:none;
    background:rgba(255,255,255,.12);
    color:#fff;
    font-size:15px;
}

.input-group input::placeholder{
    color:#cbd5e1;
}

.input-group input:focus{
    outline:none;
    box-shadow:0 0 0 2px #ff4ecd88;
}

/* ===== Button ===== */
.login-btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:30px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    background:linear-gradient(135deg,#ff4ecd,#6ae3ff);
    color:#0f172a;
    box-shadow:0 0 30px #ff4ecd88;
    transition:.3s;
}

.login-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 0 45px #ff4ecdcc;
}

/* ===== Error ===== */
.error{
    background:rgba(255,0,0,.15);
    border:1px solid rgba(255,0,0,.4);
    color:#ffb4b4;
    padding:10px 14px;
    border-radius:12px;
    margin-bottom:16px;
    font-size:14px;
    text-align:center;
}

/* ===== Links ===== */
.links{
    margin-top:20px;
    text-align:center;
    font-size:14px;
}

.links a{
    color:#6ae3ff;
    text-decoration:none;
}

.links a:hover{
    text-decoration:underline;
}

/* ===== Footer Glow ===== */
.login-card::after{
    content:"";
    position:absolute;
    inset:auto 0 -30px 0;
    height:60px;
    background:radial-gradient(circle,#ff4ecd55,transparent 70%);
}
</style>
</head>

<body>

<div class="login-card">

    <h2>Admin Login</h2>

    <form method="POST">
        <div class="input-group">
            <input type="email" name="email" placeholder="Admin Email" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button class="login-btn" type="submit">LOGIN</button>
    </form>

    <div class="links">
        <a href="../auth/login.php">← Back to User Login</a>
    </div>

</div>

</body>
</html>
