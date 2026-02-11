<?php
include "../db.php";

$result = mysqli_query($conn, "SELECT * FROM diagnostic");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>ডায়গনস্টিক তালিকা</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
        }
        .container{
            width:95%;
            margin:auto;
            margin-top:20px;
        }
        .diagnostic-grid{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
            gap:15px;
        }
        .diagnostic-card{
            background:#fff;
            padding:15px;
            text-align:center;
            border-radius:8px;
            box-shadow:0 2px 6px rgba(0,0,0,.1);
        }
        .diagnostic-card img{
            width:110px;
            height:110px;
            border-radius:50%;
            object-fit:cover;
            margin-bottom:10px;
            border:1px solid #ddd;
        }

        .diagnostic-name{
            font-size:16px;
            font-weight:bold;
            margin-top:8px;
            text-align:center;
            word-break: break-word;
        }

        .diagnostic-dept{
            font-size:14px;
            color:#555;
            margin-top:4px;
            text-align:center;
        }

        .diagnostic-phone{
            font-size:14px;
            color:#222;
            margin-top:4px;
            text-align:center;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>🚑 ডায়গনস্টিক তালিকা</h2>

    <div class="diagnostic-grid">
    <?php while($row = mysqli_fetch_assoc($result)){ 
        $photoPath = "../uploads/diagnostic/".$row['photo'];

        // যদি ছবি না থাকে
        if(empty($row['photo']) || !file_exists($photoPath)){
            $photoPath = "../uploads/no-image.png";
        }
    ?>
        <div class="diagnostic-card">
            <img src="<?= $photoPath ?>">

            <div class="diagnostic-name">
                <?= htmlspecialchars($row['name']) ?>
            </div>

            <div class="diagnostic-dept">
                <?= htmlspecialchars($row['address']) ?>
            </div>

            <div class="diagnostic-phone">
                <?= htmlspecialchars($row['mobile']) ?>
            </div>

            <p><?= htmlspecialchars($row['email']) ?></p>
        </div>
    <?php } ?>
    </div>

</div>

</body>
</html>
