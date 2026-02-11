<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if (isset($_POST['save'])) {

    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);
    $mobile   = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);

    $image = NULL;

    /* ===== IMAGE UPLOAD ===== */
    if (!empty($_FILES['image']['name'])) {

        $uploadDir = "../uploads/hospital/";

        // Folder না থাকলে অটো তৈরি হবে
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $allowedExt = ['jpg','jpeg','png','webp'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if (in_array($ext, $allowedExt)) {

            $image = time() . rand(1000, 9999) . "." . $ext;

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $uploadDir . $image
            );
        }
    }

    /* ===== INSERT DATA ===== */
    mysqli_query($conn, "
        INSERT INTO hospitals (image, name, address, mobile, email, facebook)
        VALUES ('$image', '$name', '$address', '$mobile', '$email', '$facebook')
    ");

    header("Location: hospital_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add Hospital</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, sans-serif;
}
.container{
    max-width:520px;
    margin:40px auto;
}
.card{
    background:#fff;
    padding:25px;
    border-radius:16px;
    box-shadow:0 12px 30px rgba(0,0,0,.15);
}
.card h2{
    text-align:center;
    margin-bottom:25px;
}
.form-group{
    margin-bottom:14px;
}
.form-group input,
.form-group textarea{
    width:100%;
    padding:11px 14px;
    border:1px solid #ccc;
    border-radius:9px;
    font-size:14px;
}
.form-group textarea{
    resize:none;
    height:90px;
}
.image-box{
    margin-top:20px;
    text-align:center;
}
.preview{
    width:100%;
    height:180px;
    border:2px dashed #009688;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:12px;
    overflow:hidden;
}
.preview img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:none;
}
.image-box input{
    display:none;
}
.image-box label{
    display:inline-block;
    padding:10px 18px;
    background:#009688;
    color:#fff;
    border-radius:8px;
    cursor:pointer;
}
.image-box small{
    display:block;
    margin-top:6px;
    color:#777;
}
.btn{
    margin-top:18px;
    width:100%;
    padding:13px;
    background:#009688;
    border:none;
    color:#fff;
    font-size:15px;
    border-radius:10px;
    cursor:pointer;
}
.btn:hover{
    background:#00796b;
}
</style>
</head>

<body>

<div class="container">
<div class="card">

<h2>🏥 নতুন হাসপাতাল যোগ করুন</h2>

<form method="post" enctype="multipart/form-data">

    <div class="form-group">
        <input type="text" name="name" placeholder="হাসপাতাল নাম" required>
    </div>

    <div class="form-group">
        <textarea name="address" placeholder="ঠিকানা" required></textarea>
    </div>

    <div class="form-group">
        <input type="text" name="mobile" placeholder="মোবাইল নাম্বার" required>
    </div>

    <div class="form-group">
        <input type="email" name="email" placeholder="ইমেইল (ঐচ্ছিক)">
    </div>

    <div class="form-group">
        <input type="text" name="facebook" placeholder="ফেসবুক লিংক (ঐচ্ছিক)">
    </div>

    <div class="image-box">
        <div class="preview">
            <img id="previewImg">
            <span id="previewText">📷 হাসপাতালের ছবি</span>
        </div>

        <label for="image">ছবি নির্বাচন করুন</label>
        <input type="file" id="image" name="image" accept="image/*">
        <small>PNG / JPG / JPEG / WEBP</small>
    </div>

    <button class="btn" name="save">💾 Save Hospital</button>

</form>

</div>
</div>

<script>
const imageInput = document.getElementById('image');
const previewImg = document.getElementById('previewImg');
const previewText = document.getElementById('previewText');

imageInput.onchange = e => {
    const file = e.target.files[0];
    if (file) {
        previewImg.src = URL.createObjectURL(file);
        previewImg.style.display = 'block';
        previewText.style.display = 'none';
    }
}
</script>

</body>
</html>
