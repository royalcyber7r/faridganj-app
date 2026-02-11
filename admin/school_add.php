<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    $school_name    = $_POST['school_name'];
    $head_name      = $_POST['head_name'];
    $established    = $_POST['established'];
    $address        = $_POST['address'];
    $eiin           = $_POST['eiin'];
    $institute_code = $_POST['institute_code'];
    $mobile         = $_POST['mobile'];
    $facebook       = $_POST['facebook'];
    $website        = $_POST['website'];

    $image = "";
    if(!empty($_FILES['image']['name'])){
        $image = time().'_'.$_FILES['image']['name'];
        $path = "../uploads/school/";
        if(!is_dir($path)) mkdir($path,0777,true);
        move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);
    }

    mysqli_query($conn,"INSERT INTO school
    (school_name, head_name, established, address, eiin, institute_code, mobile, facebook, website, image)
    VALUES
    ('$school_name','$head_name','$established','$address','$eiin','$institute_code','$mobile','$facebook','$website','$image')");

    header("location: school_list.php");
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add School</title>
</head>
<body>

<h2>🏫 নতুন শিক্ষা প্রতিষ্ঠান যোগ করুন</h2>

<form method="post" enctype="multipart/form-data">

<input name="school_name" placeholder="প্রতিষ্ঠানের নাম" required><br><br>

<input name="head_name" placeholder="প্রধান শিক্ষক / অধ্যক্ষ"><br><br>

<input name="established" placeholder="স্থাপিত সাল"><br><br>

<textarea name="address" placeholder="ঠিকানা"></textarea><br><br>

<input name="eiin" placeholder="EIIN"><br><br>

<input name="institute_code" placeholder="প্রতিষ্ঠান কোড"><br><br>

<input name="mobile" placeholder="মোবাইল"><br><br>

<input name="facebook" placeholder="Facebook Link (optional)"><br><br>

<input name="website" placeholder="Website Link (optional)"><br><br>

<input type="file" name="image"><br><br>

<button name="save">Save School</button>

</form>

</body>
</html>
