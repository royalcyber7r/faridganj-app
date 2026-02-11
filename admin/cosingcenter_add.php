<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    $cosingcenter_name = $_POST['cosingcenter_name'];
    $head_name         = $_POST['head_name'];
    $established       = $_POST['established'];
    $address           = $_POST['address'];
    $eiin              = $_POST['eiin'];
    $cosingcenter_code = $_POST['cosingcenter_code'];
    $mobile            = $_POST['mobile'];
    $facebook          = $_POST['facebook'];
    $website           = $_POST['website'];

    $image = "";
    if(!empty($_FILES['image']['name'])){
        $image = time().'_'.$_FILES['image']['name'];
        $path = "../uploads/cosingcenter/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);
    }

    $sql = "INSERT INTO cosingcenter
    (cosingcenter_name, head_name, established, address, eiin, cosingcenter_code, mobile, facebook, website, image)
    VALUES
    ('$cosingcenter_name','$head_name','$established','$address','$eiin','$cosingcenter_code','$mobile','$facebook','$website','$image')";

    if(mysqli_query($conn,$sql)){
        header("Location: cosingcenter_list.php");
        exit;
    }else{
        die("Insert Failed: ".mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add Coaching Center</title>

<style>
body{background:#f4f6f9;font-family:Arial}
form{
    width:500px;
    margin:20px auto;
    background:#fff;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.15);
    border-radius:10px;
}
input, textarea{
    width:100%;
    padding:8px;
    margin-bottom:10px;
}
button{
    background:#198754;
    color:#fff;
    border:none;
    padding:10px 15px;
    border-radius:6px;
    cursor:pointer;
}
</style>
</head>

<body>

<h2 style="text-align:center;">🕌 নতুন কোচিং সেন্টার যোগ করুন</h2>

<form method="post" enctype="multipart/form-data">

<label>কোচিং সেন্টার নাম</label>
<input name="cosingcenter_name" required>

<label>প্রধান / সুপার</label>
<input name="head_name">

<label>স্থাপিত সাল</label>
<input name="established">

<label>ঠিকানা</label>
<textarea name="address"></textarea>

<label>EIIN</label>
<input name="eiin">

<label>কোচিং সেন্টার কোড</label>
<input name="cosingcenter_code">

<label>মোবাইল</label>
<input name="mobile">

<label>Facebook Link</label>
<input name="facebook">

<label>Website Link</label>
<input name="website">

<label>কোচিং সেন্টার ছবি</label>
<input type="file" name="image">

<button name="save">Save Coaching Center</button>

</form>

</body>
</html>
