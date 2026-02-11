<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = (int)$_GET['id'];
$data = $conn->query("SELECT * FROM emargency WHERE id=$id");
$d = $data->fetch_assoc();

if(!$d){
    die("Data not found");
}

if(isset($_POST['update'])){

    $website     = $_POST['website'];
    $hotline     = $_POST['hotline'];
    $description = $_POST['description'];

    /* logo upload */
    if(!empty($_FILES['logo']['name'])){
        $ext  = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $logo = time().'_'.rand(1000,9999).".".$ext;

        move_uploaded_file(
            $_FILES['logo']['tmp_name'],
            "../uploads/emargency/".$logo
        );

        $conn->query("UPDATE emargency SET logo='$logo' WHERE id=$id");
    }

    /* update other fields */
    $conn->query("UPDATE emargency SET
        website='$website',
        hotline='$hotline',
        description='$description'
        WHERE id=$id
    ");

    header("Location: emargency_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit Emergency Service</title>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}
.box{
    max-width:600px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 6px 20px rgba(0,0,0,.15);
}
h2{
    text-align:center;
    margin-bottom:20px;
}
.form-group{
    margin-bottom:15px;
}
label{
    font-weight:bold;
    display:block;
    margin-bottom:6px;
}
input, textarea{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:6px;
}
textarea{
    min-height:100px;
}
img{
    width:90px;
    display:block;
    margin-bottom:10px;
    border-radius:6px;
}
button{
    width:100%;
    padding:12px;
    background:#28a745;
    color:#fff;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}
button:hover{
    background:#218838;
}
.back{
    text-align:center;
    margin-top:15px;
}
.back a{
    text-decoration:none;
    color:#007bff;
}
</style>
</head>

<body>

<div class="box">
<h2>✏️ জরুরী সেবা আপডেট</h2>

<form method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>ওয়েবসাইট</label>
        <input type="url" name="website"
               value="<?= htmlspecialchars($d['website']) ?>">
    </div>

    <div class="form-group">
        <label>হটলাইন</label>
        <input type="text" name="hotline"
               value="<?= htmlspecialchars($d['hotline']) ?>">
    </div>

    <div class="form-group">
        <label>বিস্তারিত</label>
        <textarea name="description"><?= htmlspecialchars($d['description']) ?></textarea>
    </div>

    <div class="form-group">
        <label>বর্তমান লোগো</label>
        <?php if(!empty($d['logo'])): ?>
            <img src="../uploads/emargency/<?= htmlspecialchars($d['logo']) ?>">
        <?php endif; ?>
        <input type="file" name="logo" accept="image/*">
    </div>

    <button type="submit" name="update">✅ Update Service</button>

</form>

<div class="back">
    <a href="emargency_list.php">⬅ Back to List</a>
</div>
</div>

</body>
</html>
