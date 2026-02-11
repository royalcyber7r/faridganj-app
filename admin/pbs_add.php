<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    // Upload directory
    $uploadDir = "../uploads/pbs/";
    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    // Image upload
    $imageName = "";
    if(!empty($_FILES['image']['name'])){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = time()."_pbs_".rand(100,999).".".$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir.$imageName);
    }

    // Insert data
    $stmt = $conn->prepare(
        "INSERT INTO pbs
        (office_name, name, designation, mobile, address, email, image)
        VALUES (?,?,?,?,?,?,?)"
    );

    $stmt->bind_param(
        "sssssss",
        $_POST['office_name'],
        $_POST['name'],
        $_POST['designation'],
        $_POST['mobile'],
        $_POST['address'],
        $_POST['email'],
        $imageName
    );

    $stmt->execute();

    header("Location: pbs_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>বিদ্যুৎ অফিস যোগ করুন</title>

<style>
*{box-sizing:border-box}
body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#f2f5f9;
}
.wrapper{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}
.card{
    width:100%;
    max-width:520px;
    background:#fff;
    padding:28px;
    border-radius:18px;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}
.card h2{
    text-align:center;
    color:#009688;
    margin-bottom:22px;
}
label{
    font-weight:bold;
    font-size:14px;
    margin-top:14px;
    display:block;
}
input, textarea{
    width:100%;
    padding:12px;
    margin-top:6px;
    border-radius:10px;
    border:1px solid #ccc;
    font-size:14px;
}
input:focus, textarea:focus{
    border-color:#009688;
    outline:none;
}
textarea{
    resize:none;
    min-height:80px;
}

.upload-box{
    margin-top:20px;
    padding:20px;
    border:2px dashed #009688;
    border-radius:14px;
    text-align:center;
    background:#f9fffe;
}
.upload-box input{
    border:none;
}
.upload-box span{
    display:block;
    margin-top:6px;
    color:#666;
    font-size:13px;
}

button{
    width:100%;
    margin-top:24px;
    padding:14px;
    background:#009688;
    color:#fff;
    border:none;
    border-radius:12px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}
button:hover{
    background:#007f73;
}
</style>
</head>

<body>

<div class="wrapper">
    <div class="card">
        <h2>⚡ বিদ্যুৎ অফিস যোগ করুন</h2>

        <form method="post" enctype="multipart/form-data">

            <label>অফিসের নাম</label>
            <input name="office_name" placeholder="PBS অফিসের নাম" required>

            <label>দায়িত্বপ্রাপ্ত ব্যক্তির নাম</label>
            <input name="name" placeholder="নাম লিখুন" required>

            <label>পদবী</label>
            <input name="designation" placeholder="যেমন: ম্যানেজার / ইঞ্জিনিয়ার" required>

            <label>মোবাইল</label>
            <input name="mobile" placeholder="01XXXXXXXXX" required>

            <label>ঠিকানা</label>
            <textarea name="address" placeholder="পূর্ণ ঠিকানা লিখুন" required></textarea>

            <label>ইমেইল</label>
            <input name="email" placeholder="example@email.com">

            <div class="upload-box">
                <input type="file" name="image" accept="image/*" required>
                <span>📷 অফিসের ছবি আপলোড করুন</span>
            </div>

            <button name="save">✅ Save</button>

        </form>
    </div>
</div>

</body>
</html>
