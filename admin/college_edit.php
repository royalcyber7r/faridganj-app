<?php
require_once "admin_guard.php";
require_once "../db.php";

/* =====================
   UPDATE LOGIC
===================== */
if(isset($_POST['update'])){

    $id             = $_POST['id'];
    $college_name   = $_POST['college_name'];
    $principal_name = $_POST['principal_name'];
    $eiin           = $_POST['eiin'];
    $college_code   = $_POST['college_code'];
    $mobile         = $_POST['mobile'];
    $address        = $_POST['address'];
    $facebook       = $_POST['facebook'];
    $website        = $_POST['website'];

    // পুরোনো ছবি
    $old = mysqli_fetch_assoc(
        mysqli_query($conn,"SELECT image FROM college WHERE id='$id'")
    );
    $image = $old['image'];

    // নতুন ছবি থাকলে
    if(!empty($_FILES['image']['name'])){
        $image = time().'_'.$_FILES['image']['name'];
        $path = "../uploads/college/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);
    }

    mysqli_query($conn,"UPDATE college SET
        college_name='$college_name',
        head_name='$principal_name',
        eiin='$eiin',
        institute_code='$college_code',
        mobile='$mobile',
        address='$address',
        facebook='$facebook',
        website='$website',
        image='$image'
        WHERE id='$id'
    ");

    header("Location: college_list.php");
    exit;
}

/* =====================
   FETCH DATA FOR EDIT
===================== */
if(!isset($_GET['id'])){
    die("Invalid Request");
}

$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM college WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(!$row){
    die("College data not found!");
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit College</title>

<style>
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
img{
    width:100px;
    border-radius:6px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<h2 style="text-align:center;">✏️ কলেজ তথ্য Edit</h2>

<form method="post" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $row['id'] ?>">

<label>কলেজের নাম</label>
<input type="text" name="college_name" value="<?= $row['college_name'] ?>" required>

<label>অধ্যক্ষ</label>
<input type="text" name="principal_name" value="<?= $row['head_name'] ?>">

<label>EIIN</label>
<input type="text" name="eiin" value="<?= $row['eiin'] ?>">

<label>কলেজ কোড</label>
<input type="text" name="college_code" value="<?= $row['institute_code'] ?>">

<label>মোবাইল</label>
<input type="text" name="mobile" value="<?= $row['mobile'] ?>">

<label>ঠিকানা</label>
<textarea name="address"><?= $row['address'] ?></textarea>

<label>Facebook Link</label>
<input type="text" name="facebook" value="<?= $row['facebook'] ?>">

<label>Website Link</label>
<input type="text" name="website" value="<?= $row['website'] ?>">

<label>বর্তমান ছবি</label><br>
<?php if(!empty($row['image'])){ ?>
<img src="../uploads/college/<?= $row['image'] ?>"><br>
<?php }else{ ?>
No Image
<?php } ?>

<label>নতুন ছবি (optional)</label>
<input type="file" name="image">

<button type="submit" name="update">Update College</button>

</form>

</body>
</html>
