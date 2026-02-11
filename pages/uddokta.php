<?php
include "../db.php";
$result = $conn->query("SELECT * FROM uddokta ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>উদ্যোক্তা তালিকা</title>

<style>
body{
    margin:0;
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
}

/* ===== Container ===== */
.container{
    max-width:1400px; /* বড় করা হলো যাতে ৬টা সুন্দর ফিট করে */
    margin:30px auto;
    padding:0 15px;
}

/* ===== Grid (6 per row) ===== */
.grid{
    display:grid;
    grid-template-columns:repeat(6, 1fr); /* এক লাইনে ৬টা */
    gap:22px;
}

/* ===== Card ===== */
.card{
    background:#fff;
    padding:18px 15px;
    border-radius:16px;
    box-shadow:0 6px 18px rgba(0,0,0,.12);
    text-align:center;
}

.card img{
    width:90px;
    height:90px;
    border-radius:50%;
    object-fit:cover;
    border:1px solid #ddd;
    margin-bottom:10px;
}

.card h4{
    margin:6px 0 4px;
    font-size:15px;
}

.card .fbname{
    font-size:12px;
    color:#666;
    margin-bottom:6px;
}

.card .mobile{
    font-weight:bold;
    margin:6px 0;
    font-size:13px;
}

.card .address{
    font-size:12px;
    color:#555;
    margin-bottom:10px;
}

.links a{
    display:inline-block;
    font-size:12px;
    margin:3px 6px;
    text-decoration:none;
    color:#0066cc;
}

.links a:hover{
    text-decoration:underline;
}

.empty{
    color:#999;
    font-size:12px;
}

/* ===== Responsive ===== */
@media(max-width:1200px){
    .grid{ grid-template-columns:repeat(4,1fr); }
}
@media(max-width:900px){
    .grid{ grid-template-columns:repeat(3,1fr); }
}
@media(max-width:600px){
    .grid{ grid-template-columns:repeat(2,1fr); }
}
</style>
</head>

<body>

<div class="container">
<h2>উদ্যোক্তা তালিকা</h2>
<div class="grid">

<?php while($d = $result->fetch_assoc()): ?>
<div class="card">

    <?php if(!empty($d['image']) && file_exists("../uploads/uddokta/".$d['image'])): ?>
        <img src="../uploads/uddokta/<?= htmlspecialchars($d['image']) ?>">
    <?php else: ?>
        <img src="../assets/user.png">
    <?php endif; ?>

    <h4><?= htmlspecialchars($d['name'] ?? '') ?></h4>

    <?php if(!empty($d['Page_name'])): ?>
        <div class="fbname"><?= htmlspecialchars($d['Page_name']) ?></div>
    <?php endif; ?>

    <?php if(!empty($d['mobile'])): ?>
        <div class="mobile"><?= htmlspecialchars($d['mobile']) ?></div>
    <?php endif; ?>

    <?php if(!empty($d['address'])): ?>
        <div class="address"><?= htmlspecialchars($d['address']) ?></div>
    <?php endif; ?>

    <div class="links">
        <?php if(!empty($d['facebook'])): ?>
            <a href="<?= htmlspecialchars($d['facebook']) ?>" target="_blank">Facebook</a>
        <?php endif; ?>

        <?php if(!empty($d['website'])): ?>
            <a href="<?= htmlspecialchars($d['website']) ?>" target="_blank">Website</a>
        <?php endif; ?>

        <?php if(empty($d['facebook']) && empty($d['website'])): ?>
            <div class="empty">কোনো লিংক নেই</div>
        <?php endif; ?>
    </div>

</div>
<?php endwhile; ?>

</div>
</div>

</body>
</html>
