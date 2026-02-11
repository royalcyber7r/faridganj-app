<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn,"SELECT * FROM wedding");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wedding List (Admin)</title>
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

.total-wedding{
    font-size:16px;
}

.page-title{
    font-size:26px;
    margin-bottom:30px;
}

.wedding-grid{
    display:flex;
    justify-content:center;
}

.wedding-card{
    text-align:center;
}

.wedding-grid img{
    width:120px;
    height:120px;
    border-radius:50% !important;
    object-fit:cover;
    border:3px solid #ddd;
    display:block;
    margin:0 auto 10px;
}

.wedding-card img{
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

<!-- Add New wedding button -->
<div class="add-new-box">
    <a href="Wedding_add.php" class="add-new-btn">
        ➕ Add New Wedding
    </a>
</div>

<h2 style="text-align:center;">Wedding Management</h2>

<div class="wedding-grid">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div style="border:1px solid #ccc; width:220px; padding:10px; text-align:center; display:inline-block;">
        <img src="../uploads/Wedding/<?= $row['photo'] ?>" width="120"><br>

        <!-- organization নামের উপরে -->
        <b><?= $row['organization'] ?></b><br>

        <b><?= $row['name'] ?></b><br>

        <p><?= $row['address']; ?></p>
        <p><?= $row['mobile']; ?></p>
        <p><?= $row['email']; ?></p>

        <!-- experience ইমেইলের পরে -->
        <b><?= $row['experience'] ?></b><br>

        <a href="Wedding_edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="Wedding_delete.php?id=<?= $row['id'] ?>" 
           onclick="return confirm('Delete?')">Delete</a>
    </div>
<?php } ?>
</div>

</body>
</html>
