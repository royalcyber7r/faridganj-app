<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){
    $date = NULL;
    if(!empty($_POST['last_donate'])){
        // Convert DD/MM/YYYY → YYYY-MM-DD
        $d = DateTime::createFromFormat('d/m/Y', $_POST['last_donate']);
        $date = $d ? $d->format('Y-m-d') : NULL;
    }

    mysqli_query($conn,"INSERT INTO blood
    (name,blood_group,last_donate,address,mobile,facebook)
    VALUES(
    '$_POST[name]',
    '$_POST[blood_group]',
    ".($date ? "'$date'" : "NULL").",
    '$_POST[address]',
    '$_POST[mobile]',
    '$_POST[facebook]'
    )");

    header("location:blood_list.php");
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Add Blood Donor</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
    margin:0;
}
.form-box{
    width:420px;
    background:#fff;
    margin:40px auto;
    padding:25px;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
.form-box h2{
    text-align:center;
    margin-bottom:20px;
    color:#c0392b;
}

.form-group{
    margin-bottom:14px;
}
.form-group label{
    display:block;
    font-size:14px;
    margin-bottom:5px;
    color:#333;
}
.form-group input,
.form-group textarea{
    width:100%;
    padding:10px 12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
}
.form-group textarea{
    resize:none;
    height:70px;
}

.form-group input:focus,
.form-group textarea:focus{
    outline:none;
    border-color:#e74c3c;
}

.btn{
    width:100%;
    background:#e74c3c;
    color:#fff;
    border:none;
    padding:12px;
    font-size:16px;
    border-radius:10px;
    cursor:pointer;
}
.btn:hover{
    background:#c0392b;
}
</style>
</head>

<body>

<div class="form-box">
    <h2>🩸 Add Blood Donor</h2>

    <form method="post">
        <div class="form-group">
            <label>নাম</label>
            <input name="name" required>
        </div>

        <div class="form-group">
            <label>রক্তের গ্রুপ</label>
            <input name="blood_group" placeholder="A+, B+, O+ ..." required>
        </div>

        <div class="form-group">
            <label>শেষ রক্ত দানের তারিখ</label>
            <input type="text"
                   name="last_donate"
                   placeholder="দিন/মাস/বছর (DD/MM/YYYY)"
                   pattern="\d{2}/\d{2}/\d{4}">
        </div>

        <div class="form-group">
            <label>ঠিকানা</label>
            <textarea name="address"></textarea>
        </div>

        <div class="form-group">
            <label>মোবাইল</label>
            <input name="mobile">
        </div>

        <div class="form-group">
            <label>Facebook Link</label>
            <input name="facebook">
        </div>

        <button class="btn" name="save">Save Donor</button>
    </form>
</div>

</body>
</html>
