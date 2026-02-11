<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = (int)$_GET['id'];
$result = $conn->query("SELECT * FROM pbs WHERE id=$id");
$d = $result->fetch_assoc();

if(!$d){
    die("ডাটা পাওয়া যায়নি");
}

if(isset($_POST['update'])){

    $office_name = $_POST['office_name'];
    $name        = $_POST['name'];
    $designation = $_POST['designation'];
    $mobile      = $_POST['mobile'];
    $address     = $_POST['address'];
    $email       = $_POST['email'];

    $imageName = $d['image'];
    if(!empty($_FILES['image']['name'])){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = time()."_pbs.".$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/pbs/".$imageName);
    }

    $conn->query("
        UPDATE pbs SET
        office_name='$office_name',
        name='$name',
        designation='$designation',
        mobile='$mobile',
        address='$address',
        email='$email',
        image='$imageName'
        WHERE id=$id
    ");

    header("Location: pbs_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>PBS Edit</title>

<style>
body{
    margin:0;
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
}

/* container smaller */
.container{
    max-width:680px;
    margin:30px auto;
    padding:0 15px;
}

/* card compact */
.card{
    background:#fff;
    border-radius:14px;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
    padding:22px;
}

.card h2{
    margin:0 0 18px;
    font-size:20px;
}

/* form */
.form-group{
    margin-bottom:12px;
}

.form-group label{
    display:block;
    font-size:13px;
    font-weight:600;
    margin-bottom:4px;
}

.form-group input,
.form-group textarea{
    width:100%;
    padding:8px 10px;
    font-size:13px;
    border:1px solid #ccc;
    border-radius:7px;
}

.form-group textarea{
    resize:vertical;
    min-height:65px;
}

/* image section smaller */
.image-section{
    margin-top:18px;
    padding-top:15px;
    border-top:1px dashed #ddd;
    text-align:center;
}

.image-section img{
    width:140px;
    height:140px;
    object-fit:cover;
    border-radius:10px;
    border:1px solid #ccc;
    margin-bottom:8px;
}

.image-section input{
    font-size:12px;
    margin:0 auto;
}

/* actions */
.actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:22px;
}

.back{
    text-decoration:none;
    color:#555;
    font-size:13px;
}

button{
    background:#009688;
    color:#fff;
    border:none;
    padding:8px 18px;
    font-size:13px;
    border-radius:7px;
    cursor:pointer;
}

button:hover{
    background:#00796b;
}
</style>
</head>

<body>

<div class="container">
    <div class="card">

        <h2>⚡ বিদ্যুৎ অফিস তথ্য আপডেট</h2>

        <form method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label>অফিস নাম</label>
                <input type="text" name="office_name" value="<?= htmlspecialchars($d['office_name']) ?>" required>
            </div>

            <div class="form-group">
                <label>নাম</label>
                <input type="text" name="name" value="<?= htmlspecialchars($d['name']) ?>" required>
            </div>

            <div class="form-group">
                <label>পদবী</label>
                <input type="text" name="designation" value="<?= htmlspecialchars($d['designation']) ?>">
            </div>

            <div class="form-group">
                <label>মোবাইল</label>
                <input type="text" name="mobile" value="<?= htmlspecialchars($d['mobile']) ?>">
            </div>

            <div class="form-group">
                <label>ঠিকানা</label>
                <textarea name="address"><?= htmlspecialchars($d['address']) ?></textarea>
            </div>

            <div class="form-group">
                <label>ইমেইল</label>
                <input type="email" name="email" value="<?= htmlspecialchars($d['email']) ?>">
            </div>

            <!-- image bottom -->
            <div class="image-section">
                <img src="../uploads/pbs/<?= htmlspecialchars($d['image']) ?>">
                <input type="file" name="image">
            </div>

            <div class="actions">
                <a href="pbs_list.php" class="back">← Back</a>
                <button name="update">Update</button>
            </div>

        </form>

    </div>
</div>

</body>
</html>
