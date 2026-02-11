<?php
include "../db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0){
    die("Invalid Request");
}

$q = $conn->query("SELECT * FROM today_faridganj WHERE id=$id");
$d = $q->fetch_assoc();
if(!$d){
    die("Data not found");
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($d['title']) ?></title>

<style>
*{
    box-sizing:border-box;
}
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f2f4f7;
}

/* HERO IMAGE */
.hero{
    position:relative;
    width:100%;
    height:360px;
    background:#000;
}
.hero img{
    width:100%;
    height:100%;
    object-fit: revert;   /* 🔥 সবচেয়ে গুরুত্বপূর্ণ */
    background:#000;
}

/* overlay */
.hero::after{
    content:'';
    position:absolute;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:linear-gradient(to bottom, rgba(0,0,0,.15), rgba(0,0,0,.65));
}

/* title on image */
.hero-title{
    position:absolute;
    bottom:25px;
    left:50%;
    transform:translateX(-50%);
    color:#fff;
    z-index:2;
    text-align:center;
    padding:0 15px;
}
.hero-title h1{
    margin:0;
    font-size:30px;
}

/* CONTENT */
.container{
    max-width:900px;
    margin:25px auto 40px;
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 8px 25px rgba(0,0,0,.1);
}

.date{
    color:#777;
    font-size:13px;
    margin-bottom:15px;
}

.content-text{
    line-height:1.9;
    font-size:16px;
    color:#333;
}

/* mobile */
@media(max-width:768px){
    .hero{
        height:260px;
    }
    .hero-title h1{
        font-size:22px;
    }
    .container{
        margin:20px 12px 30px;
        padding:18px;
    }
}
</style>
</head>

<body>

<div class="hero">
    <?php if($d['image']): ?>
        <img src="../uploads/today/<?= $d['image'] ?>" alt="<?= htmlspecialchars($d['title']) ?>">
    <?php endif; ?>

    <div class="hero-title">
        <h1><?= htmlspecialchars($d['title']) ?></h1>
    </div>
</div>

<div class="container">
    <div class="date">
        <?= date("d M, Y | h:i A", strtotime($d['created_at'])) ?>
    </div>

    <div class="content-text">
        <?= nl2br(htmlspecialchars($d['description'])) ?>
    </div>
</div>

</body>
</html>
