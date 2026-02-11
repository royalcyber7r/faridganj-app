<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    $name      = $_POST['name'];
    $father    = $_POST['father_name'];
    $address   = $_POST['address'];
    $mobile    = $_POST['mobile'];
    $facebook  = $_POST['facebook'];
    $website   = $_POST['website'];

    // auto upload folder
    $uploadDir = "../uploads/uddokta/";
    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    $image = "";
    if(!empty($_FILES['image']['name'])){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = time()."_uddokta.".$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir.$image);
    }

    $conn->query("
        INSERT INTO uddokta
        (name,father_name,address,mobile,facebook,website,image)
        VALUES
        ('$name','$father','$address','$mobile','$facebook','$website','$image')
    ");

    header("Location: uddokta_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>উদ্যোক্তা যোগ</title>

<style>
body{
    margin:0;
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
}
.container{
    max-width:720px;
    margin:40px auto;
    padding:0 15px;
}
.card{
    background:#fff;
    border-radius:14px;
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,.12);
}
h2{
    margin:0 0 20px;
    font-size:20px;
}
.form-group{
    margin-bottom:14px;
}
label{
    display:block;
    font-size:13px;
    font-weight:600;
    margin-bottom:5px;
}
input, textarea{
    width:100%;
    padding:9px 11px;
    font-size:13px;
    border:1px solid #ccc;
    border-radius:7px;
}
textarea{
    min-height:70px;
}
.image-box{
    text-align:center;
    margin-top:20px;
    padding-top:15px;
    border-top:1px dashed #ddd;
}
.image-box input{
    margin-top:8px;
}
.actions{
    display:flex;
    justify-content:space-between;
    margin-top:25px;
}
button{
    background:#009688;
    color:#fff;
    border:none;
    padding:9px 22px;
    border-radius:7px;
    cursor:pointer;
}
.back{
    text-decoration:none;
    font-size:13px;
    color:#555;
}
</style>
</head>

<body>

<div class="container">
<div class="card">

<h2>👤 উদ্যোক্তা যোগ করুন</h2>

<form method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>নাম</label>
        <input type="text" name="name" required>
    </div>

    <div class="form-group">
        <label>ফেইজের নাম</label>
        <input type="text" name="father_name">
    </div>

    <div class="form-group">
        <label>ঠিকানা</label>
        <textarea name="address"></textarea>
    </div>

    <div class="form-group">
        <label>মোবাইল</label>
        <input type="text" name="mobile">
    </div>

    <div class="form-group">
        <label>ফেসবুক লিংক</label>
        <input type="text" name="facebook">
    </div>

    <div class="form-group">
        <label>ওয়েবসাইট লিংক</label>
        <input type="text" name="website">
    </div>

    <div class="image-box">
        <label>ছবি</label>
        <input type="file" name="image">
    </div>

    <div class="actions">
        <a class="back" href="uddokta_list.php">← Back</a>
        <button name="save">Save</button>
    </div>

</form>

</div>
</div>

</body>
</html>
