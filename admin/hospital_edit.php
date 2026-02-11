<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = mysqli_query($conn, "SELECT * FROM hospitals WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(!$row){
    die("Hospital not found!");
}

if(isset($_POST['update'])){

    $name     = $_POST['name'];
    $address  = $_POST['address'];
    $mobile   = $_POST['mobile'];
    $email    = $_POST['email'];
    $facebook = $_POST['facebook'];
    $image    = $row['image'];

    /* IMAGE UPDATE */
    if(!empty($_FILES['image']['name'])){
        $uploadDir = "../uploads/hospital/";

        if(!is_dir($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }

        if($image && file_exists($uploadDir.$image)){
            unlink($uploadDir.$image);
        }

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = time().rand(1000,9999).".".$ext;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $uploadDir.$image
        );
    }

    mysqli_query($conn,"
        UPDATE hospitals SET
        image='$image',
        name='$name',
        address='$address',
        mobile='$mobile',
        email='$email',
        facebook='$facebook'
        WHERE id=$id
    ");

    header("Location: hospital_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit Hospital</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, sans-serif;
}

.container{
    max-width:540px;
    margin:40px auto;
}

.card{
    background:#fff;
    padding:26px;
    border-radius:16px;
    box-shadow:0 12px 30px rgba(0,0,0,.15);
}

.card h2{
    text-align:center;
    margin-bottom:22px;
}

/* INPUT */
.form-group{
    margin-bottom:14px;
}
.form-group input,
.form-group textarea{
    width:100%;
    padding:11px 14px;
    border:1px solid #ccc;
    border-radius:9px;
    font-size:14px;
}
.form-group textarea{
    resize:none;
    height:90px;
}

/* IMAGE */
.image-box{
    margin-top:20px;
    text-align:center;
}
.preview{
    width:100%;
    height:180px;
    border:2px dashed #009688;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:12px;
    overflow:hidden;
}
.preview img{
    width:100%;
    height:100%;
    object-fit:cover;
}
.image-box input{
    display:none;
}
.image-box label{
    display:inline-block;
    padding:10px 18px;
    background:#009688;
    color:#fff;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;
}
.image-box small{
    display:block;
    margin-top:6px;
    color:#777;
}

/* BUTTON */
.btn{
    margin-top:20px;
    width:100%;
    padding:13px;
    background:#009688;
    border:none;
    color:#fff;
    font-size:15px;
    border-radius:10px;
    cursor:pointer;
}
.btn:hover{
    background:#00796b;
}
</style>
</head>

<body>

<div class="container">
<div class="card">

<h2>✏ হাসপাতাল তথ্য আপডেট</h2>

<form method="post" enctype="multipart/form-data">

    <div class="form-group">
        <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
    </div>

    <div class="form-group">
        <textarea name="address" required><?= htmlspecialchars($row['address']) ?></textarea>
    </div>

    <div class="form-group">
        <input type="text" name="mobile" value="<?= htmlspecialchars($row['mobile']) ?>" required>
    </div>

    <div class="form-group">
        <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>">
    </div>

    <div class="form-group">
        <input type="text" name="facebook" value="<?= htmlspecialchars($row['facebook']) ?>">
    </div>

    <!-- IMAGE BOTTOM -->
    <div class="image-box">
        <div class="preview">
            <?php if($row['image']){ ?>
                <img id="previewImg" src="../uploads/hospital/<?= $row['image'] ?>">
            <?php } else { ?>
                <span id="previewText">📷 হাসপাতালের ছবি</span>
            <?php } ?>
        </div>

        <label for="image">নতুন ছবি নির্বাচন করুন</label>
        <input type="file" id="image" name="image" accept="image/*">
        <small>PNG / JPG / JPEG</small>
    </div>

    <button class="btn" name="update">💾 Update Hospital</button>

</form>

</div>
</div>

<script>
const imageInput = document.getElementById('image');
const previewImg = document.getElementById('previewImg');

imageInput?.addEventListener('change', e=>{
    const file = e.target.files[0];
    if(file){
        previewImg.src = URL.createObjectURL(file);
    }
});
</script>

</body>
</html>
