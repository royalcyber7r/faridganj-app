<?php
require_once "admin_guard.php";
require_once "../db.php";

if(!isset($_GET['id'])) die("Invalid ID");
$id = intval($_GET['id']);

$res = mysqli_query($conn,"SELECT * FROM restaurant WHERE id=$id");
if(mysqli_num_rows($res)==0) die("Not Found");
$data = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){

    $restaurant_name = mysqli_real_escape_string($conn,$_POST['restaurant_name']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $email  = mysqli_real_escape_string($conn,$_POST['email']);
    $food_list = mysqli_real_escape_string($conn,$_POST['food_list']);

    if(!empty($_FILES['image']['name'])){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $img = time().'_'.rand(1000,9999).".".$ext;
        move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/restaurants/".$img);
        mysqli_query($conn,"UPDATE restaurant SET image='$img' WHERE id=$id");
    }

    mysqli_query($conn,"UPDATE restaurant SET
        restaurant_name='$restaurant_name',
        mobile='$mobile',
        email='$email',
        food_list='$food_list'
        WHERE id=$id");

    header("location: restaurant_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Restaurant</title>
</head>
<body>

<h2>Edit Restaurant</h2>

<form method="post" enctype="multipart/form-data">
    <input name="restaurant_name" value="<?= $data['restaurant_name'] ?>"><br><br>
    <input name="mobile" value="<?= $data['mobile'] ?>"><br><br>
    <input name="email" value="<?= $data['email'] ?>"><br><br>
    <textarea name="food_list"><?= $data['food_list'] ?></textarea><br><br>

    <img src="../uploads/restaurants/<?= $data['image'] ?>" width="80"><br>
    <input type="file" name="image"><br><br>

    <button name="update">Update</button>
</form>

</body>
</html>
