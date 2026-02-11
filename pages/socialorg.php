<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM socialorg ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>সামাজিক সংগঠন তালিকা</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
}

.container{
    width:95%;
    margin:30px auto;
}

.page-title{
    font-size:26px;
    font-weight:bold;
    margin-bottom:20px;
}

/* ===== GRID ===== */
.socialorg-grid{
    display:grid;
    grid-template-columns:repeat(5, 1fr); /* এক লাইনে ৫টা */
    gap:20px;
}

/* ===== CARD ===== */
.socialorg-card{
    background:#fff;
    padding:16px;
    text-align:center;
    border-radius:12px;
    box-shadow:0 6px 18px rgba(0,0,0,.08);
    transition:.2s;
}
.socialorg-card:hover{
    transform:translateY(-4px);
}

/* ===== IMAGE ===== */
.socialorg-card img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #eee;
    margin-bottom:10px;
}

/* ===== TEXT ===== */
.org-name{
    font-size:15px;
    font-weight:bold;
    margin-bottom:6px;
}

.person-name{
    font-size:14px;
    font-weight:600;
    color:#333;
    margin-bottom:6px;
}

.info{
    font-size:13px;
    color:#555;
    margin-bottom:4px;
}

/* 🔥 ইমেইল ব্রেক ফিক্স */
.email{
    font-size:13px;
    color:#0066cc;
    word-break:break-all;      /* ভেঙে যাবে কিন্তু বাইরে যাবে না */
    overflow-wrap:anywhere;
}

/* ===== RESPONSIVE ===== */
@media(max-width:1200px){
    .socialorg-grid{ grid-template-columns:repeat(4,1fr); }
}
@media(max-width:992px){
    .socialorg-grid{ grid-template-columns:repeat(3,1fr); }
}
@media(max-width:768px){
    .socialorg-grid{ grid-template-columns:repeat(2,1fr); }
}
@media(max-width:480px){
    .socialorg-grid{ grid-template-columns:1fr; }
}
</style>
</head>

<body>

<div class="container">
    <div class="page-title">সামাজিক সংগঠন তালিকা</div>

    <div class="socialorg-grid">
    <?php while($row = mysqli_fetch_assoc($result)){

        $photoPath = "../uploads/socialorg/".$row['photo'];
        if(empty($row['photo']) || !file_exists($photoPath)){
            $photoPath = "../uploads/no-image.png";
        }
    ?>
        <div class="socialorg-card">

            <img src="<?= $photoPath ?>" alt="logo">

            <div class="org-name">
                <?= htmlspecialchars($row['organization'] ?? '') ?>
            </div>

            <div class="person-name">
                <?= htmlspecialchars($row['name'] ?? '') ?>
            </div>

            <div class="info">
                📍 <?= htmlspecialchars($row['address'] ?? '') ?>
            </div>

            <div class="info">
                📞 <?= htmlspecialchars($row['mobile'] ?? '') ?>
            </div>

            <div class="email">
                ✉ <a href="mailto:<?= htmlspecialchars($row['email'] ?? '') ?>">
                    <?= htmlspecialchars($row['email'] ?? '') ?>
                </a>
            </div>

            <div class="info">
                ⭐ সফলতা: <?= htmlspecialchars($row['experience'] ?? 'উল্লেখ নেই') ?>
            </div>

        </div>
    <?php } ?>
    </div>
</div>

</body>
</html>
