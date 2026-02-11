<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn,"SELECT * FROM police");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Police List (Admin)</title>
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

.total-police{
    font-size:16px;
}

.page-title{
    font-size:26px;
    margin-bottom:30px;
}

.police-grid{
    display:flex;
    justify-content:center;
}

.police-card{
    text-align:center;
}

.police-grid img{
    width:120px;
    height:120px;
    border-radius:50% !important;
    object-fit:cover;
    border:3px solid #ddd;
    display:block;
    margin:0 auto 10px;
}


.police-card img{
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

<!-- Add New police button -->
<div class="add-new-box">
    <a href="police_add.php" class="add-new-btn">
        ➕ Add New police
    </a>
</div>

<h2 style="text-align:center;">police Management</h2>

<div class="police-grid">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div style="border:1px solid #ccc; width:220px; padding:10px; text-align:center; display:inline-block;">
        <img src="../uploads/police/<?= $row['photo'] ?>" width="120"><br>
        <b><?= $row['name'] ?></b><br>
        <p><?= $row['department']; ?></p>
		<p><?php echo $row['address']; ?></p>
        <p> <?= $row['phone'] ?></p>
		<p><?php echo $row['qualification']; ?></p>
        <p><?php echo $row['email']; ?></p>
        <a href="police_edit.php?id=<?= $row['docid'] ?>">Edit</a> |
        <a href="police_delete.php?id=<?= $row['docid'] ?>" onclick="return confirm('Delete?')">Delete</a>
    </div>
<?php } ?>
</div>

</body>
</html>
