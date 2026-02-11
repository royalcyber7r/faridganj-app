<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if (isset($_POST['save'])) {

    $hotel_name = $_POST['hotel_name'];
    $mobile     = $_POST['mobile'];
    $email      = $_POST['email'];
    $food_list  = $_POST['food_list'];

    /* ---------- IMAGE UPLOAD ---------- */
    $imageName = "";

    if (!empty($_FILES['image']['name'])) {

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        $tmpPath  = $_FILES['image']['tmp_name'];
        $mimeType = mime_content_type($tmpPath);

        if (!in_array($mimeType, $allowedTypes)) {
            die("❌ শুধু JPG, PNG, WEBP ছবি আপলোড করা যাবে");
        }

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = time() . "_" . rand(1000,9999) . "." . $ext;

        $uploadDir = "../uploads/hotels/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmpPath, $uploadDir . $imageName);
    }
    /* ---------- IMAGE UPLOAD END ---------- */

    $sql = "INSERT INTO hotel
    (hotel_name, mobile, email, food_list, image)
    VALUES
    ('$hotel_name','$mobile','$email','$food_list','$imageName')
";

$result = mysqli_query($conn, $sql);

if(!$result){
    die("Insert Failed: " . mysqli_error($conn));
}

header("location: hotel_list.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add Hotel</title>
</head>

<body>

<h2>Add Hotel</h2>

<form method="post" enctype="multipart/form-data">

    <input name="hotel_name" placeholder="হোটেলের নাম" required><br><br>

    <input name="mobile" placeholder="মোবাইল নাম্বার" required><br><br>

    <input type="email" name="email" placeholder="ইমেইল"><br><br>

    <textarea name="food_list" placeholder="খাবারের তালিকা (কমা দিয়ে লিখুন)" required></textarea><br><br>

    <input type="file" name="image"
           accept="image/jpeg,image/png,image/webp" required><br><br>

    <button name="save">Save Hotel</button>
</form>

</body>
</html>
