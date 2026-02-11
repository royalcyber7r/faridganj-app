<?php
require_once "admin_guard.php";
require_once "../db.php";

/* =====================
   UPDATE LOGIC
===================== */
if(isset($_POST['update'])){

    $id             = $_POST['id'];
    $school_name    = $_POST['school_name'];
    $head_name      = $_POST['head_name'];
    $eiin           = $_POST['eiin'];
    $institute_code = $_POST['institute_code'];
    $mobile         = $_POST['mobile'];
    $address        = $_POST['address'];
    $facebook       = $_POST['facebook'];
    $website        = $_POST['website'];

    // পুরোনো ছবি
    $old = mysqli_fetch_assoc(
        mysqli_query($conn,"SELECT image FROM school WHERE id='$id'")
    );
    $image = $old['image'];

    // নতুন ছবি থাকলে
    if(!empty($_FILES['image']['name'])){
        $image = time().'_'.$_FILES['image']['name'];
        $path = "../uploads/school/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);
    }

    mysqli_query($conn,"UPDATE school SET
        school_name='$school_name',
        head_name='$head_name',
        eiin='$eiin',
        institute_code='$institute_code',
        mobile='$mobile',
        address='$address',
        facebook='$facebook',
        website='$website',
        image='$image'
        WHERE id='$id'
    ");

    // ✅ Update শেষে list এ পাঠাবে
    header("Location: school_list.php");
    exit;
}

/* =====================
   FETCH DATA FOR EDIT
===================== */
$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM school WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit School</title>

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

<h2 style="text-align:center;">✏️ শিক্ষা প্রতিষ্ঠান Edit</h2>

<form method="post" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $row['id'] ?>">

<label>নাম</label>
<input type="text" name="school_name" value="<?= $row['school_name'] ?>" required>

<label>প্রধান শিক্ষক</label>
<input type="text" name="head_name" value="<?= $row['head_name'] ?>">

<label>EIIN</label>
<input type="text" name="eiin" value="<?= $row['eiin'] ?>">

<label>প্রতিষ্ঠান কোড</label>
<input type="text" name="institute_code" value="<?= $row['institute_code'] ?>">

<label>মোবাইল</label>
<input type="text" name="mobile" value="<?= $row['mobile'] ?>">

<label>ঠিকানা</label>
<textarea name="address"><?= $row['address'] ?></textarea>

<label>Facebook Link</label>
<input type="text" name="facebook" value="<?= $row['facebook'] ?>">

<label>Website Link</label>
<input type="text" name="website" value="<?= $row['website'] ?>">

<label>বর্তমান ছবি</label><br>
<?php if($row['image']){ ?>
<img src="../uploads/school/<?= $row['image'] ?>"><br>
<?php } ?>

<label>নতুন ছবি (optional)</label>
<input type="file" name="image">

<button type="submit" name="update">Update School</button>

</form>

</body>
</html>
