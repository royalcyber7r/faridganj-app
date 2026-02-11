<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn, "SELECT * FROM ambulance ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ambulance List (Admin)</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
    margin:0;
    padding:20px;
}

/* ===== ADD NEW ===== */
.add-new-box{
    margin-bottom:20px;
}
.add-new-btn{
    display:inline-block;
    background:#2ecc71;
    color:#fff;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}
.add-new-btn:hover{
    background:#27ae60;
}

/* ===== TITLE ===== */
.page-title{
    text-align:center;
    font-size:28px;
    margin-bottom:30px;
}

/* ===== GRID ===== */
.ambulance-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

/* Responsive */
@media(max-width:1100px){
    .ambulance-grid{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:900px){
    .ambulance-grid{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:550px){
    .ambulance-grid{grid-template-columns:repeat(1,1fr);}
}

/* ===== CARD ===== */
.ambulance-card{
    background:#fff;
    border-radius:14px;
    padding:20px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
    transition:.3s;
}
.ambulance-card:hover{
    transform:translateY(-6px);
}

/* Photo */
.ambulance-card img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #3498db;
    margin-bottom:10px;
}

/* Info */
.ambulance-card h3{
    margin:8px 0 6px;
    font-size:18px;
}
.ambulance-card p{
    margin:4px 0;
    font-size:14px;
    color:#555;
}

/* Buttons */
.action-btns{
    display:flex;
    justify-content:center;
    gap:10px;
    margin-top:12px;
}
.edit-btn{
    background:#3498db;
    color:#fff;
    padding:6px 14px;
    border-radius:6px;
    text-decoration:none;
    font-size:14px;
}
.delete-btn{
    background:#e74c3c;
    color:#fff;
    padding:6px 14px;
    border-radius:6px;
    text-decoration:none;
    font-size:14px;
}
.edit-btn:hover{background:#2980b9;}
.delete-btn:hover{background:#c0392b;}
</style>
</head>

<body>

<!-- Add New -->
<div class="add-new-box">
    <a href="ambulance_add.php" class="add-new-btn">➕ Add New Ambulance</a>
</div>

<div class="page-title">🚑 Ambulance Management</div>

<div class="ambulance-grid">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="ambulance-card">

        <img src="../uploads/ambulance/<?= htmlspecialchars($row['photo']) ?>" alt="Ambulance">

        <h3><?= htmlspecialchars($row['name']) ?></h3>

        <p><?= htmlspecialchars($row['address']) ?></p>
        <p>📞 <?= htmlspecialchars($row['mobile']) ?></p>
        <p>✉ <?= htmlspecialchars($row['email']) ?></p>

        <div class="action-btns">
        <a href="ambulance_edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
        <a href="ambulance_delete.php?id=<?= $row['id'] ?>"
            onclick="return confirm('Are you sure?')" class="delete-btn">
            Delete
        </a>
        </div>

    </div>
<?php } ?>
</div>

</body>
</html>
