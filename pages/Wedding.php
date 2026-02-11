<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM Wedding");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>ওডেকোরেটর তালিকা</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
}
.container{
    width:95%;
    margin:auto;
    margin-top:20px;
}
.Wedding-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
    gap:15px;
}
.Wedding-card{
    background:#fff;
    padding:15px;
    text-align:center;
    border-radius:8px;
    box-shadow:0 2px 6px rgba(0,0,0,.1);
}
.Wedding-card img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:10px;
    border:1px solid #ddd;
}
.Wedding-name{
    font-size:16px;
    font-weight:bold;
    margin-top:6px;
}
.Wedding-dept{
    font-size:14px;
    color:#555;
    margin-top:4px;
}
</style>
</head>

<body>

<div class="container">
<h2>🚑 ডেকোরেটর তালিকা</h2>

<div class="Wedding-grid">
<?php while($row = mysqli_fetch_assoc($result)){
    $photoPath = "../uploads/Wedding/".$row['photo'];
    if(empty($row['photo']) || !file_exists($photoPath)){
        $photoPath = "../uploads/no-image.png";
    }
?>
<div class="Wedding-card">

    <img src="<?= $photoPath ?>">

    <!-- প্রতিষ্ঠান -->
    <div class="Wedding-name">
        <?= htmlspecialchars($row['organization'] ?? '') ?>
    </div>

    <!-- নাম -->
    <div class="Wedding-name">
        <?= htmlspecialchars($row['name'] ?? '') ?>
    </div>

    <!-- ঠিকানা -->
    <div class="Wedding-dept">
        <?= htmlspecialchars($row['address'] ?? '') ?>
    </div>

    <!-- মোবাইল -->
    <div class="Wedding-dept">
        📞 <?= htmlspecialchars($row['mobile'] ?? '') ?>
    </div>

    <!-- ইমেইল -->
    <div class="Wedding-dept">
        <?= htmlspecialchars($row['email'] ?? '') ?>
    </div>

    <!-- অভিজ্ঞতা -->
    <div class="Wedding-dept">
        অভিজ্ঞতা: <?= htmlspecialchars($row['experience'] ?? 'উল্লেখ নেই') ?>
    </div>

</div>
<?php } ?>
</div>

</div>
</body>
</html>
