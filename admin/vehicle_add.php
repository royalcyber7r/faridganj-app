<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

// Handling form submission to save vehicle data
if (isset($_POST['save'])) {
    // Sanitize input to prevent SQL injection
    $name           = mysqli_real_escape_string($conn, $_POST['name']);
    $vehicle_type   = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
    $address        = mysqli_real_escape_string($conn, $_POST['address']);
    $vehicle_number = mysqli_real_escape_string($conn, $_POST['vehicle_number']);
    $mobile         = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $facebook_link  = mysqli_real_escape_string($conn, $_POST['facebook_link']);  // Facebook link

    // Image upload logic
    $photoName = "";
    if (!empty($_FILES['photo']['name'])) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $tmpPath = $_FILES['photo']['tmp_name'];
        $mimeType = mime_content_type($tmpPath);

        if (!in_array($mimeType, $allowedImageTypes)) {
            die("❌ Only JPG, JPEG, PNG, WEBP images are allowed.");
        }

        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time() . "_" . rand(1000, 9999) . "." . $ext;
        $uploadDir = "../uploads/vehicle/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmpPath, $uploadDir . $photoName);
    }

    // Insert data into the database
    $query = "INSERT INTO vehicle_rent (name, vehicle_type, address, vehicle_number, mobile, email, photo, facebook_link) 
              VALUES ('$name', '$vehicle_type', '$address', '$vehicle_number', '$mobile', '$email', '$photoName', '$facebook_link')";

    if (mysqli_query($conn, $query)) {
        header("Location: vehicle_list.php");  // Redirect after saving
    } else {
        die("Error inserting data: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
</head>
<body>

<h2>Add Vehicle</h2>
<form method="post" enctype="multipart/form-data">
    <input name="name" placeholder="নাম" required><br><br>

    <select name="vehicle_type" required>
        <option value="private_car">প্রাইভেটকার</option>
        <option value="microbus">মাইক্রো বাস</option>
        <option value="pickup">পিকাপ</option>
        <option value="truck">ট্রাক</option>
        <option value="van">ভ্যান</option>
    </select><br><br>

    <input name="vehicle_number" placeholder="গাড়ির নাম্বার" required><br><br>
    <textarea name="address" placeholder="ঠিকানা" required></textarea><br><br>
    <input name="mobile" placeholder="মোবাইল নাম্বার" required><br><br>
    <input type="email" name="email" placeholder="ইমেইল" required><br><br>

    <!-- Facebook Link Input -->
    <input type="url" name="facebook_link" placeholder="ফেসবুক লিংক"><br><br>

    <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png,image/webp" required><br><br>

    <button name="save">Save Vehicle</button>
</form>

</body>
</html>
