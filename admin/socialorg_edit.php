<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM socialorg WHERE id='$id'");
$data = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){

    $organization = $_POST['organization'];
    $name         = $_POST['name'];
    $address      = $_POST['address'];
    $mobile       = $_POST['mobile'];
    $email        = $_POST['email'];
    $experience   = $_POST['experience']; // ✅ semicolon fixed

    // photo update
    if(!empty($_FILES['photo']['name'])){
        $photo = time().'_'.$_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/socialorg/".$photo);
        mysqli_query($conn, "UPDATE socialorg SET photo='$photo' WHERE id='$id'");
    }

    // data update
    mysqli_query($conn, "UPDATE socialorg SET
        organization='$organization',
        name='$name',
        address='$address',
        mobile='$mobile',
        email='$email',
        experience='$experience'
        WHERE id='$id'
    ");

    header("location: socialorg_list.php");
    exit;
}
?>

<form method="post" enctype="multipart/form-data">
    <input name="organization" value="<?= $data['organization'] ?>"><br><br>
    <input name="name" value="<?= $data['name'] ?>"><br><br>

    <textarea name="address"><?= $data['address'] ?></textarea><br><br>

    <input name="mobile" value="<?= $data['mobile'] ?>"><br><br>
    <input name="email" value="<?= $data['email'] ?>"><br><br>
    <input name="experience" value="<?= $data['experience'] ?>"><br><br>

    <img src="../uploads/socialorg/<?= $data['photo'] ?>" width="80"><br>
    <input type="file" name="photo"><br><br>

    <button name="update">Update</button>
</form>
