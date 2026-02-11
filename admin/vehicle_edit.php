<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM vehicle_rent WHERE id='$id'");
$data = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {
    $name         = $_POST['name'];
    $vehicle_type = $_POST['vehicle_type'];
    $address      = $_POST['address'];
    $mobile       = $_POST['mobile'];
    $email        = $_POST['email'];
    $facebook_link = $_POST['facebook_link']; // Added Facebook link

    // ফটো আপলোড চেক
    if ($_FILES['photo']['name']) {
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/vehicle/" . $photo);
        mysqli_query($conn, "UPDATE vehicle_rent SET photo='$photo' WHERE id='$id'");
    }

    // Update the vehicle details including the Facebook link
    mysqli_query($conn, "UPDATE vehicle_rent SET
        name='$name',
        vehicle_type='$vehicle_type',
        address='$address',
        mobile='$mobile',
        email='$email',
        facebook_link='$facebook_link'  // Added the Facebook link update
        WHERE id='$id'
    ");
    header("location: vehicle_list.php");
}
?>

<form method="post" enctype="multipart/form-data">
    <input name="name" value="<?= $data['name'] ?>" placeholder="নাম" required><br><br>

    <select name="vehicle_type" required>
        <option value="private_car" <?= $data['vehicle_type'] == 'private_car' ? 'selected' : '' ?>>প্রাইভেটকার</option>
        <option value="microbus" <?= $data['vehicle_type'] == 'microbus' ? 'selected' : '' ?>>মাইক্রো বাস</option>
        <option value="pickup" <?= $data['vehicle_type'] == 'pickup' ? 'selected' : '' ?>>পিকাপ</option>
        <option value="truck" <?= $data['vehicle_type'] == 'truck' ? 'selected' : '' ?>>ট্রাক</option>
        <option value="van" <?= $data['vehicle_type'] == 'van' ? 'selected' : '' ?>>ভ্যান</option>
    </select><br><br>

    <textarea name="address" placeholder="ঠিকানা" required><?= $data['address'] ?></textarea><br><br>
    <input name="mobile" value="<?= $data['mobile'] ?>" placeholder="মোবাইল নাম্বার" required><br><br>
    <input type="email" name="email" value="<?= $data['email'] ?>" placeholder="ইমেইল" required><br><br>

    <!-- Added Facebook link input field -->
    <input name="facebook_link" value="<?= $data['facebook_link'] ?>" placeholder="Facebook Link" /><br><br>

    <img src="../uploads/vehicle/<?= $data['photo'] ?>" width="80"><br>
    <input type="file" name="photo"><br><br>

    <button name="update">আপডেট করুন</button>
</form>
