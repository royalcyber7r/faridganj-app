<?php
include "../db.php";

// Fetch all couriers from the database
$query = "SELECT * FROM courier_companies";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>কুরিয়ার সার্ভিস তালিকা</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
	
<style>
    .body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
    }
    .container {
        width: 95%;
        margin: auto;
        margin-top: 20px;
    }
    .courier-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }
    .courier-card {
        background: #fff;
        padding: 15px;
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .courier-card img {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 1px solid #ddd;
    }

    .courier-name {
        font-size: 16px;
        font-weight: bold;
        margin-top: 8px;
        text-align: center;
        word-break: break-word;
    }

    .courier-dept {
        font-size: 14px;
        color: #555;
        margin-top: 4px;
        text-align: center;
    }

    .courier-phone {
        font-size: 14px;
        color: #222;
        margin-top: 4px;
        text-align: center;
    }
</style>	
	
</head>

<body>

<h2>কুরিয়ার সার্ভিস তালিকা</h2>

<div class="courier-grid">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="courier-card">
            <img src="../uploads/courier/<?= $row['photo'] ?>" alt="Courier Photo" width="120"><br>

            <div class="courier-name"><?= htmlspecialchars($row['name']) ?></div>
            <div class="courier-phone"><?= htmlspecialchars($row['phone']) ?></div>
            <div class="courier-address"><?= htmlspecialchars($row['address']) ?></div>
            <div class="courier-email"><?= htmlspecialchars($row['email']) ?></div>
            <div class="courier-facebook">
                <a href="<?= htmlspecialchars($row['facebook_link']) ?>" target="_blank">Facebook</a>
            </div>
        </div>
    <?php } ?>
</div>

</body>
</html>
