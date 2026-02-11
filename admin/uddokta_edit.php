<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = (int)$_GET['id'];
$result = $conn->query("SELECT * FROM uddokta WHERE id=$id");
$d = $result->fetch_assoc();

if(!$d){
    die("ডাটা পাওয়া যায়নি");
}

if(isset($_POST['update'])){

    $name      = $_POST['name'];
    $page    = $_POST['Page_name'];
    $address   = $_POST['address'];
    $mobile    = $_POST['mobile'];
    $facebook  = $_POST['facebook'];
    $website   = $_POST['website'];

    // image
    $image = $d['image'];
    if(!empty($_FILES['image']['name'])){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = time()."_uddokta.".$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/uddokta/".$image);
    }

    $conn->query("
        UPDATE uddokta SET
        name='$name',
        Page_name='$page',
        address='$address',
        mobile='$mobile',
        facebook='$facebook',
        website='$website',
        image='$image'
        WHERE id=$id
    ");

    header("Location: uddokta_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>উদ্যোক্তা এডিট</title>

<style>
body{
    margin:0;
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
}
.container{
    max-width:700px;
    margin:40px auto;
    padding:0 15px;
}
.card{
    background:#fff;
    border-radius:14px;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
    padding:25px;
}
.card h2{
    margin:0 0 20px;
    font-size:20px;
}
.form-group{
    margin-bottom:14px;
}
.form-group label{
    display:block;
    font-size:13px;
    font-weight:600;
    margin-bottom:5px;
}
.form-group input,
.form-group textarea{
    width:100%;
    padding:9px 11px;
    font-size:13px;
    border:1px solid #ccc;
    border-radius:7px;
}
textarea{
    resize:vertical;
    min-height:70px;
}

/* image */
.image-box{
    margin-top:18px;
    padding-top:15px;
    border-top:1px dashed #ddd;
    text-align:center;
}
.image-box img{
    width:140px;
    height:140px;
    border-radius:12px;
    object-fit:cover;
    border:1px solid #ccc;
    margin-bottom:8px;
}
.image-box input{
    display:block;
    margin:0 auto;
    font-size:13px;
}

/* actions */
.actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:25px;
}
.actions a{
    text-decoration:none;
    font-size:13px;
    color:#555;
}
button{
    background:#009688;
    color:#fff;
    border:none;
    padding:9px 20px;
    font-size:13px;
    border-radius:7px;
    cursor:pointer;
}
button:hover{
    background:#00796b;
}
</style>
</head>

<body>

<div class="container">
<div class="card">

<h2>👤 উদ্যোক্তা তথ্য এডিট</h2>

<form method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>নাম</label>
        <input type="text" name="name" value="<?= htmlspecialchars($d['name']) ?>" required>
    </div>

    <div class="form-group">
        <label>ফেইজের নাম</label>
        <input type="text" name="Page_name" value="<?= htmlspecialchars($d['Page_name']) ?>">
    </div>

    <div class="form-group">
        <label>মোবাইল</label>
        <input type="text" name="mobile" value="<?= htmlspecialchars($d['mobile']) ?>">
    </div>

    <div class="form-group">
        <label>ঠিকানা</label>
        <textarea name="address"><?= htmlspecialchars($d['address']) ?></textarea>
    </div>

    <div class="form-group">
        <label>ফেসবুক লিংক</label>
        <input type="text" name="facebook" value="<?= htmlspecialchars($d['facebook']) ?>">
    </div>

    <div class="form-group">
        <label>ওয়েবসাইট লিংক</label>
        <input type="text" name="website" value="<?= htmlspecialchars($d['website']) ?>">
    </div>

    <!-- IMAGE -->
    <div class="image-box">
        <?php if($d['image']): ?>
            <img src="../uploads/uddokta/<?= htmlspecialchars($d['image']) ?>">
        <?php endif; ?>
        <input type="file" name="image">
    </div>

    <div class="actions">
        <a href="uddokta_list.php">← Back</a>
        <button name="update">Update</button>
    </div>

</form>

</div>
</div>

</body>
</html>
