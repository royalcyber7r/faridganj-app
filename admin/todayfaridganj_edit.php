<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0){
    header("location: todayfaridganj_list.php");
    exit;
}

$data = $conn->query("SELECT * FROM today_faridganj WHERE id=$id");
$d = $data->fetch_assoc();

if(!$d){
    header("location: todayfaridganj_list.php");
    exit;
}

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $d['image'];

    // image upload (optional)
    if(!empty($_FILES['image']['name'])){
        $upload_dir = "../uploads/today/";

        if(!is_dir($upload_dir)){
            mkdir($upload_dir, 0777, true);
        }

        // old image delete
        if($image && file_exists($upload_dir.$image)){
            unlink($upload_dir.$image);
        }

        $image = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir.$image);
    }

    $conn->query("UPDATE today_faridganj 
        SET title='$title', description='$description', image='$image' 
        WHERE id=$id");

    header("location: todayfaridganj_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit - আজকের ফরিদগঞ্জ</title>

<style>
body{
    background:#f4f6f9;
    font-family: Arial;
    margin:0;
    padding:20px;
}
.box{
    max-width:600px;
    margin:auto;
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}
h2{
    margin-top:0;
}
label{
    font-weight:bold;
    display:block;
    margin-top:15px;
}
input[type=text], textarea{
    width:100%;
    padding:8px;
    margin-top:5px;
}
img{
    max-width:150px;
    margin-top:10px;
    border-radius:6px;
}
button{
    margin-top:20px;
    padding:10px 18px;
    border:none;
    border-radius:5px;
    background:#2196F3;
    color:#fff;
    font-size:15px;
    cursor:pointer;
}
.back{
    display:inline-block;
    margin-bottom:15px;
    text-decoration:none;
    color:#555;
}
</style>
</head>

<body>

<div class="box">
<a class="back" href="todayfaridganj_list.php">⬅ Back to List</a>

<h2>তথ্য পরিবর্তন করুন</h2>

<form method="post" enctype="multipart/form-data">

<label>শিরোনাম</label>
<input type="text" name="title" value="<?= htmlspecialchars($d['title']) ?>" required>

<label>বিস্তারিত</label>
<textarea name="description" rows="6" required><?= htmlspecialchars($d['description']) ?></textarea>

<label>বর্তমান ছবি</label>
<?php if($d['image']): ?>
    <img src="../uploads/today/<?= $d['image'] ?>">
<?php else: ?>
    <p>কোনো ছবি নেই</p>
<?php endif; ?>

<label>নতুন ছবি (চাইলে)</label>
<input type="file" name="image">

<button name="update">Update</button>

</form>
</div>

</body>
</html>
