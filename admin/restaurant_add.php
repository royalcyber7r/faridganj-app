<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    $restaurant_name = mysqli_real_escape_string($conn,$_POST['restaurant_name']);
    $mobile     = mysqli_real_escape_string($conn,$_POST['mobile']);
    $email      = mysqli_real_escape_string($conn,$_POST['email']);
    $food_list  = mysqli_real_escape_string($conn,$_POST['food_list']);

    $imageName = "";

    if(!empty($_FILES['image']['name'])){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = time().'_'.rand(1000,9999).".".$ext;

        $dir = "../uploads/restaurants/";
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }

        move_uploaded_file($_FILES['image']['tmp_name'], $dir.$imageName);
    }

    mysqli_query($conn,"INSERT INTO restaurant
    (restaurant_name,mobile,email,food_list,image)
    VALUES
    ('$restaurant_name','$mobile','$email','$food_list','$imageName')");

    header("location: restaurant_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Restaurant</title>
</head>
<body>

<h2>Add Restaurant</h2>

<form method="post" enctype="multipart/form-data">
    <input name="restaurant_name" placeholder="Restaurant Name" required><br><br>
    <input name="mobile" placeholder="Mobile"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <textarea name="food_list" placeholder="Food List"></textarea><br><br>
    <input type="file" name="image"><br><br>
    <button name="save">Save Restaurant</button>
</form>

</body>
</html>
