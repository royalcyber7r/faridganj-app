<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION['reset_mobile'])){
    header("Location: login.php");
    exit;
}

$msg="";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $p1 = $_POST['password'];
    $p2 = $_POST['confirm'];

    if($p1 === $p2){
        $mobile = $_SESSION['reset_mobile'];

        mysqli_query($conn,"UPDATE users SET password='$p1', otp=NULL, otp_expire=NULL WHERE mobile='$mobile'");

        session_destroy();
        header("Location: login.php");
        exit;
    }else{
        $msg="Password not matched";
    }
}
?>

<div class="neon-card">
    <h2>Reset Password</h2>

    <form method="post">
        <label>New Password</label>
        <input type="password" name="password" placeholder="New password" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm" placeholder="Confirm password" required>

        <button class="neon-btn">Update Password</button>
    </form>

    <p class="msg"><?= $msg ?></p>
</div>
<style>

*{
    box-sizing:border-box;
}

body{
    margin:0;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Segoe UI',sans-serif;
    background:radial-gradient(circle at top,#2b313a,#15171b 70%);
}

/* Card */
.neon-card{
    width:360px;
    padding:34px 30px;
    border-radius:24px;
    background:linear-gradient(180deg,#2b3038,#1c1f25);
    box-shadow:
        0 35px 70px rgba(0,0,0,.7),
        inset 0 1px 0 rgba(255,255,255,.05);
    position:relative;
}

/* Neon frame */
.neon-card::before,
.neon-card::after{
    content:"";
    position:absolute;
    inset:-2px;
    border-radius:24px;
    z-index:-1;
}

.neon-card::before{
    border-left:3px solid #ff4ecd;
    border-bottom:3px solid #ff4ecd;
}

.neon-card::after{
    border-top:3px solid #3cf6ff;
    border-right:3px solid #3cf6ff;
}

/* Title */
.neon-card h2{
    margin:0 0 20px;
    color:#3cf6ff;
    font-size:26px;
}

/* Label */
label{
    font-size:14px;
    color:#9aa4b2;
    margin-bottom:6px;
    display:block;
}

/* Inputs */
.neon-card input{
    width:100%;
    padding:14px 16px;
    margin-bottom:18px;
    border-radius:14px;
    border:none;
    background:#555;
    color:#fff;
    font-size:15px;
}

.neon-card input::placeholder{
    color:#ddd;
}

.neon-card input:focus{
    outline:none;
    box-shadow:0 0 0 2px #3cf6ff55;
}

/* Button */
.neon-btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:30px;
    font-size:16px;
    cursor:pointer;
    background:#3cf6ff;
    color:#000;
    box-shadow:0 0 25px #3cf6ff;
    transition:.3s;
}

.neon-btn:hover{
    box-shadow:0 0 45px #3cf6ff;
    transform:translateY(-2px);
}

/* Message */
.msg{
    margin-top:12px;
    color:#ff6b6b;
    font-size:14px;
}

/* Mobile Friendly */
@media(max-width:420px){
    .neon-card{
        width:92%;
        padding:28px 24px;
    }
}

</style>