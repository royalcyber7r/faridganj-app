<?php
include "../db.php";

$sql = "SELECT * FROM workers ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if(!$result){
    die("Query Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>কর্মচারী তালিকা</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
}

.container{
    width:95%;
    margin:auto;
    margin-top:20px;
}

h2{
    margin-bottom:15px;
}

/* GRID */
.worker-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
    gap:15px;
}

/* CARD */
.worker-card{
    background:#fff;
    padding:15px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,.1);
}

/* IMAGE */
.worker-card img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #eee;
    margin-bottom:10px;
}

/* TEXT */
.worker-card h4{
    margin:6px 0;
    font-size:18px;
}

.worker-card p{
    margin:4px 0;
    font-size:14px;
    word-break: break-word;
}

/* EMAIL FIX */
.email-text{
    word-break: break-all;
    overflow-wrap:anywhere;
}

/* LINK */
.worker-card a{
    color:#0d6efd;
    text-decoration:none;
    font-size:14px;
}
</style>
</head>

<body>

<div class="container">
    <h2>👷‍♂️ কর্মচারী তালিকা</h2>

    <div class="worker-grid">

    <?php while($row = mysqli_fetch_assoc($result)){

        // IMAGE FIX
        if(!empty($row['photo']) && file_exists("../uploads/workers/".$row['photo'])){
            $photo = "../uploads/workers/".$row['photo'];
        }else{
            $photo = "../assets/default-worker.png";
        }
    ?>

        <div class="worker-card">

            <img src="<?= $photo ?>" alt="Worker Photo">

            <h4><?= htmlspecialchars($row['name']) ?></h4>

            <p><strong>ডিপার্টমেন্ট:</strong>
                <?= htmlspecialchars($row['department']) ?>
            </p>

            <p><strong>মোবাইল:</strong>
                <?= htmlspecialchars($row['phone']) ?>
            </p>

            <?php if(!empty($row['address'])){ ?>
                <p><strong>ঠিকানা:</strong><br>
                    <?= htmlspecialchars($row['address']) ?>
                </p>
            <?php } ?>

            <?php if(!empty($row['email'])){ ?>
                <p class="email-text">
                    <strong>ইমেইল:</strong><br>
                    <?= htmlspecialchars($row['email']) ?>
                </p>
            <?php } ?>

            <?php if(!empty($row['facebook'])){ ?>
                <p>
                    <a href="<?= htmlspecialchars($row['facebook']) ?>" target="_blank">
                        🔗 Facebook Profile
                    </a>
                </p>
            <?php } ?>

        </div>

    <?php } ?>

    </div>
</div>

</body>
</html>
