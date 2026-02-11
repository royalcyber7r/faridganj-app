<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn,"SELECT * FROM socialorg ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Social Organization List</title>

<style>
*{
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#f4f6f9;
    margin:0;
    padding:0;
}

/* Add new button */
.add-new-box{
    text-align:left;
    padding:20px 40px;
}
.add-new-btn{
    color:#1d4ed8;
    font-weight:bold;
    text-decoration:none;
}

/* Title */
.page-title{
    text-align:center;
    font-size:26px;
    margin-bottom:30px;
}

/* Grid */
.socialorg-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
    gap:25px;
    max-width:1200px;
    margin:0 auto 50px;
    padding:0 20px;
}

/* Card */
.socialorg-card{
    background:#fff;
    border-radius:18px;
    padding:20px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
    transition:.3s;
}
.socialorg-card:hover{
    transform:translateY(-4px);
}

/* Image */
.socialorg-card img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #e5e7eb;
    margin-bottom:10px;
}

/* Text */
.org-name{
    font-weight:bold;
    font-size:16px;
    margin-bottom:6px;
}
.person-name{
    font-weight:bold;
    margin-bottom:6px;
}
.info{
    font-size:14px;
    color:#444;
    margin:4px 0;
}

/* 🔥 Email fix */
.email{
    font-size:14px;
    color:#111;
    word-break:break-all;   /* VERY IMPORTANT */
    overflow-wrap:anywhere;
}

/* Experience */
.exp{
    font-weight:bold;
    margin-top:6px;
}

/* Buttons */
.action-btns{
    display:flex;
    justify-content:center;
    gap:10px;
    margin-top:12px;
}
.action-btns a{
    padding:6px 14px;
    border-radius:6px;
    font-size:13px;
    text-decoration:none;
    color:#fff;
}
.edit-btn{ background:#2563eb; }
.delete-btn{ background:#dc2626; }
</style>

</head>
<body>

<div class="add-new-box">
    <a href="socialorg_add.php" class="add-new-btn">➕ Add New socialorg</a>
</div>

<h2 class="page-title">socialorg Management</h2>

<div class="socialorg-grid">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="socialorg-card">

        <img src="../uploads/socialorg/<?= $row['photo'] ?: 'default.png' ?>">

        <div class="org-name"><?= htmlspecialchars($row['organization']) ?></div>
        <div class="person-name"><?= htmlspecialchars($row['name']) ?></div>

        <div class="info"><?= htmlspecialchars($row['address']) ?></div>
        <div class="info"><?= htmlspecialchars($row['mobile']) ?></div>

        <div class="email"><?= htmlspecialchars($row['email']) ?></div>

        <div class="exp"><?= htmlspecialchars($row['experience']) ?></div>

        <div class="action-btns">
            <a class="edit-btn" href="socialorg_edit.php?id=<?= $row['id'] ?>">Edit</a>
            <a class="delete-btn"
               onclick="return confirm('ডিলিট করতে চান?')"
               href="socialorg_delete.php?id=<?= $row['id'] ?>">
               Delete
            </a>
        </div>
    </div>
<?php } ?>
</div>

</body>
</html>
