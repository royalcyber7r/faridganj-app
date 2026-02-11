<?php
require_once "admin_guard.php";
require_once "../db.php";

/* =====================
   UPDATE LOGIC
===================== */
if(isset($_POST['update'])){

    $id            = (int)$_POST['id'];
    $research_name = $_POST['research_name'];
    $head_name     = $_POST['head_name'];
    $eiin          = $_POST['eiin'];
    $research_code = $_POST['research_code'];
    $mobile        = $_POST['mobile'];
    $address       = $_POST['address'];
    $facebook      = $_POST['facebook'];
    $website       = $_POST['website'];

    // পুরোনো ছবি
    $old = mysqli_fetch_assoc(
        mysqli_query($conn,"SELECT image FROM research WHERE id=$id")
    );
    $image = $old['image'];

    // নতুন ছবি থাকলে
    if(!empty($_FILES['image']['name'])){
        $image = time().'_'.$_FILES['image']['name'];
        $path = "../uploads/research/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);
    }

    mysqli_query($conn,"UPDATE research SET
        research_name='$research_name',
        head_name='$head_name',
        eiin='$eiin',
        research_code='$research_code',
        mobile='$mobile',
        address='$address',
        facebook='$facebook',
        website='$website',
        image='$image'
        WHERE id=$id
    ");

    header("Location: research_list.php");
    exit;
}

/* =====================
   FETCH DATA FOR EDIT
===================== */
if(!isset($_GET['id'])){
    die("Invalid Request");
}

$id = (int)$_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM research WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(!$row){
    die("Research data not found!");
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit Research</title>

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
img{
    width:100px;
    border-radius:6px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<h2 style="text-align:center;">✏️ গবেষণা কেন্দ্র তথ্য Edit</h2>

<form method="post" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $row['id'] ?>">

<label>গবেষণা কেন্দ্র নাম</label>
<input type="text" name="research_name"
       value="<?= htmlspecialchars($row['research_name']) ?>" required>

<label>প্রধান / পরিচালক</label>
<input type="text" name="head_name"
       value="<?= htmlspecialchars($row['head_name']) ?>">

<label>EIIN</label>
<input type="text" name="eiin"
       value="<?= htmlspecialchars($row['eiin']) ?>">

<label>গবেষণা কেন্দ্র কোড</label>
<input type="text" name="research_code"
       value="<?= htmlspecialchars($row['research_code']) ?>">

<label>মোবাইল</label>
<input type="text" name="mobile"
       value="<?= htmlspecialchars($row['mobile']) ?>">

<label>ঠিকানা</label>
<textarea name="address"><?= htmlspecialchars($row['address']) ?></textarea>

<label>Facebook Link</label>
<input type="text" name="facebook"
       value="<?= htmlspecialchars($row['facebook']) ?>">

<label>Website Link</label>
<input type="text" name="website"
       value="<?= htmlspecialchars($row['website']) ?>">

<label>বর্তমান ছবি</label><br>
<?php if(!empty($row['image'])){ ?>
    <img src="../uploads/research/<?= $row['image'] ?>"><br>
<?php }else{ ?>
    No Image<br>
<?php } ?>

<label>নতুন ছবি (optional)</label>
<input type="file" name="image">

<button type="submit" name="update">Update Research</button>

</form>

</body>
</html>
