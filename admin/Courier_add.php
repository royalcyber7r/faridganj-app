<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if (isset($_POST['save'])) {
    // Sanitize and fetch data from form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $facebook_link = mysqli_real_escape_string($conn, $_POST['facebook_link']);

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
        $uploadDir = "../uploads/courier/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmpPath, $uploadDir . $photoName);
    }

    // Insert data into courier_companies table
    $query = "INSERT INTO courier_companies (name, address, mobile, email, facebook_link, photo) 
              VALUES ('$name', '$address', '$mobile', '$email', '$facebook_link', '$photoName')";

    if (mysqli_query($conn, $query)) {
        header("Location: courier_list.php");  // Redirect after saving
    } else {
        die("Error inserting data: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Add New Courier</title>
</head>
<body>
    <h2>Add New Courier</h2>
    <form method="post" enctype="multipart/form-data">
        <input name="name" placeholder="Courier Name" required><br><br>
        <textarea name="address" placeholder="Address" required></textarea><br><br>
        <input name="mobile" placeholder="Mobile Number" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input name="facebook_link" placeholder="Facebook Link" required><br><br>
        
        <!-- Photo upload -->
        <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png,image/webp" required><br><br>
        
        <button name="save">Save Courier</button>
    </form>
</body>
</html>
