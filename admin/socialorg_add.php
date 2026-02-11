<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if (isset($_POST['save'])) {

    $organization = $_POST['organization'];
    $name         = $_POST['name'];
    $address      = $_POST['address'];
    $mobile       = $_POST['mobile'];
    $email        = $_POST['email'];
    $experience   = $_POST['experience'];

    /* IMAGE UPLOAD */
    $photoName = "";

    if (!empty($_FILES['photo']['name'])) {

        $allowedTypes = ['image/jpeg','image/png','image/webp'];
        $tmpPath = $_FILES['photo']['tmp_name'];
        $mime    = mime_content_type($tmpPath);

        if (!in_array($mime, $allowedTypes)) {
            die("শুধু JPG, PNG, WEBP ছবি আপলোড করা যাবে");
        }

        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time().'_'.rand(1000,9999).'.'.$ext;

        $dir = "../uploads/socialorg/";
        if (!is_dir($dir)) mkdir($dir,0777,true);

        move_uploaded_file($tmpPath, $dir.$photoName);
    }

    mysqli_query($conn,"INSERT INTO socialorg
    (organization,name,address,mobile,email,experience,photo)
    VALUES
    ('$organization','$name','$address','$mobile','$email','$experience','$photoName')");

    header("Location: socialorg_list.php");
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add Social Organization</title>

<style>
*{ box-sizing:border-box; font-family:Arial, sans-serif; }

body{
    background:#f4f6f9;
    margin:0;
    padding:0;
}

.container{
    max-width:650px;
    margin:40px auto;
    padding:20px;
}

.card{
    background:#fff;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
    padding:30px;
}

.card h2{
    text-align:center;
    margin-bottom:25px;
}

/* Form */
.form-group{
    margin-bottom:16px;
}
label{
    display:block;
    font-weight:bold;
    margin-bottom:6px;
}
input, textarea{
    width:100%;
    padding:10px 12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
}
textarea{
    resize:vertical;
    min-height:80px;
}

input:focus, textarea:focus{
    outline:none;
    border-color:#2563eb;
}

/* Button */
.btn{
    width:100%;
    background:#2563eb;
    color:#fff;
    border:none;
    padding:12px;
    font-size:16px;
    border-radius:10px;
    cursor:pointer;
}
.btn:hover{
    background:#1e40af;
}

/* Back link */
.back{
    text-align:center;
    margin-top:15px;
}
.back a{
    text-decoration:none;
    color:#2563eb;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="container">
    <div class="card">
        <h2>➕ নতুন সামাজিক সংগঠন যোগ করুন</h2>

        <form method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label>প্রতিষ্ঠানের নাম</label>
                <input name="organization" required>
            </div>

            <div class="form-group">
                <label>দায়িত্বশীল ব্যক্তির নাম</label>
                <input name="name" required>
            </div>

            <div class="form-group">
                <label>ঠিকানা</label>
                <textarea name="address"></textarea>
            </div>

            <div class="form-group">
                <label>মোবাইল নাম্বার</label>
                <input name="mobile">
            </div>

            <div class="form-group">
                <label>ইমেইল</label>
                <input type="email" name="email">
            </div>

            <div class="form-group">
                <label>অভিজ্ঞতা (যেমন: ১০ বছর)</label>
                <input name="experience" required>
            </div>

            <div class="form-group">
                <label>প্রোফাইল ছবি / লোগো</label>
                <input type="file" name="photo"
                accept="image/jpeg,image/png,image/webp" required>
            </div>

            <button class="btn" name="save">💾 Save socialorg</button>
        </form>

        <div class="back">
            <a href="socialorg_list.php">← Back to list</a>
        </div>
    </div>
</div>

</body>
</html>
