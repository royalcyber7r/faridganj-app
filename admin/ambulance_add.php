<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if (isset($_POST['save'])) {

    $name    = $_POST['name'];
    $address = $_POST['address'];
    $mobile  = $_POST['mobile'];
    $email   = $_POST['email'];

    $photoName = "";

    if (!empty($_FILES['photo']['name'])) {

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        $tmpPath  = $_FILES['photo']['tmp_name'];
        $mimeType = mime_content_type($tmpPath);

        if (!in_array($mimeType, $allowedTypes)) {
            die("❌ শুধু JPG, JPEG, PNG, WEBP ছবি আপলোড করা যাবে");
        }

        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time() . "_" . rand(1000,9999) . "." . $ext;

        $uploadDir = "../uploads/ambulance/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmpPath, $uploadDir . $photoName);
    }

    mysqli_query($conn, "INSERT INTO ambulance
    (name, address, mobile, email, photo)
    VALUES
    ('$name','$address','$mobile','$email','$photoName')");

    header("location: ambulance_list.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Ambulance</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
    margin:0;
    padding:40px;
}

.form-box{
    max-width:520px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.form-title{
    text-align:center;
    font-size:24px;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    font-weight:bold;
    margin-bottom:6px;
    font-size:14px;
}

.form-group input,
.form-group textarea{
    width:100%;
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}

.form-group textarea{
    resize:none;
    height:80px;
}

.file-input{
    text-align:center;
    margin:20px 0;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#27ae60;
    color:#fff;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}
button:hover{
    background:#219150;
}

.back-link{
    text-align:center;
    margin-top:15px;
}
.back-link a{
    text-decoration:none;
    color:#555;
    font-size:14px;
}
</style>
</head>

<body>

<div class="form-box">
    <div class="form-title">🚑 Add New Ambulance</div>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Ambulance Name</label>
            <input name="name" placeholder="নাম" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" placeholder="ঠিকানা"></textarea>
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input name="mobile" placeholder="মোবাইল নাম্বার">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="ইমেইল">
        </div>

        <div class="file-input">
            <input type="file" name="photo"
                   accept="image/jpeg,image/jpg,image/png,image/webp" required>
        </div>

        <button name="save">💾 Save Ambulance</button>

    </form>

    <div class="back-link">
        <a href="ambulance_list.php">← Back to list</a>
    </div>
</div>

</body>
</html>
