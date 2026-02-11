<?php
include "../db.php";
$result = $conn->query("SELECT * FROM pbs ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>বিদ্যুৎ অফিস</title>

<style>
*{box-sizing:border-box}
body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}

/* page title */
.page-title{
    font-size:26px;
    font-weight:bold;
    margin:25px 30px;
    color:#222;
}

/* grid layout */
.grid{
    display:grid;
    grid-template-columns:repeat(5, 1fr);
    gap:20px;
    padding:0 30px 40px;
}

/* card */
.card{
    background:#fff;
    border-radius:16px;
    box-shadow:0 8px 22px rgba(0,0,0,.12);
    overflow:hidden;
    transition:.2s;
}
.card:hover{
    transform:translateY(-5px);
}

/* image */
.card img{
    width:100%;
    height:180px;
    object-fit:revert;
    background:#eee;
}

/* content */
.card-body{
    padding:15px 16px 20px;
}

.office-name{
    font-size:15px;
    font-weight:bold;
    color:#009688;
    margin-bottom:6px;
}

.person-name{
    font-size:16px;
    font-weight:bold;
    color:#333;
    margin-bottom:2px;
}

/* ✅ DESIGNATION BIGGER */
.designation{
    font-size:15px;      /* আগে ছিল 13px */
    font-weight:600;     /* একটু বোল্ড */
    color:#444;
    margin-bottom:12px;
}

/* info text */
.info{
    font-size:13px;
    color:#444;
    margin:6px 0;
    line-height:1.5;
}

/* responsive */
@media (max-width:1400px){
    .grid{ grid-template-columns:repeat(4,1fr); }
}
@media (max-width:1100px){
    .grid{ grid-template-columns:repeat(3,1fr); }
}
@media (max-width:800px){
    .grid{ grid-template-columns:repeat(2,1fr); }
}
@media (max-width:480px){
    .grid{ grid-template-columns:1fr; }
}
</style>
</head>

<body>

<div class="page-title">⚡ বিদ্যুৎ অফিস</div>

<div class="grid">

<?php if($result && $result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){ ?>

    <div class="card">

        <?php if(!empty($row['image'])){ ?>
            <img src="../uploads/pbs/<?= htmlspecialchars($row['image']) ?>">
        <?php } else { ?>
            <img src="../assets/no-image.png">
        <?php } ?>

        <div class="card-body">

            <div class="office-name">
                <?= htmlspecialchars($row['office_name']) ?>
            </div>

            <div class="person-name">
                <?= htmlspecialchars($row['name']) ?>
            </div>

            <div class="designation">
                <?= htmlspecialchars($row['designation']) ?>
            </div>

            <div class="info">
                📞 <?= htmlspecialchars($row['mobile']) ?>
            </div>

            <div class="info">
                📍 <?= htmlspecialchars($row['address']) ?>
            </div>

            <div class="info">
                ✉️ <?= htmlspecialchars($row['email']) ?>
            </div>

        </div>
    </div>

<?php } } else { ?>

    <p style="padding:30px;color:#777;">কোন বিদ্যুৎ অফিস পাওয়া যায়নি</p>

<?php } ?>

</div>

</body>
</html>
