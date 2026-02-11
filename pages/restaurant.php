<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM restaurant");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>রেস্টুরেন্ট তালিকা</title>

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
.restaurant-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
    gap:15px;
}
.restaurant-card{
    background:#fff;
    padding:15px;
    text-align:center;
    border-radius:8px;
    box-shadow:0 2px 6px rgba(0,0,0,.1);
}
.restaurant-card img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:10px;
    border:1px solid #ddd;
}
.restaurant-name{
    font-size:16px;
    font-weight:bold;
    margin-top:6px;
}
.restaurant-info{
    font-size:14px;
    color:#555;
    margin-top:4px;
}
.food-list{
    font-size:13px;
    color:#333;
    margin-top:6px;
    text-align:left;
}
</style>
</head>

<body>

<div class="container">
<h2>🍽️ রেস্টুরেন্ট তালিকা</h2>

<div class="restaurant-grid">
<?php while($row = mysqli_fetch_assoc($result)){
    $photoPath = "../uploads/restaurants/".$row['image'];
    if(empty($row['image']) || !file_exists($photoPath)){
        $photoPath = "../uploads/no-image.png";
    }
?>
<div class="restaurant-card">

    <img src="<?= $photoPath ?>">

    <!-- রেস্টুরেন্ট নাম -->
    <div class="restaurant-name">
        <?= htmlspecialchars($row['restaurant_name']) ?>
    </div>

    <!-- মোবাইল -->
    <div class="restaurant-info">
        📞 <?= htmlspecialchars($row['mobile']) ?>
    </div>

    <!-- ইমেইল -->
    <div class="restaurant-info">
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
