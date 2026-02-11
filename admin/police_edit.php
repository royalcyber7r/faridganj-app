<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];
$res = mysqli_query($conn,"SELECT * FROM police WHERE docid='$id'");
$data = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $qualification = $_POST['qualification'];
    $email = $_POST['email'];

    if($_FILES['photo']['name']){
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/police/".$photo);
        mysqli_query($conn,"UPDATE police SET photo='$photo' WHERE docid='$id'");
    }

    mysqli_query($conn,"UPDATE police SET
        name='$name',
        address='$address',
        department='$department',
        phone='$phone',
        qualification='$qualification',
        email='$email'
        WHERE docid='$id'
    ");
    header("location: police_list.php");
}
?>

<form method="post" enctype="multipart/form-data">
    <input name="name" value="<?= $data['name'] ?>"><br><br>
    <textarea name="address"><?= $data['address'] ?></textarea><br><br>
    <input name="department" value="<?= $data['department'] ?>"><br><br>
    <input name="phone" value="<?= $data['phone'] ?>"><br><br>
    <input name="qualification" value="<?= $data['qualification'] ?>"><br><br>
    <input name="email" value="<?= $data['email'] ?>"><br><br>
    <img src="../uploads/police/<?= $data['photo'] ?>" width="80"><br>
    <input type="file" name="photo"><br><br>
    <button name="update">Update</button>
</form>
