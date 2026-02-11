<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM lawyers ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>আইনজীবী তালিকা</title>

<style>
*{box-sizing:border-box}

body{
    font-family:Segoe UI,Arial;
    background:#f4f6f9;
    padding:30px;
    margin:0;
}

h2{
    margin-bottom:25px;
    color:#2c3e50;
}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:repeat(5, 1fr);
    gap:20px;
}

/* CARD */
.card{
    background:#fff;
    border-radius:14px;
    padding:18px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    text-align:center;
    transition:.3s;
}
.card:hover{
    transform:translateY(-4px);
}

/* PHOTO */
.card img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #3498db;
    margin-bottom:12px;
}

/* TEXT */
.card h3{
    margin:6px 0;
    font-size:18px;
    color:#2c3e50;
}

.card p{
    margin:4px 0;
    font-size:14px;
    color:#555;
}

/* FACEBOOK */
.fb{
    display:inline-block;
    margin-top:8px;
    color:#1877f2;
    font-weight:600;
    text-decoration:none;
    font-size:14px;
}
.fb:hover{text-decoration:underline}

/* RESPONSIVE */
@media(max-width:1400px){
    .grid{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:1100px){
    .grid{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:800px){
    .grid{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:480px){
    .grid{grid-template-columns:repeat(1,1fr);}
}
</style>
</head>

<body>

<h2>⚖️ আইনজীবী তালিকা</h2>

<div class="grid">

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="card">

    <img src="<?= $row['photo']
        ? '../uploads/lawyers/'.$row['photo']
        : '../assets/no-user.png' ?>">

    <h3><?= htmlspecialchars($row['name']) ?></h3>

    <p><b>পদবী:</b> <?= htmlspecialchars($row['designation']) ?></p>
    <p><b>মোবাইল:</b> <?= htmlspecialchars($row['mobile']) ?></p>
    <p><b>চেম্বার:</b> <?= htmlspecialchars($row['chamber_address']) ?></p>
    <p><b>ইমেইল:</b> <?= htmlspecialchars($row['email']) ?></p>

    <?php if(!empty($row['facebook_link'])){ ?>
        <a class="fb" href="<?= htmlspecialchars($row['facebook_link']) ?>" target="_blank">
            🔗 Facebook
        </a>
    <?php } ?>

</div>
<?php } ?>

</div>

</body>
</html>
