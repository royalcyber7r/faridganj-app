<?php
include "../db.php";

$result = mysqli_query($conn, "SELECT * FROM police");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>পুলিশ তালিকা</title>

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
        .police-grid{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
            gap:15px;
        }
        .police-card{
            background:#fff;
            padding:15px;
            text-align:center;
            border-radius:8px;
            box-shadow:0 2px 6px rgba(0,0,0,.1);
        }
        .police-card img{
            width:110px;
            height:110px;
            border-radius:50%;
            object-fit:cover;
            margin-bottom:10px;
            border:1px solid #ddd;
        }
		.police-name{
    font-size:16px;
    font-weight:bold;
    margin-top:8px;
    text-align:center;
    word-break: break-word;
}

.police-dept{
    font-size:14px;
    color:#555;
    margin-top:4px;
    text-align:center;
}

.police-phone{
    font-size:14px;
    color:#222;
    margin-top:4px;
    text-align:center;
}

		
    </style>
</head>

<body>

<div class="container">
    <h2>👮 পুলিশ তালিকা</h2>

    <div class="police-grid">
    <?php while($row = mysqli_fetch_assoc($result)){ 
        $photoPath = "../uploads/police/".$row['photo'];

        // যদি ছবি না থাকে
        if(empty($row['photo']) || !file_exists($photoPath)){
            $photoPath = "../uploads/no-image.png";
        }
    ?>
        <div class="police-card">
    <img src="<?= $photoPath ?>">

    <div class="police-name">
        <?= htmlspecialchars($row['name']) ?>
    </div>

    <div class="police-dept">
        <?= htmlspecialchars($row['department']) ?>
    </div>
    <p><?php echo $row['address']; ?></p>
    <div class="police-phone">
        <?= htmlspecialchars($row['phone']) ?>
			
    <p><?php echo $row['qualification']; ?></p>
    <p><?php echo $row['email']; ?></p>
    </div>
</div>
    <?php } ?>
    </div>

</div>

</body>
</html>
