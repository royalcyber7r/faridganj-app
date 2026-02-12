<?php
session_start();
require "../db.php"; 

$error = "";

/* BASE_URL না থাকলে define করে নিন */
if (!defined('BASE_URL')) {
    define("BASE_URL", "/faridganj-app/");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // ✅ Prepared Statement (SQL Injection Protection)
    $stmt = $conn->prepare("SELECT id, username, name, photo, password 
                            FROM users 
                            WHERE email=? 
                            LIMIT 1");

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // ✅ Password Verify
        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true); // 🔐 Prevent session hijacking

            $_SESSION['USER_LOGIN'] = 1;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['photo'] = $user['photo'];

            // ✅ Redirect Secure Way
            header("Location: " . BASE_URL . "pages/home.php");
            exit();

        } else {
            $error = "Wrong Password";
        }

    } else {
        $error = "User Not Found";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faridganj App | Login</title>
    <link rel="icon" type="image/png" href="/faridganj-app/favicon.png">

    <!-- Styles -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            background: #1f2228;
        }
        .login-card {
            width: 360px;
            padding: 32px 28px;
            border-radius: 22px;
            background: linear-gradient(180deg, #2a2f36, #22262c);
            box-shadow: 0 30px 60px rgba(0,0,0,.6), inset 0 1px 0 rgba(255,255,255,.05);
            position: relative;
        }
        .login-card::before,
        .login-card::after {
            content: "";
            position: absolute;
            inset: -2px;
            border-radius: 22px;
            z-index: -1;
        }
        .login-card::before {
            border-left: 3px solid #ff4ecd;
            border-bottom: 3px solid #ff4ecd;
        }
        .login-card::after {
            border-top: 3px solid #3cf6ff;
            border-right: 3px solid #3cf6ff;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 18px;
        }
        .login-logo img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            border-radius: 50%;
            background: #fff;
            padding: 8px;
            box-shadow: 0 0 20px #3cf6ff;
        }
        .login-card h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #3cf6ff;
        }
        .error {
            color: #ff6b6b;
            margin-bottom: 14px;
            font-size: 14px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #9aa4b2;
            font-size: 14px;
        }
        .login-card input {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 18px;
            border-radius: 14px;
            border: none;
            background: #555;
            color: #fff;
            font-size: 15px;
        }
        .login-card input::placeholder {
            color: #ddd;
        }
        .login-card input:focus {
            outline: none;
            box-shadow: 0 0 0 2px #3cf6ff66;
        }
        .login-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            color: #000;
            background: #3cf6ff;
            box-shadow: 0 0 25px #3cf6ff;
            transition: .3s;
        }
        .login-btn:hover {
            box-shadow: 0 0 40px #3cf6ff;
            transform: translateY(-2px);
        }
        .links {
            margin-top: 18px;
            font-size: 14px;
        }
        .links p {
            margin: 8px 0;
            color: #9aa4b2;
        }
        .links a {
            color: #ff4ecd;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-logo">
        <img src="./assets/logo.png" alt="Faridganj Logo">
    </div>

    <h2>User Login</h2>

    <!-- Show error message if there is one -->
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <!-- Login form -->
    <form method="post">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>

        <button class="login-btn" type="submit">Login</button>
    </form>

    <div class="links">
        <p>Forget password? <a href="forgot_password.php">Click Here</a></p>
        <p>Don’t have an account? <a href="register.php">Register</a></p>
    </div>
</div>

</body>
</html>
