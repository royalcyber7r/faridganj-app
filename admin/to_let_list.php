<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$data = mysqli_query($conn,"SELECT * FROM to_let ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>To Let List</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    padding:20px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.header a{
    background:#009688;
    color:#fff;
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}

/* GRID */
.grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:20px;
}

/* CARD */
.card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
    overflow:hidden;
    transition:.3s;
}
.card:hover{
    transform:translateY(-4px);
}

.card img{
    width:100%;
    height:200px;
    object-fit:cover;
}

.card-body{
    padding:12px;
    font-size:14px;
}

.card-body p{
    margin:6px 0;
}

.price{
    color:#009688;
    font-weight:bold;
    font-size:16px;
}

.map-link{
    display:inline-block;
    margin-top:6px;
    color:#0066cc;
    font-weight:bold;
    text-decoration:none;
}

.action{
    display:flex;
    justify-content:space-between;
    margin-top:10px;
}

.action a{
    color:#009688;
    text-decoration:none;
    font-weight:bold;
}

/* RESPONSIVE */
@media(max-width:1100px){
    .grid{ grid-template-columns: repeat(3, 1fr); }
}
@media(max-width:800px){
    .grid{ grid-template-columns: repeat(2, 1fr); }
}
@media(max-width:500px){
    .grid{ grid-template-columns: repeat(1, 1fr); }
}
</style>
</head>

<body>

<div class="header">
    <h2>🏠 To Let List</h2>
    <a href="to_let_add.php">➕ নতুন যোগ করুন</a>
</div>

<div class="grid">

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<?php
$imgQ = mysqli_query(
    $conn,
    "SELECT image FROM to_let_images 
     WHERE to_let_id=".$row['id']." LIMIT 1"
);
$img = mysqli_fetch_assoc($imgQ);
?>

<div class="card">

    <?php if($img && !empty($img['image'])){ ?>
        <img src="../uploads/<?= htmlspecialchars($img['image']) ?>">
    <?php }else{ ?>
        <img src="https://via.placeholder.com/400x200?text=No+Image">
    <?php } ?>

    <div class="card-body">
        <p><b>ধরন:</b> <?= htmlspecialchars($row['house_type']) ?></p>
        <p><b>আয়তন:</b> <?= htmlspecialchars($row['area']) ?> sqft</p>
        <p><b>রুম:</b> <?= htmlspecialchars($row['rooms']) ?> |
           <b>বাথ:</b> <?= htmlspecialchars($row['washroom']) ?></p>

        <p class="price">৳ <?= htmlspecialchars($row['rent']) ?></p>

        <p>
            📞 
            <a href="tel:<?= htmlspecialchars($row['phone']) ?>">
                <?= htmlspecialchars($row['phone']) ?>
            </a>
        </p>

        <p>📍 <?= htmlspecialchars($row['address']) ?></p>

        <?php if(!empty($row['google_map_link'])){ ?>
            <a class="map-link"
               href="<?= htmlspecialchars($row['google_map_link']) ?>"
               target="_blank">
               🗺️ View on Google Map
            </a>
        <?php } ?>

        <div class="action">
            <a href="to_let_edit.php?id=<?= $row['id'] ?>">Edit</a>
            <a href="to_let_delete.php?id=<?= $row['id'] ?>"
               onclick="return confirm('ডিলিট করতে চান?')">
               Delete
            </a>
        </div>
    </div>
</div>

<?php } ?>

</div>

</body>
</html>
