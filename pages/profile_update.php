<?php
session_start();
include "../db.php";

$user_id = $_SESSION['user_id'] ?? 0;
if($user_id == 0){
    header("location: ../auth/login.php");
    exit;
}

/* 🔹 Fetch user data */
$res = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($res);

/* 🔹 Update profile */
if(isset($_POST['update'])){

    $name   = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email  = $_POST['email'];

    $photoName = $user['photo'];

    if(!empty($_FILES['photo']['name'])){
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time().'_'.rand(1000,9999).'.'.$ext;

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "../uploads/users/".$photoName
        );
    }

    mysqli_query($conn,"UPDATE users SET
        name='$name',
        mobile='$mobile',
        email='$email',
        photo='$photoName'
        WHERE id='$user_id'
    ");

    $_SESSION['name']  = $name;
    $_SESSION['photo'] = $photoName;

    header("location: home.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Update</title>
    <style>
        body{
            font-family:sans-serif;
            background:#f4f6f8;
        }
        .profile-box{
            max-width:400px;
            margin:40px auto;
            background:#fff;
            padding:20px;
            border-radius:10px;
            box-shadow:0 4px 12px rgba(0,0,0,.1);
        }
        .profile-box h2{
            text-align:center;
            margin-bottom:20px;
        }
        .profile-box input{
            width:100%;
            padding:10px;
            margin-bottom:10px;
            border:1px solid #ccc;
            border-radius:5px;
        }
        .profile-box button{
            width:100%;
            padding:10px;
            background:#1e8e3e;
            color:#fff;
            border:none;
            border-radius:5px;
            font-size:16px;
            cursor:pointer;
        }
        .profile-img{
            width:90px;
            height:90px;
            border-radius:50%;
            object-fit:cover;
            display:block;
            margin:0 auto 15px;
        }
    </style>
</head>
<body>

<div class="profile-box">
    <h2>প্রোফাইল আপডেট করুন</h2>

    <img src="../uploads/users/<?= $user['photo'] ?? 'default.png' ?>" class="profile-img">

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= $user['name'] ?>" placeholder="নাম" required>
        <input type="text" name="mobile" value="<?= $user['mobile'] ?>" placeholder="মোবাইল নাম্বার">
        <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="ইমেইল">
        <input type="file" name="photo">
        <button name="update">Update Profile</button>

        <a href="home.php" class="home-btn">🏠 হোমে ফিরে যান</a>
    </form>
</div>

<style>
    .home-btn{
    display:block;
    margin-top:12px;
    padding:12px;
    text-align:center;
    text-decoration:none;
    font-size:15px;
    font-weight:600;
    border-radius:8px;
    color:#2c7be5;
    background:#eef4ff;
    border:1px solid #cfe0ff;
    transition:.3s ease;
}

.home-btn:hover{
    background:#2c7be5;
    color:#fff;
    box-shadow:0 8px 20px rgba(44,123,229,.35);
}

</style>


</body>
</html>
