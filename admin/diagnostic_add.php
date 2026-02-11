<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if (isset($_POST['save'])) {

    $name    = $_POST['name'];
    $address = $_POST['address'];
    $mobile  = $_POST['mobile'];
    $email   = $_POST['email'];

    /* ---------- IMAGE UPLOAD (FIXED) ---------- */
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

        $uploadDir = "../uploads/diagnostic/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmpPath, $uploadDir . $photoName);
    }
    /* ---------- IMAGE UPLOAD END ---------- */

    mysqli_query($conn, "INSERT INTO diagnostic
    (name, address, mobile, email, photo)
    VALUES
    ('$name','$address','$mobile','$email','$photoName')");

    header("location: diagnostic_list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add diagnostic</title>
</head>
<body>

<h2>Add diagnostic</h2>
<form method="post" enctype="multipart/form-data">
    <input name="name" placeholder="নাম" required><br><br>
    <textarea name="address" placeholder="ঠিকানা"></textarea><br><br>
    <input name="mobile" placeholder="মোবাইল নাম্বার"><br><br>
    <input type="email" name="email" placeholder="ইমেইল"><br><br>
    <input type="file" name="photo" 
           accept="image/jpeg,image/jpg,image/png,image/webp" required><br><br>
    <button name="save">Save diagnostic</button>
</form>

</body>
</html>
