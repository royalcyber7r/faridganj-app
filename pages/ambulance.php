<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM ambulance");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>অ্যাম্বুলেন্স তালিকা</title>

<style>
body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}

.container{
    width:95%;
    margin:auto;
    padding:25px 0;
}

.page-title{
    font-size:26px;
    font-weight:bold;
    margin-bottom:25px;
    display:flex;
    align-items:center;
    gap:10px;
}

/* ===== GRID ===== */
.ambulance-grid{
    display:grid;
    grid-template-columns: repeat(5, 1fr); /* 🔥 এক লাইনে ৫টা */
    gap:20px;
}

/* ===== CARD ===== */
.ambulance-card{
    background:#fff;
    border-radius:16px;
    padding:18px 15px 20px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
    transition:.3s;
}
.ambulance-card:hover{
    transform:translateY(-6px);
    box-shadow:0 14px 30px rgba(0,0,0,.18);
}

.ambulance-card img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #009688;
    margin-bottom:12px;
}

.ambulance-name{
    font-size:16px;
    font-weight:bold;
    margin-bottom:6px;
}

.ambulance-address{
    font-size:13px;
    color:#666;
    margin-bottom:6px;
}

.ambulance-phone{
    font-size:14px;
    font-weight:bold;
    color:#222;
    margin-bottom:4px;
}

.ambulance-email{
    font-size:13px;
    color:#009688;
    word-break:break-all;
}

/* ===== RESPONSIVE ===== */
@media(max-width:1200px){
    .ambulance-grid{ grid-template-columns: repeat(4, 1fr); }
}
@media(max-width:992px){
    .ambulance-grid{ grid-template-columns: repeat(3, 1fr); }
}
@media(max-width:600px){
    .ambulance-grid{ grid-template-columns: repeat(2, 1fr); }
}
@media(max-width:400px){
    .ambulance-grid{ grid-template-columns: repeat(1, 1fr); }
}
</style>
</head>

<body>

<div class="container">

    <div class="page-title">🚑 অ্যাম্বুলেন্স তালিকা</div>

    <div class="ambulance-grid">
    <?php while($row = mysqli_fetch_assoc($result)){
        $photo = "../uploads/ambulance/".$row['photo'];
        if(empty($row['photo']) || !file_exists($photo)){
            $photo = "../uploads/no-image.png";
        }
    ?>
        <div class="ambulance-card">
            <img src="<?= $photo ?>">

            <div class="ambulance-name">
                <?= htmlspecialchars($row['name']) ?>
            </div>

            <div class="ambulance-address">
                <?= htmlspecialchars($row['address']) ?>
            </div>

            <div class="ambulance-phone">
                📞 <?= htmlspecialchars($row['mobile']) ?>
            </div>

            <div class="ambulance-email">
                <?= htmlspecialchars($row['email']) ?>
            </div>
        </div>
    <?php } ?>
    </div>

</div>

</body>
</html>
