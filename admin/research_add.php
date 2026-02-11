<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    $research_name = $_POST['research_name'];
    $head_name     = $_POST['head_name'];
    $established   = $_POST['established'];
    $address       = $_POST['address'];
    $research_code = $_POST['research_code'];
    $mobile        = $_POST['mobile'];
    $facebook      = $_POST['facebook'];
    $website       = $_POST['website'];

    $image = "";
    if(!empty($_FILES['image']['name'])){
        $image = time().'_'.$_FILES['image']['name'];
        $path = "../uploads/research/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);
    }

    $sql = "INSERT INTO research
    (research_name, head_name, established, address, research_code, mobile, facebook, website, image)
    VALUES
    ('$research_name','$head_name','$established','$address','$research_code','$mobile','$facebook','$website','$image')";

    if(mysqli_query($conn,$sql)){
        header("Location: research_list.php");
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
<title>Add Research Center</title>

<style>
body{
    background:#f4f6f9;
    font-family: Arial, sans-serif;
}
form{
    width:500px;
    margin:30px auto;
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
    background:#0d6efd;
    color:#fff;
    border:none;
    padding:10px 15px;
    border-radius:6px;
    cursor:pointer;
}
</style>
</head>

<body>

<h2 style="text-align:center;">🔬 নতুন রিসার্চ সেন্টার যোগ করুন</h2>

<form method="post" enctype="multipart/form-data">

<label>রিসার্চ সেন্টারের নাম</label>
<input name="research_name" required>

<label>প্রধান / পরিচালক</label>
<input name="head_name">

<label>স্থাপিত সাল</label>
<input name="established">

<label>ঠিকানা</label>
<textarea name="address"></textarea>

<label>রিসার্চ কোড</label>
<input name="research_code">

<label>মোবাইল</label>
<input name="mobile">

<label>Facebook Link</label>
<input name="facebook" placeholder="https://facebook.com/...">

<label>Website Link</label>
<input name="website" placeholder="https://example.com">

<label>রিসার্চ সেন্টারের ছবি</label>
<input type="file" name="image">

<button name="save">Save Research Center</button>

</form>

</body>
</html>
