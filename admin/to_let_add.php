<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    $stmt = $conn->prepare(
        "INSERT INTO to_let
        (house_type, area, rooms, washroom, rent, phone, address, google_map_link)
        VALUES (?,?,?,?,?,?,?,?)"
    );

    $stmt->bind_param(
        "ssssssss",
        $_POST['house_type'],
        $_POST['area'],
        $_POST['rooms'],
        $_POST['washroom'],
        $_POST['rent'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['google_map_link']
    );

    $stmt->execute();
    $to_let_id = $conn->insert_id;

    /* ===== IMAGE UPLOAD ===== */
    for($i=1; $i<=5; $i++){
        if(!empty($_FILES["image$i"]['name'])){

            $img = $_FILES["image$i"]['name'];
            $tmp = $_FILES["image$i"]['tmp_name'];
            $ext = pathinfo($img, PATHINFO_EXTENSION);
            $new = time()."_".$i."_".rand(100,999).".".$ext;

            move_uploaded_file($tmp,"../uploads/".$new);

            $conn->query(
                "INSERT INTO to_let_images (to_let_id,image)
                 VALUES ($to_let_id,'$new')"
            );
        }
    }

    header("Location: to_let_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add To Let</title>

<style>
body{
    font-family:Arial;
    background:#f4f6f9;
    padding:30px
}
.box{
    max-width:520px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
h2{color:#009688;margin-bottom:20px}
label{
    font-weight:bold;
    display:block;
    margin-top:12px;
}
input,textarea{
    width:100%;
    padding:11px;
    margin-top:5px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}
textarea{resize:none}
button{
    width:100%;
    margin-top:20px;
    padding:14px;
    background:#009688;
    color:#fff;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
}
small{color:#666}
</style>
</head>

<body>

<div class="box">
<h2>🏠 নতুন বাসা যোগ করুন</h2>

<form method="post" enctype="multipart/form-data">

<label>বাসার ধরন</label>
<input name="house_type" required>

<label>আয়তন (বর্গফুট)</label>
<input name="area" required>

<label>রুম সংখ্যা</label>
<input name="rooms" required>

<label>বাথরুম সংখ্যা</label>
<input name="washroom" required>

<label>ভাড়া (টাকা)</label>
<input name="rent" required>

<label>মোবাইল নাম্বার</label>
<input name="phone" required>

<label>ঠিকানা</label>
<textarea name="address" required></textarea>

<label>🗺️ Google Map Link</label>
<input name="google_map_link" placeholder="https://maps.google.com/..." required>
<small>Google Map থেকে Share → Copy link</small>

<label>📷 ছবি ১</label>
<input type="file" name="image1" accept="image/*">

<label>📷 ছবি ২</label>
<input type="file" name="image2" accept="image/*">

<label>📷 ছবি ৩</label>
<input type="file" name="image3" accept="image/*">

<label>📷 ছবি ৪</label>
<input type="file" name="image4" accept="image/*">

<label>📷 ছবি ৫</label>
<input type="file" name="image5" accept="image/*">

<button name="save">✅ Save</button>

</form>
</div>

</body>
</html>
