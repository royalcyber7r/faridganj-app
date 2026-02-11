<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

$msg = "";

// upload folder
$uploadPath = "../uploads/today/";

// auto create folder
if (!is_dir($uploadPath)) {
    mkdir($uploadPath, 0777, true);
}

if (isset($_POST['save'])) {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if ($title == "" || $description == "") {
        $msg = "সব তথ্য দিন";
    } else {

        $imageName = "";

        if (!empty($_FILES['image']['name'])) {

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = time() . "_" . rand(1000,9999) . "." . $ext;

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $uploadPath . $imageName
            );
        }

        $stmt = $conn->prepare(
            "INSERT INTO today_faridganj (title, description, image)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $title, $description, $imageName);
        $stmt->execute();

        header("Location: todayfaridganj_list.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>আজকের ফরিদগঞ্জ যোগ</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
}
.box{
    max-width:600px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}
input, textarea{
    width:100%;
    padding:10px;
    margin-bottom:15px;
}
button{
    background:#009688;
    color:#fff;
    border:none;
    padding:10px 20px;
    cursor:pointer;
}
.msg{
    color:red;
    text-align:center;
    margin-bottom:10px;
}
</style>
</head>

<body>
<div class="box">
<h2>আজকের ফরিদগঞ্জ</h2>

<?php if($msg): ?>
<div class="msg"><?= $msg ?></div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
<input type="text" name="title" placeholder="শিরোনাম">
<textarea name="description" rows="6" placeholder="বিস্তারিত"></textarea>
<input type="file" name="image" accept="image/*">
<button name="save">Save</button>
</form>

</div>
</body>
</html>
