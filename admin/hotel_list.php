<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn,"SELECT * FROM hotel");
$total  = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Hotel Management</title>
<link rel="stylesheet" href="../assets/css/admin.css">

<style>
body{
    background:#f4f6f9 !important;
    font-family: Arial, sans-serif;
}

.add-new-box{
    text-align:center;
    margin:20px 0;
}

.add-new-btn{
    background:#2ecc71;
    color:#fff;
    padding:10px 18px;
    text-decoration:none;
    border-radius:6px;
    font-size:15px;
}

.page-title{
    text-align:center;
    font-size:26px;
    margin:10px 0;
}

.total-hotel{
    text-align:center;
    margin-bottom:20px;
    color:#555;
}

.hotel-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
    gap:15px;
    width:95%;
    margin:auto;
}

.hotel-card{
    background:#fff;
    border:1px solid #ddd;
    padding:12px;
    text-align:center;
    border-radius:8px;
    box-shadow:0 2px 5px rgba(0,0,0,.08);
}

.hotel-card img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #ddd;
    margin-bottom:8px;
}

.hotel-card p{
    margin:4px 0;
    font-size:14px;
}

.food-list{
    font-size:13px;
    color:#333;
    margin-top:6px;
}

.action-btns{
    display:flex;
    justify-content:center;
    gap:10px;
    margin-top:10px;
}

.edit-btn{
    background:#3498db;
    color:#fff;
    padding:5px 10px;
    text-decoration:none;
    border-radius:4px;
    font-size:13px;
}

.delete-btn{
    background:#e74c3c;
    color:#fff;
    padding:5px 10px;
    text-decoration:none;
    border-radius:4px;
    font-size:13px;
}

.hotel-name{
    font-size:17px;
    font-weight:600;
    margin:6px 0;
    text-align:center;
    line-height:1.3;
    color:#000;
    word-break: break-word;
}

</style>
</head>

<body>

<!-- Add New Hotel -->
<div class="add-new-box">
    <a href="hotel_add.php" class="add-new-btn">➕ Add New Hotel</a>
</div>

<div class="page-title">Hotel Management</div>
<div class="total-hotel">Total Hotels: <?= $total ?></div>

<div class="hotel-grid">
<?php while($row=mysqli_fetch_assoc($result)){
    $img = "../uploads/hotels/".$row['image'];
    if(empty($row['image']) || !file_exists($img)){
        $img = "../uploads/no-image.png";
    }
?>
    <div class="hotel-card">

        <img src="<?= $img ?>">

       <div class="hotel-name"><?= htmlspecialchars($row['hotel_name']) ?></div>

        <p>📞 <?= htmlspecialchars($row['mobile']) ?></p>
        <p>✉️ <?= htmlspecialchars($row['email']) ?></p>

        <div class="food-list">
            🍽️ <?= nl2br(htmlspecialchars($row['food_list'])) ?>
        </div>

        <div class="action-btns">
            <a href="hotel_edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
            <a href="hotel_delete.php?id=<?= $row['id'] ?>"
               class="delete-btn"
               onclick="return confirm('Are you sure?')">Delete</a>
        </div>

    </div>
<?php } ?>
</div>

</body>
</html>
