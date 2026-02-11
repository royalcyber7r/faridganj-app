<?php
include "../db.php";
$data = mysqli_query($conn, "SELECT * FROM hospitals ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>হাসপাতাল সেবা</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
    margin:0;
    padding:20px;
}

.page-title{
    font-size:26px;
    font-weight:bold;
    margin-bottom:20px;
}

/* ===== GRID ===== */
.grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

/* Responsive */
@media(max-width:1100px){
    .grid{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:900px){
    .grid{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:550px){
    .grid{grid-template-columns:repeat(1,1fr);}
}

/* ===== CARD ===== */
.card{
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
    transition:.3s;
}
.card:hover{
    transform:translateY(-6px);
}

/* Image */
.card img{
    width:100%;
    height:210px;
    object-fit:revert;
    background:#eee;
}

/* Content */
.card-body{
    padding:15px;
}

.card-body h3{
    margin:0 0 10px;
    font-size:18px;
    color:#222;
}

/* ===== TEXT ===== */
.info{
    display:flex;
    gap:6px;
    margin:6px 0;
    font-size:14px;
    color:#555;
    line-height:1.6;
}

.info .icon{
    flex-shrink:0;
}

.address{
    white-space:pre-line; /* ✅ ONLY THIS */
}

/* Link */
.card-body a{
    display:inline-block;
    margin-top:10px;
    text-decoration:none;
    font-size:14px;
    color:#1877f2;
    font-weight:bold;
}
.card-body a:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<div class="page-title">🏥 হাসপাতাল সেবা</div>

<div class="grid">
<?php while($row = mysqli_fetch_assoc($data)){ ?>
    <div class="card">

        <img src="../uploads/hospital/<?= htmlspecialchars($row['image']) ?>" alt="Hospital">

        <div class="card-body">
            <h3><?= htmlspecialchars($row['name']) ?></h3>

            <!-- ADDRESS (Perfect multiline) -->
            <div class="info">
                <span class="icon">📍</span>
                <span class="address"><?= htmlspecialchars($row['address']) ?></span>
            </div>

            <div class="info">
                <span class="icon">📞</span>
                <span><?= htmlspecialchars($row['mobile']) ?></span>
            </div>

            <?php if(!empty($row['email'])){ ?>
            <div class="info">
                <span class="icon">✉</span>
                <span><?= htmlspecialchars($row['email']) ?></span>
            </div>
            <?php } ?>

            <?php if(!empty($row['facebook'])){ ?>
                <a href="<?= htmlspecialchars($row['facebook']) ?>" target="_blank">
                    Facebook →
                </a>
            <?php } ?>
        </div>

    </div>
<?php } ?>
</div>

</body>
</html>
