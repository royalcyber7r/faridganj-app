<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn,"SELECT * FROM doctors ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Doctor List (Admin)</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, sans-serif;
    margin:0;
    padding:0;
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
    font-size:16px;
}
.add-new-btn:hover{
    background:#27ae60;
}

h2{
    text-align:center;
    margin-bottom:30px;
}

.doctor-grid{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:20px;
}

.doctor-card{
    width:240px;
    background:#fff;
    padding:15px;
    text-align:center;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

/* IMAGE */
.doctor-card img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #ddd;
    margin:0 auto 10px;
    display:block;
}

.doctor-name{
    font-size:18px;
    font-weight:bold;
    margin-bottom:6px;
}

/* 🔥 TEXT FIX */
.doctor-card p{
    margin:4px 0;
    font-size:14px;

    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;
}

/* 🔥 EMAIL SPECIAL FIX */
.email-text{
    word-break: break-all;
    overflow-wrap: anywhere;
}

.doctor-card a.fb{
    color:#1877f2;
    text-decoration:none;
    font-weight:bold;
}

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
    border-radius:5px;
    text-decoration:none;
}

.delete-btn{
    background:#e74c3c;
    color:#fff;
    padding:6px 14px;
    border-radius:5px;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="add-new-box">
    <a href="doctor_add.php" class="add-new-btn">➕ Add New Doctor</a>
</div>

<h2>Doctor Management</h2>

<div class="doctor-grid">

<?php while($row = mysqli_fetch_assoc($result)){

    if(!empty($row['photo']) && file_exists("../uploads/doctors/".$row['photo'])){
        $image = "../uploads/doctors/".$row['photo'];
    }else{
        $image = "../assets/no-doctor.png";
    }
?>

<div class="doctor-card">

    <img src="<?= $image ?>" alt="Doctor Photo">

    <div class="doctor-name">
        <?= htmlspecialchars($row['name']) ?>
    </div>

    <p><b>ডিপার্টমেন্ট:</b> <?= htmlspecialchars($row['department']) ?></p>
    <p><b>মোবাইল:</b> <?= htmlspecialchars($row['phone']) ?></p>

    <?php if(!empty($row['address'])){ ?>
        <p><b>ঠিকানা:</b> <?= htmlspecialchars($row['address']) ?></p>
    <?php } ?>

    <?php if(!empty($row['email'])){ ?>
        <p class="email-text">
            <b>ইমেইল:</b><br>
            <?= htmlspecialchars($row['email']) ?>
        </p>
    <?php } ?>

    <?php if(!empty($row['facebook'])){ ?>
        <p>
            <a class="fb" href="<?= htmlspecialchars($row['facebook']) ?>" target="_blank">
                Facebook
            </a>
        </p>
    <?php } ?>

    <div class="action-btns">
        <a href="doctor_edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
        <a href="doctor_delete.php?id=<?= $row['id'] ?>"
           class="delete-btn"
           onclick="return confirm('ডাক্তার ডিলিট করবেন?')">
           Delete
        </a>
    </div>

</div>

<?php } ?>

</div>

</body>
</html>
