<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    // ✅ Secure input
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $phone      = mysqli_real_escape_string($conn, $_POST['phone']);
    $address    = mysqli_real_escape_string($conn, $_POST['address']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $facebook   = mysqli_real_escape_string($conn, $_POST['facebook']);

    $photo = NULL;

    // ✅ Upload folder (absolute safe path)
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/faridganj-app/uploads/workers/";

    // Auto create folder
    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    // ✅ Image upload check
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === 0){

        $allowedExt = ['jpg','jpeg','png','webp'];
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if(in_array($ext, $allowedExt)){

            // Unique image name
            $photo = uniqid("worker_", true) . "." . $ext;

            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                $uploadDir . $photo
            );
        }
    }

    // ✅ Insert query
    $sql = "INSERT INTO workers
        (name, department, phone, address, email, facebook, photo)
        VALUES
        ('$name','$department','$phone','$address','$email','$facebook','$photo')";

    mysqli_query($conn, $sql);

    header("Location: worker_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add Worker</title>

<style>
body{
    font-family:Arial;
    background:#f4f6f9;
}
.container{
    width:420px;
    margin:40px auto;
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}
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
    cursor:pointer;
}
</style>
</head>

<body>

<div class="container">
    <h2>➕ Add Worker</h2>

    <form method="post" enctype="multipart/form-data">

        <input type="text" name="name" placeholder="Worker Name" required>

        <input type="text" name="department" placeholder="Department" required>

        <input type="text" name="phone" placeholder="Phone" required>

        <textarea name="address" placeholder="Address"></textarea>

        <input type="email" name="email" placeholder="Email">

        <input type="text" name="facebook" placeholder="Facebook Profile Link">

        <input type="file" name="photo" accept="image/*">

        <button type="submit" name="save">Save Worker</button>
    </form>

    <a href="worker_list.php">← Back</a>
</div>

</body>
</html>
