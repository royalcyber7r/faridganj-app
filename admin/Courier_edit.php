<?php
require_once "admin_guard.php";
require_once "../db.php";

// Get the id from the URL
$id = $_GET['id'];

// Fetch the existing courier details from the database
$res = mysqli_query($conn, "SELECT * FROM courier_companies WHERE id='$id'");
$data = mysqli_fetch_assoc($res);

// If the update form is submitted
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $facebook_link = $_POST['facebook_link'];

    // Image upload check
    if ($_FILES['photo']['name']) {
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/courier/" . $photo);
        mysqli_query($conn, "UPDATE courier_companies SET photo='$photo' WHERE id='$id'");
    }

    // Update the rest of the information
    mysqli_query($conn, "UPDATE courier_companies SET
        name='$name',
        phone='$phone',
        address='$address',
        email='$email',
        facebook_link='$facebook_link'
        WHERE id='$id'
    ");
    // Redirect to the courier list page after successful update
    header("location: courier_list.php");
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Update Courier Service</title>
</head>
<body>

<h2>কুরিয়ার সার্ভিস আপডেট করুন</h2>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="সার্ভিস/প্রতিষ্ঠানের নাম" required><br><br>
    <input type="text" name="phone" value="<?= $data['phone'] ?>" placeholder="মোবাইল নাম্বার" required><br><br>
    <textarea name="address" placeholder="ঠিকানা" required><?= $data['address'] ?></textarea><br><br>
    <input type="email" name="email" value="<?= $data['email'] ?>" placeholder="ইমেইল" required><br><br>
    <input type="text" name="facebook_link" value="<?= $data['facebook_link'] ?>" placeholder="ফেসবুক লিংক"><br><br>

    <!-- Display the existing photo -->
    <img src="../uploads/courier/<?= $data['photo'] ?>" width="80"><br>
    <input type="file" name="photo"><br><br>

    <button name="update">আপডেট করুন</button>
</form>

</body>
</html>
