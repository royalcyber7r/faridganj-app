<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

$result = mysqli_query($conn, "SELECT * FROM workers ORDER BY id DESC");
if(!$result){
    die("Query Error: " . mysqli_error($conn));
}

/**
 * 🔥 ROOT CONFIG
 * project folder name ঠিক করে দাও
 * example: http://localhost/faridganj-app
 */
$PROJECT_FOLDER = "faridganj-app";
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Worker List (Admin)</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, sans-serif;
    margin:0;
    padding:0;
}
.add-new-box{text-align:center;margin:20px 0;}
.add-new-btn{
    background:#2ecc71;color:#fff;padding:10px 18px;
    text-decoration:none;border-radius:6px;font-size:16px;
}
.add-new-btn:hover{background:#27ae60;}
h2{text-align:center;margin-bottom:30px;}

.worker-grid{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:20px;
}
.worker-card{
    width:240px;background:#fff;padding:15px;text-align:center;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}
.worker-card img{
    width:120px;height:120px;border-radius:50%;
    object-fit:cover;border:3px solid #ddd;
    margin:0 auto 10px;display:block;
}
.worker-name{font-size:18px;font-weight:bold;margin-bottom:6px;}
.worker-card p{margin:4px 0;font-size:14px;}
.worker-card a.fb{color:#1877f2;text-decoration:none;font-weight:bold;}

.action-btns{
    display:flex;justify-content:center;
    gap:10px;margin-top:12px;
}
.edit-btn{
    background:#3498db;color:#fff;
    padding:6px 14px;border-radius:5px;
    text-decoration:none;
}
.delete-btn{
    background:#e74c3c;color:#fff;
    padding:6px 14px;border-radius:5px;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="add-new-box">
    <a href="worker_add.php" class="add-new-btn">➕ Add New Worker</a>
</div>

<h2>Worker Management</h2>

<div class="worker-grid">

<?php
while($row = mysqli_fetch_assoc($result)){

    // ✅ SERVER PATH (file check)
    $serverPath = $_SERVER['DOCUMENT_ROOT'] . "/$PROJECT_FOLDER/uploads/workers/";

    // ✅ BROWSER PATH (image show)
    $browserPath = "/$PROJECT_FOLDER/uploads/workers/";

    if(!empty($row['photo']) && file_exists($serverPath . $row['photo'])){
        $image = $browserPath . $row['photo'];
    }else{
        $image = "/$PROJECT_FOLDER/assets/no-worker.png";
    }
?>

<div class="worker-card">

    <img src="<?= htmlspecialchars($image) ?>" alt="Worker Photo">

    <div class="worker-name">
        <?= htmlspecialchars($row['name']) ?>
    </div>

    <p><b>ডিপার্টমেন্ট:</b> <?= htmlspecialchars($row['department']) ?></p>
    <p><b>মোবাইল:</b> <?= htmlspecialchars($row['phone']) ?></p>

    <?php if(!empty($row['address'])){ ?>
        <p><b>ঠিকানা:</b> <?= htmlspecialchars($row['address']) ?></p>
    <?php } ?>

    <?php if(!empty($row['email'])){ ?>
        <p><b>ইমেইল:</b> <?= htmlspecialchars($row['email']) ?></p>
    <?php } ?>

    <?php if(!empty($row['facebook'])){ ?>
        <p>
            <a class="fb" href="<?= htmlspecialchars($row['facebook']) ?>" target="_blank">
                Facebook
            </a>
        </p>
    <?php } ?>

    <div class="action-btns">
        <a href="worker_edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
        <a href="worker_delete.php?id=<?= $row['id'] ?>"
           class="delete-btn"
           onclick="return confirm('কর্মচারী ডিলিট করবেন?')">
           Delete
        </a>
    </div>

</div>

<?php } ?>

</div>

</body>
</html>
