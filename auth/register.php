<?php
require_once "admin_guard.php";
require_once "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name     = $_POST['name'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
	$mobile   = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, username, email, mobile, password) 
            VALUES ('$name', '$username', '$email', '$mobile', '$password')";

    if ($conn->query($sql)) {
        header("Location: /faridganj-app/auth/login.php");
        exit;
    } else {
        $error = "Registration Failed!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}
body{
    margin:0;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#8fa7ff,#a6b6ff);
    overflow:hidden;
}

/* soft floating shapes */
body::before,
body::after{
    content:"";
    position:absolute;
    border-radius:30%;
    filter:blur(60px);
    opacity:.45;
}
body::before{
    width:260px;height:260px;
    background:#6f86ff;
    top:-60px; right:-60px;
}
body::after{
    width:220px;height:220px;
    background:#9dd6ff;
    bottom:-60px; left:-60px;
}

/* Main Card */
.signup-card{
    position:relative;
    width:900px;
    max-width:95%;
    display:grid;
    grid-template-columns:1fr 1fr;
    padding:40px;
    border-radius:26px;
    background:rgba(255,255,255,.35);
    backdrop-filter: blur(18px);
    box-shadow:0 30px 60px rgba(0,0,0,.25);
}

/* Left side */
.signup-left h2{
    margin:0 0 25px;
    font-size:26px;
    color:#1d2b6f;
}
.form-group{
    margin-bottom:16px;
}
.form-group input{
    width:100%;
    padding:14px 18px;
    border:none;
    border-radius:30px;
    background:#f4f6ff;
    font-size:14px;
    outline:none;
    box-shadow: inset 0 2px 6px rgba(0,0,0,.15);
}
.form-group input:focus{
    box-shadow:0 0 0 2px #6f86ff;
}

/* Right side */
.signup-right{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
}
.signup-btn{
    width:200px;
    padding:14px;
    border:none;
    border-radius:30px;
    background:#0c1226;
    color:#fff;
    font-size:15px;
    cursor:pointer;
    box-shadow:0 15px 30px rgba(0,0,0,.35);
}
.signup-btn:hover{
    transform:translateY(-2px);
}
.signup-right p{
    margin-top:18px;
    font-size:14px;
}
.signup-right a{
    color:#1d2b6f;
    font-weight:600;
    text-decoration:none;
}

/* Error */
.error{
    color:#c0392b;
    margin-bottom:10px;
}

/* Mobile */
@media(max-width:768px){
    .signup-card{
        grid-template-columns:1fr;
        gap:25px;
    }
}
</style>
</head>

<body>

<div class="signup-card">

    <!-- Left -->
    <div class="signup-left">
        <h2>Sign Up</h2>

        <?php if(!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" required>
            </div>

            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
			
			<div class="form-group">
				<input type="text" name="mobile" placeholder="Mobile Number" required>
			</div>
			
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
    </div>

    <!-- Right -->
    <div class="signup-right">
        <button class="signup-btn" type="submit">Sign Up</button>
        <p>Already have an account? <a href="login.php">Log in</a></p>
        </form>
    </div>

</div>

</body>
</html>
