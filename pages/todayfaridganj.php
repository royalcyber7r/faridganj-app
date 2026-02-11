<?php
include "../db.php";
$data = $conn->query("SELECT * FROM today_faridganj ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>আজকের ফরিদগঞ্জ</title>

<style>
body{
    margin:0;
    background:#f2f4f7;
    font-family:Arial, sans-serif;
}
.header{
    background:#009688;
    color:#fff;
    padding:14px;
    text-align:center;
    font-size:18px;
}
.container{
    padding:12px;
}
.card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,.12);
    margin-bottom:12px;
    display:flex;
    overflow:hidden;
}
.card img{
    width:130px;
    height:100%;
    object-fit:cover;
}
.card-content{
    padding:10px;
    flex:1;
}
.card-content h4{
    margin:0 0 6px;
    font-size:16px;
}
.card-content p{
    margin:0;
    font-size:14px;
    color:#555;
}
.date{
    font-size:12px;
    color:#777;
    margin-top:6px;
}
</style>
</head>

<body>

<div class="header">আজকের ফরিদগঞ্জ</div>

<div class="container">
<?php while($d = $data->fetch_assoc()): ?>
<a href="todayfaridganj_view.php?id=<?= $d['id'] ?>" style="text-decoration:none;color:inherit">
<div class="card">
    <img src="../uploads/today/<?= $d['image'] ?>">
    <div class="card-content">
        <h4><?= htmlspecialchars($d['title']) ?></h4>
        <p>বিস্তারিত জানতে এখানে ক্লিক করুন!</p>
        <div class="date">
            <?= date("d M, Y || h:i:s A", strtotime($d['created_at'])) ?>
        </div>
    </div>
</div>
</a>
<?php endwhile; ?>
</div>

</body>
</html>
