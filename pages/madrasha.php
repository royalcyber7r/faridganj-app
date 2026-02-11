<?php
include "../db.php";
$result = mysqli_query($conn,"SELECT * FROM madrasha ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>মাদ্রাসা তালিকা</title>

<style>
body{background:#f4f6f9;font-family:Arial;}
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:20px;
    padding:20px;
}
.card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
    overflow:hidden;
}
.card img{
    width:100%;
    height:250px;
    object-fit:revert;
}
.body{padding:15px;font-size:15px;}
.body h3{margin:0 0 8px;}
a{color:#0d6efd;text-decoration:none;font-weight:600;}
</style>
</head>

<body>

<h2 style="padding:15px;">🕌 মাদ্রাসা তালিকা</h2>

<div class="grid">
<?php while($row=mysqli_fetch_assoc($result)){
    $img="../uploads/madrasha/".$row['image'];
    if(empty($row['image'])||!file_exists($img)){
        $img="../uploads/no-image.png";
    }
?>
<div class="card">
    <img src="<?= $img ?>">
    <div class="body">
        <h3><?= htmlspecialchars($row['madrasha_name']) ?></h3>
        <p><b>প্রধান:</b> <?= $row['head_name'] ?></p>
        <p><b>EIIN:</b> <?= $row['eiin'] ?></p>
        <p><b>মোবাইল:</b> <?= $row['mobile'] ?></p>
        <p><b>ঠিকানা:</b> <?= $row['address'] ?></p>

        <?php if($row['facebook']||$row['website']){ ?>
        <p>
            <?php if($row['facebook']){ ?><a href="<?= $row['facebook'] ?>">Facebook</a><?php } ?>
            <?php if($row['website']){ ?> | <a href="<?= $row['website'] ?>">Website</a><?php } ?>
        </p>
        <?php } ?>
    </div>
</div>
<?php } ?>
</div>

</body>
</html>
