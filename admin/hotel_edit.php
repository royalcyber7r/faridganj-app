<?php
require_once "admin_guard.php";
require_once "../db.php";

/* ---------- ID CHECK ---------- */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Invalid Hotel ID");
}

$id = intval($_GET['id']);

/* ---------- FETCH HOTEL ---------- */
$res = mysqli_query($conn, "SELECT * FROM hotel WHERE id=$id");

if (!$res || mysqli_num_rows($res) == 0) {
    die("❌ Hotel not found");
}

$data = mysqli_fetch_assoc($res);

/* ---------- UPDATE ---------- */
if (isset($_POST['update'])) {

    $hotel_name = mysqli_real_escape_string($conn, $_POST['hotel_name']);
    $mobile     = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $food_list  = mysqli_real_escape_string($conn, $_POST['food_list']);

    /* ---- IMAGE UPDATE (OPTIONAL) ---- */
    if (!empty($_FILES['image']['name'])) {

        $allowed = ['image/jpeg','image/png','image/webp'];
        $mime    = mime_content_type($_FILES['image']['tmp_name']);

        if (!in_array($mime, $allowed)) {
            die("❌ Only JPG, PNG, WEBP allowed");
        }

        $ext   = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = time() . "_" . rand(1000,9999) . "." . $ext;

        $dir = "../uploads/hotels/";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        move_uploaded_file($_FILES['image']['tmp_name'], $dir . $image);

        mysqli_query($conn, "UPDATE hotel SET image='$image' WHERE id=$id");
    }

    /* ---- DATA UPDATE ---- */
    mysqli_query($conn, "UPDATE hotel SET
        hotel_name='$hotel_name',
        mobile='$mobile',
        email='$email',
        food_list='$food_list'
        WHERE id=$id
    ");

    header("location: hotel_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit Hotel</title>
<style>
body{
    font-family: Arial;
    background:#f4f6f9;
}
.form-box{
    width:400px;
    margin:40px auto;
    background:#fff;
    padding:20px;
    border-radius:8px;
}
input, textarea{
    width:100%;
    padding:8px;
    margin:6px 0 12px;
}
button{
    background:#3498db;
    color:#fff;
    padding:10px;
    border:none;
    width:100%;
    border-radius:5px;
    cursor:pointer;
}
img{
    border-radius:6px;
    border:1px solid #ddd;
}
</style>
</head>

<body>

<div class="form-box">
    <h2>Edit Hotel</h2>

    <form method="post" enctype="multipart/form-data">

        <label>Hotel Name</label>
        <input name="hotel_name" value="<?= htmlspecialchars($data['hotel_name']) ?>" required>

        <label>Mobile</label>
        <input name="mobile" value="<?= htmlspecialchars($data['mobile']) ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>">

        <label>Food List</label>
        <textarea name="food_list" rows="4"><?= htmlspecialchars($data['food_list']) ?></textarea>

        <label>Current Image</label><br>
        <?php
        $img = "../uploads/hotels/".$data['image'];
        if(empty($data['image']) || !file_exists($img)){
            $img = "../uploads/no-image.png";
        }
        ?>
        <img src="<?= $img ?>" width="90"><br><br>

        <input type="file" name="image" accept="image/*">

        <button name="update">Update Hotel</button>

    </form>
</div>

</body>
</html>
