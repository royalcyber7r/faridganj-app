<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0){
    die("Invalid Doctor ID");
}

/* Fetch doctor */
$result = mysqli_query($conn, "SELECT * FROM doctors WHERE id=$id");
if(mysqli_num_rows($result) == 0){
    die("Doctor not found");
}
$doctor = mysqli_fetch_assoc($result);

/* Update doctor */
if(isset($_POST['update'])){

    $name       = $_POST['name'];
    $department = $_POST['department'];
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];
    $email      = $_POST['email'];
    $facebook   = $_POST['facebook'];

    $photo_sql = "";

    /* Image upload */
    if(!empty($_FILES['photo']['name'])){
        $photo = time().'_'.$_FILES['photo']['name'];
        $tmp   = $_FILES['photo']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/doctors/".$photo);

        // delete old photo
        if(!empty($doctor['photo']) && file_exists("../uploads/doctors/".$doctor['photo'])){
            unlink("../uploads/doctors/".$doctor['photo']);
        }

        $photo_sql = ", photo='$photo'";
    }

    $update = "UPDATE doctors SET
        name='$name',
        department='$department',
        phone='$phone',
        address='$address',
        email='$email',
        facebook='$facebook'
        $photo_sql
        WHERE id=$id";

    mysqli_query($conn, $update);

    header("Location: doctor_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit Doctor</title>

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
    background:#198754;
    color:#fff;
    border:none;
    cursor:pointer;
}
img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #eee;
    margin-bottom:10px;
}
</style>
</head>

<body>

<div class="container">
    <h2>✏️ Edit Doctor</h2>

    <?php
    if(!empty($doctor['photo']) && file_exists("../uploads/doctors/".$doctor['photo'])){
        $img = "../uploads/doctors/".$doctor['photo'];
    }else{
        $img = "../assets/default-doctor.png";
    }
    ?>
    <img src="<?= $img ?>">

    <form method="post" enctype="multipart/form-data">

        <input type="text" name="name" value="<?= htmlspecialchars($doctor['name']) ?>" required>

        <input type="text" name="department" value="<?= htmlspecialchars($doctor['department']) ?>" required>

        <input type="text" name="phone" value="<?= htmlspecialchars($doctor['phone']) ?>" required>

        <textarea name="address" required><?= htmlspecialchars($doctor['address']) ?></textarea>

        <input type="email" name="email" value="<?= htmlspecialchars($doctor['email']) ?>">

        <input type="text" name="facebook" value="<?= htmlspecialchars($doctor['facebook']) ?>">

        <input type="file" name="photo" accept="image/*">

        <button type="submit" name="update">Update Doctor</button>
    </form>
</div>

</body>
</html>
