<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM lawyers WHERE id=$id")
);

if(!$data){
    die("Invalid Lawyer ID");
}

if(isset($_POST['update'])){

    $name        = mysqli_real_escape_string($conn,$_POST['name']);
    $designation = mysqli_real_escape_string($conn,$_POST['designation']);
    $mobile      = mysqli_real_escape_string($conn,$_POST['mobile']);
    $chamber     = mysqli_real_escape_string($conn,$_POST['chamber_address']);
    $email       = mysqli_real_escape_string($conn,$_POST['email']);
    $facebook    = mysqli_real_escape_string($conn,$_POST['facebook_link']);

    /* upload folder */
    $uploadDir = "../uploads/lawyers/";
    if(!is_dir($uploadDir)){
        mkdir($uploadDir,0777,true);
    }

    $photo = $data['photo'];

    if(!empty($_FILES['photo']['name'])){
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];

        if(in_array($ext,$allowed)){
            $photo = uniqid("lawyer_",true).".".$ext;
            move_uploaded_file($_FILES['photo']['tmp_name'],$uploadDir.$photo);
        }
    }

    mysqli_query($conn,"UPDATE lawyers SET
        photo='$photo',
        name='$name',
        designation='$designation',
        mobile='$mobile',
        chamber_address='$chamber',
        email='$email',
        facebook_link='$facebook'
        WHERE id=$id
    ");

    header("Location: lawyer_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit Lawyer</title>

<style>
*{box-sizing:border-box}
body{
    margin:0;
    font-family:Segoe UI,Arial;
    background:#f4f6f9;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.form-box{
    background:#fff;
    width:520px;
    padding:30px;
    border-radius:14px;
    box-shadow:0 20px 40px rgba(0,0,0,.12);
}

.form-box h2{
    margin:0 0 20px;
    text-align:center;
    color:#2c3e50;
}

.photo-preview{
    text-align:center;
    margin-bottom:15px;
}
.photo-preview img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #3498db;
}

.form-group{
    margin-bottom:14px;
}
.form-group label{
    display:block;
    margin-bottom:6px;
    font-size:14px;
    color:#555;
}

.form-group input,
.form-group textarea{
    width:100%;
    padding:11px 12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
    outline:none;
    transition:.3s;
}

.form-group textarea{
    resize:none;
    height:80px;
}

.form-group input:focus,
.form-group textarea:focus{
    border-color:#3498db;
    box-shadow:0 0 0 3px rgba(52,152,219,.15);
}

.form-group input[type=file]{
    padding:8px;
}

.btn{
    width:100%;
    background:#27ae60;
    border:none;
    padding:12px;
    font-size:16px;
    color:#fff;
    border-radius:10px;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    background:#1f8f4f;
}

.back{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
    color:#555;
    font-size:14px;
}
</style>
</head>

<body>

<div class="form-box">
    <h2>✏️ আইনজীবীর তথ্য আপডেট</h2>

    <?php if($data['photo']){ ?>
    <div class="photo-preview">
        <img src="../uploads/lawyers/<?= htmlspecialchars($data['photo']) ?>">
    </div>
    <?php } ?>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>নাম</label>
            <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>পদবী</label>
            <input type="text" name="designation" value="<?= htmlspecialchars($data['designation']) ?>" required>
        </div>

        <div class="form-group">
            <label>মোবাইল</label>
            <input type="text" name="mobile" value="<?= htmlspecialchars($data['mobile']) ?>" required>
        </div>

        <div class="form-group">
            <label>চেম্বার ঠিকানা</label>
            <textarea name="chamber_address" required><?= htmlspecialchars($data['chamber_address']) ?></textarea>
        </div>

        <div class="form-group">
            <label>ইমেইল</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>">
        </div>

        <div class="form-group">
            <label>ফেসবুক লিংক</label>
            <input type="url" name="facebook_link" value="<?= htmlspecialchars($data['facebook_link']) ?>">
        </div>

        <div class="form-group">
            <label>নতুন ছবি (Optional)</label>
            <input type="file" name="photo" accept="image/*">
        </div>

        <button class="btn" name="update">💾 Update Lawyer</button>

        <a class="back" href="lawyer_list.php">← Back to List</a>

    </form>
</div>

</body>
</html>
