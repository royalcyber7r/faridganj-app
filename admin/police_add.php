<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if (isset($_POST['save'])) {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $qualification = $_POST['qualification'];
    $email = $_POST['email'];

    /* ---------- IMAGE UPLOAD (FIXED) ---------- */
    $photoName = "";

    if (!empty($_FILES['photo']['name'])) {

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        $tmpPath = $_FILES['photo']['tmp_name'];
        $mimeType = mime_content_type($tmpPath);

        if (!in_array($mimeType, $allowedTypes)) {
            die("❌ শুধু JPG, JPEG, PNG, WEBP ছবি আপলোড করা যাবে");
        }

        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time() . "_" . rand(1000,9999) . "." . $ext;

        $uploadDir = "../uploads/police/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmpPath, $uploadDir . $photoName);
    }
    /* ---------- IMAGE UPLOAD END ---------- */

    mysqli_query($conn, "INSERT INTO police
    (name, address, department, phone, qualification, email, photo)
    VALUES
    ('$name','$address','$department','$phone','$qualification','$email','$photoName')");

    header("location: police_list.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Add police</title>
</head>
<body>


<h2>Add Police</h2>
<form method="post" enctype="multipart/form-data">
    <input name="name" placeholder="নাম" required><br><br>
    <textarea name="address" placeholder="ঠিকানা"></textarea><br><br>
    <input name="department" placeholder="ডিপার্টমেন্ট"><br><br>
    <input name="phone" placeholder="মোবাইল নাম্বার"><br><br>
    <input name="qualification" placeholder="শিক্ষাগত যোগ্যতা"><br><br>
    <input type="email" name="email" placeholder="ইমেইল"><br><br>
    <input type="file" name="photo" 
           accept="image/jpeg,image/jpg,image/png,image/webp" required><br><br>
    <button name="save">Save police</button>
</form>

</body>
</html>
