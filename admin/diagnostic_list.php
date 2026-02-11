<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn,"SELECT * FROM diagnostic");
?>

<!DOCTYPE html>
<html>
<head>
    <title>diagnostic List (Admin)</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
	
<style>

body{
    background: ### !important;
}

.page-center{
    width:100%;
    text-align:center;
    margin-top:30px;
}

.total-diagnostic{
    font-size:16px;
}

.page-title{
    font-size:26px;
    margin-bottom:30px;
}

.diagnostic-grid{
    display:flex;
    justify-content:center;
}

.diagnostic-card{
    text-align:center;
}

.diagnostic-grid img{
    width:120px;
    height:120px;
    border-radius:50% !important;
    object-fit:cover;
    border:3px solid #ddd;
    display:block;
    margin:0 auto 10px;
}

.diagnostic-card img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #ddd;
    margin-bottom:10px;
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
}

.delete-btn{
    background:#e74c3c;
    color:#fff;
    padding:5px 10px;
    text-decoration:none;
    border-radius:4px;
}

</style>	
	
</head>

<body>

<!-- Add New diagnostic button -->
<div class="add-new-box">
    <a href="diagnostic_add.php" class="add-new-btn">
        ➕ Add New diagnostic
    </a>
</div>

<h2 style="text-align:center;">diagnostic Management</h2>

<div class="diagnostic-grid">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div style="border:1px solid #ccc; width:220px; padding:10px; text-align:center; display:inline-block;">
        <img src="../uploads/diagnostic/<?= $row['photo'] ?>" width="120"><br>

        <b><?= $row['name'] ?></b><br>

        <p><?= $row['address']; ?></p>
        <p><?= $row['mobile']; ?></p>
        <p><?= $row['email']; ?></p>

        <a href="diagnostic_edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="diagnostic_delete.php?id=<?= $row['id'] ?>" 
           onclick="return confirm('Delete?')">Delete</a>
    </div>
<?php } ?>
</div>

</body>
</html>
