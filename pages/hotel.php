<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM hotel");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>হোটেল তালিকা</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
}
.container{
    width:95%;
    margin:auto;
    margin-top:20px;
}
.hotel-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
    gap:15px;
}
.hotel-card{
    background:#fff;
    padding:15px;
    text-align:center;
    border-radius:8px;
    box-shadow:0 2px 6px rgba(0,0,0,.1);
}
.hotel-card img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:10px;
    border:1px solid #ddd;
}
.hotel-name{
    font-size:16px;
    font-weight:bold;
    margin-top:6px;
}
.hotel-info{
    font-size:14px;
    color:#555;
    margin-top:4px;
}
.food-list{
    font-size:13px;
    color:#333;
    margin-top:6px;
}
</style>
</head>

<body>

<div class="container">
<h2>🍽️ হোটেল তালিকা</h2>

<div class="hotel-grid">
<?php while($row = mysqli_fetch_assoc($result)){
    $photoPath = "../uploads/hotels/".$row['image'];
    if(empty($row['image']) || !file_exists($photoPath)){
        $photoPath = "../uploads/no-image.png";
    }
?>
<div class="hotel-card">

    <img src="<?= $photoPath ?>">

    <!-- হোটেল নাম -->
    <div class="hotel-name">
        <?= htmlspecialchars($row['hotel_name']) ?>
    </div>

    <!-- মোবাইল -->
    <div class="hotel-info">
        📞 <?= htmlspecialchars($row['mobile']) ?>
    </div>

    <!-- ইমেইল -->
    <div class="hotel-info">
        ✉️ <?= htmlspecialchars($row['email']) ?>
    </div>

    <!-- খাবার তালিকা -->
    <div class="food-list">
        🍛 <?= nl2br(htmlspecialchars($row['food_list'])) ?>
    </div>

</div>
<?php } ?>
</div>

</div>
</body>
</html>
