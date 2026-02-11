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

        $uploadDir = "../uploads/Wedding/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmpPath, $uploadDir . $photoName);
    }
    /* ---------- IMAGE UPLOAD END ---------- */

    mysqli_query($conn, "INSERT INTO wedding
    (organization, name, address, mobile, email, experience, photo)
    VALUES
    ('$organization','$name','$address','$mobile','$email','$experience','$photoName')");

    header("location: Wedding_list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Wedding</title>
</head>
<body>

<h2>Add Wedding</h2>
<form method="post" enctype="multipart/form-data">
    <input name="organization" placeholder="প্রতিষ্ঠানের নাম" required><br><br>

    <input name="name" placeholder="নাম" required><br><br>

    <textarea name="address" placeholder="ঠিকানা"></textarea><br><br>

    <input name="mobile" placeholder="মোবাইল নাম্বার"><br><br>

    <input type="email" name="email" placeholder="ইমেইল"><br><br>

    <input name="experience" placeholder="অভিজ্ঞতা (যেমন: ১০ বছর)" required><br><br>

    <input type="file" name="photo"
           accept="image/jpeg,image/jpg,image/png,image/webp" required><br><br>

    <button name="save">Save Wedding</button>
</form>

</body>
</html>
