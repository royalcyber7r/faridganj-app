<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

/* upload folder */
$uploadDir = "../uploads/emargency/";

if(isset($_POST['save'])){

    $website     = trim($_POST['website']);
    $hotline     = trim($_POST['hotline']);
    $description = trim($_POST['description']);

    /* auto create folder */
    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    $logo = "";
    if(!empty($_FILES['logo']['name'])){
        $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $logo = time().'_'.rand(1000,9999).".".$ext;
        move_uploaded_file($_FILES['logo']['tmp_name'], $uploadDir.$logo);
    }

    /* title বাদ দেওয়া হয়েছে */
    $stmt = $conn->prepare(
        "INSERT INTO emargency (logo,website,hotline,description)
         VALUES (?,?,?,?)"
    );
    $stmt->bind_param("ssss",$logo,$website,$hotline,$description);
    $stmt->execute();

    /* save করার পর লিস্টে পাঠাবে */
    header("Location: emargency_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add Emergency Service</title>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}
.box{
    max-width:600px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:12px;
    box-shadow:0 8px 25px rgba(0,0,0,.15);
}
h2{
    margin-top:0;
    text-align:center;
}
.form-group{
    margin-bottom:15px;
}
label{
    display:block;
    font-weight:bold;
    margin-bottom:5px;
}
input, textarea{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:14px;
}
textarea{
    resize:vertical;
    min-height:90px;
}
input[type=file]{
    padding:6px;
}
button{
    width:100%;
    background:#28a745;
    border:none;
    padding:12px;
    font-size:16px;
    color:#fff;
    border-radius:6px;
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
    <h2>➕ জরুরী সেবা যোগ করুন</h2>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>ওয়েবসাইট</label>
            <input type="url" name="website" placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label>হটলাইন</label>
            <input type="text" name="hotline" placeholder="999 / 333 / 102">
        </div>

        <div class="form-group">
            <label>বিস্তারিত</label>
            <textarea name="description" placeholder="সেবার বিস্তারিত লিখুন"></textarea>
        </div>

        <div class="form-group">
            <label>লোগো / ছবি</label>
            <input type="file" name="logo" accept="image/*">
        </div>

        <button type="submit" name="save">Save Emergency Service</button>
    </form>

    <div class="back">
        <a href="emargency_list.php">⬅ Back to List</a>
    </div>
</div>

</body>
</html>
