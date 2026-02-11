<?php
include "../db.php";
$result = mysqli_query($conn,"SELECT * FROM cosingcenter ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>কোচিং সেন্টার তালিকা</title>

<style>
body{
    background:#f4f6f9;
    font-family: Arial, sans-serif;
}
.cosingcenter-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap:20px;
    padding:20px;
}
.cosingcenter-card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
    overflow:hidden;
}
.cosingcenter-card img{
    width:100%;
    height:250px;
    object-fit:revert;
}
.cosingcenter-body{
    padding:15px;
    font-size:15px;
}
.cosingcenter-body h3{
    margin:0 0 8px;
    font-size:18px;
}
.cosingcenter-body p{
    margin:4px 0;
}
.cosingcenter-body a{
    color:#0d6efd;
    text-decoration:none;
    font-weight:600;
}
</style>
</head>

<body>

<h2 style="padding:15px;">কোচিং সেন্টার তালিকা</h2>

<div class="cosingcenter-grid">

<?php while($row = mysqli_fetch_assoc($result)){

    $img = "../uploads/cosingcenter/".$row['image'];
    if(empty($row['image']) || !file_exists($img)){
        $img = "../uploads/no-image.png";
    }
?>
    <div class="cosingcenter-card">
        <img src="<?= $img ?>" alt="cosingcenter Image">

        <div class="cosingcenter-body">
            <h3><?= htmlspecialchars($row['cosingcenter_name']) ?></h3>

            <p><b>অধ্যক্ষ:</b> <?= htmlspecialchars($row['head_name']) ?></p>
            <p><b>স্থাপিত:</b> <?= htmlspecialchars($row['established']) ?></p>
            <p><b>EIIN:</b> <?= htmlspecialchars($row['eiin']) ?></p>
            <p><b>কলেজ কোড:</b> <?= htmlspecialchars($row['cosingcenter_code']) ?></p>
            <p><b>মোবাইল:</b> <?= htmlspecialchars($row['mobile']) ?></p>
            <p><b>ঠিকানা:</b> <?= htmlspecialchars($row['address']) ?></p>

            <?php if(!empty($row['facebook']) || !empty($row['website'])){ ?>
                <p>
                    <b>লিংক:</b>
                    <?php if(!empty($row['facebook'])){ ?>
                        <a href="<?= $row['facebook'] ?>" target="_blank">Facebook</a>
                    <?php } ?>

                    <?php if(!empty($row['website'])){ ?>
                        | <a href="<?= $row['website'] ?>" target="_blank">Website</a>
                    <?php } ?>
                </p>
            <?php } ?>
        </div>
    </div>
<?php } ?>

</div>

</body>
</html>
