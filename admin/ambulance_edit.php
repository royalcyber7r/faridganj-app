<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = mysqli_query($conn, "SELECT * FROM ambulance WHERE id = $id");
$data   = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: ambulance_list.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| UPDATE DATA
|--------------------------------------------------------------------------
*/
if (isset($_POST['update'])) {

    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $mobile  = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);

    // 🔹 Photo upload
    if (!empty($_FILES['photo']['name'])) {

        $photoName = time() . "_" . $_FILES['photo']['name'];
        $photoTmp  = $_FILES['photo']['tmp_name'];
        $uploadDir = "../uploads/ambulance/";

        move_uploaded_file($photoTmp, $uploadDir . $photoName);

        mysqli_query($conn, "
            UPDATE ambulance 
            SET photo = '$photoName' 
            WHERE id = $id
        ");
    }

    // 🔹 Update other fields
    mysqli_query($conn, "
        UPDATE ambulance 
        SET 
            name    = '$name',
            address = '$address',
            mobile  = '$mobile',
            email   = '$email'
        WHERE id = $id
    ");

    header("Location: ambulance_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Ambulance</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
    margin:0;
    padding:40px;
}

.form-box{
    max-width:520px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.form-title{
    text-align:center;
    font-size:24px;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    font-weight:bold;
    margin-bottom:6px;
    font-size:14px;
}

.form-group input,
.form-group textarea{
    width:100%;
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}

.form-group textarea{
    resize:none;
    height:80px;
}

.preview{
    text-align:center;
    margin:15px 0;
}

.preview img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #3498db;
}

.file-input{
    text-align:center;
    margin-bottom:20px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#3498db;
    color:#fff;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}
button:hover{
    background:#2980b9;
}

.back-link{
    text-align:center;
    margin-top:15px;
}
.back-link a{
    text-decoration:none;
    color:#555;
    font-size:14px;
}
</style>
</head>

<body>

<div class="form-box">
    <div class="form-title">🚑 Edit Ambulance</div>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Ambulance Name</label>
            <input name="name" value="<?= htmlspecialchars($data['name']) ?>">
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address"><?= htmlspecialchars($data['address']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input name="mobile" value="<?= htmlspecialchars($data['mobile']) ?>">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" value="<?= htmlspecialchars($data['email']) ?>">
        </div>

        <div class="preview">
            <img src="../uploads/ambulance/<?= $data['photo'] ?>">
        </div>

        <div class="file-input">
            <input type="file" name="photo">
        </div>

        <button name="update">💾 Update Ambulance</button>

    </form>

    <div class="back-link">
        <a href="ambulance_list.php">← Back to list</a>
    </div>
</div>

</body>
</html>
