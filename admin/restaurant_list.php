<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$res = mysqli_query($conn,"SELECT * FROM restaurant ORDER BY id DESC");
$total = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Restaurant Management</title>

<style>
body{font-family:Arial;background:#f4f6f9}
.add-btn{text-align:center;margin:20px}
.add-btn a{background:#27ae60;color:#fff;padding:10px 18px;text-decoration:none;border-radius:6px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:15px;width:95%;margin:auto}
.card{background:#fff;padding:12px;border-radius:8px;text-align:center}
.card img{width:120px;height:120px;border-radius:50%;object-fit:cover}
.btns{margin-top:10px}
.btns a{padding:5px 10px;color:#fff;text-decoration:none;border-radius:4px;font-size:13px}
.edit{background:#3498db}
.del{background:#e74c3c}
</style>
</head>

<body>

<div class="add-btn">
    <a href="restaurant_add.php">➕ Add New Restaurant</a>
</div>

<h2 style="text-align:center;">Restaurant Management</h2>
<p style="text-align:center;">Total Restaurants: <?= $total ?></p>

<div class="grid">
<?php while($row=mysqli_fetch_assoc($res)){
    $img = "../uploads/restaurants/".$row['image'];
    if(empty($row['image']) || !file_exists($img)){
        $img = "../uploads/no-image.png";
    }
?>
<div class="card">
    <img src="<?= $img ?>">
    <h4><?= htmlspecialchars($row['restaurant_name']) ?></h4>
    <p>📞 <?= $row['mobile'] ?></p>
    <p>✉️ <?= $row['email'] ?></p>
    <small><?= nl2br(htmlspecialchars($row['food_list'])) ?></small>

    <div class="btns">
        <a class="edit" href="restaurant_edit.php?id=<?= $row['id'] ?>">Edit</a>
        <a class="del" href="restaurant_delete.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Delete?')">Delete</a>
    </div>
</div>
<?php } ?>
</div>

</body>
</html>
