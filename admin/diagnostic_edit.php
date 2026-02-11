<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];
$res = mysqli_query($conn,"SELECT * FROM diagnostic WHERE id='$id'");
$data = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $name    = $_POST['name'];
    $address = $_POST['address'];
    $mobile  = $_POST['mobile'];
    $email   = $_POST['email'];

    if($_FILES['photo']['name']){
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/diagnostic/".$photo);
        mysqli_query($conn,"UPDATE diagnostic SET photo='$photo' WHERE id='$id'");
    }

    mysqli_query($conn,"UPDATE diagnostic SET
        name='$name',
        address='$address',
        mobile='$mobile',
        email='$email'
        WHERE id='$id'
    ");
    header("location: diagnostic_list.php");
}
?>

<form method="post" enctype="multipart/form-data">
    <input name="name" value="<?= $data['name'] ?>"><br><br>
    <textarea name="address"><?= $data['address'] ?></textarea><br><br>
    <input name="mobile" value="<?= $data['mobile'] ?>"><br><br>
    <input name="email" value="<?= $data['email'] ?>"><br><br>

    <img src="../uploads/diagnostic/<?= $data['photo'] ?>" width="80"><br>
    <input type="file" name="photo"><br><br>

    <button name="update">Update</button>
</form>
