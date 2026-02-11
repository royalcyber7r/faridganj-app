<?php
require_once "../config/db.php";
require_once "admin_guard.php"; // 🔐 only admin allowed

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // check duplicate email
    $check = $conn->prepare("SELECT id FROM sub_admins WHERE email=? LIMIT 1");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $msg = "error";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO sub_admins (name, email, password, status) VALUES (?, ?, ?, 1)"
        );
        $stmt->bind_param("sss", $name, $email, $pass);

        if ($stmt->execute()) {
            $msg = "success";
        } else {
            $msg = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Sub Admin</title>

<style>
body{
    background:#f4f6f9;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    margin:0;
    padding:0;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.card{
    width:420px;
    background:#fff;
    border-radius:16px;
    padding:30px;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.card h2{
    text-align:center;
    margin-bottom:25px;
    color:#2c3e50;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    font-size:14px;
    font-weight:600;
    margin-bottom:6px;
    color:#555;
}

.form-group input{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:1px solid #ccc;
    font-size:14px;
    outline:none;
}

.form-group input:focus{
    border-color:#3498db;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:12px;
    background:#3498db;
    color:#fff;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#2980b9;
}

.msg{
    margin-top:15px;
    padding:12px;
    border-radius:10px;
    text-align:center;
    font-size:14px;
}

.msg.success{
    background:#e8f7ef;
    color:#27ae60;
}

.msg.error{
    background:#fdecea;
    color:#c0392b;
}

.back{
    text-align:center;
    margin-top:18px;
}

.back a{
    text-decoration:none;
    color:#555;
    font-size:14px;
}
</style>
</head>

<body>

<div class="card">
    <h2>👤 Create Sub Admin</h2>

    <form method="post">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">➕ Create Sub Admin</button>
    </form>

    <?php if($msg=="success"){ ?>
        <div class="msg success">✅ Sub Admin created successfully</div>
    <?php } elseif($msg=="error"){ ?>
        <div class="msg error">❌ Email already exists</div>
    <?php } ?>

    <div class="back">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
