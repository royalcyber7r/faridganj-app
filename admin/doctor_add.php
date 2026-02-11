<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    $name       = $_POST['name'];
    $department = $_POST['department'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];
    $email      = $_POST['email'];
    $facebook   = $_POST['facebook'];

    // ================= IMAGE UPLOAD =================
    $photo_name = "";

    if(!empty($_FILES['photo']['name'])){

        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','webp'];

        if(in_array(strtolower($ext), $allowed)){

            $photo_name = time().'_'.rand(1000,9999).'.'.$ext;

            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                "../uploads/doctors/".$photo_name
            );
        }
    }

    // ================= INSERT =================
    $sql = "INSERT INTO doctors 
            (name, department, phone, address, email, facebook, photo)
            VALUES 
            ('$name','$department','$phone','$address','$email','$facebook','$photo_name')";

    if(mysqli_query($conn, $sql)){
        header("Location: doctor_list.php");
        exit;
    }else{
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add Doctor</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
}
.container{
    width:420px;
    margin:40px auto;
    background:#fff;
    padding:20px;
    border-radius:8px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}
h2{text-align:center;}
input, textarea, button{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border:1px solid #ccc;
    border-radius:5px;
}
button{
    background:#0d6efd;
    color:#fff;
    border:none;
}
</style>
</head>

<body>

<div class="container">
    <h2>➕ Add Doctor</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Doctor Name" required>
        <input type="text" name="department" placeholder="Department" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <textarea name="address" placeholder="Address" required></textarea>
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="facebook" placeholder="Facebook Profile Link">
        <input type="file" name="photo" accept="image/*">
        <button type="submit" name="save">Save Doctor</button>
    </form>

    <a href="doctor_list.php">← Back</a>
</div>

</body>
</html>
