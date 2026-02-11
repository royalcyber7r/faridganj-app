<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

// Fetch all vehicles from the database
$query = "SELECT * FROM vehicle_rent";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die('Query failed: ' . mysqli_error($conn)); // Output the SQL error
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>গাড়ির তালিকা (এডমিন)</title>
    <link rel="stylesheet" href="../assets/css/admin.css">

    <style>
        body {
            background: #f4f6f9 !important;
            font-family: Arial, sans-serif;
        }

        .page-center {
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }

        .total-vehicle {
            font-size: 16px;
        }

        .page-title {
            font-size: 26px;
            margin-bottom: 30px;
        }

        .vehicle-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .vehicle-card {
            text-align: center;
            border: 1px solid #ccc;
            width: 220px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .vehicle-card:hover {
            transform: scale(1.05);
        }

        .vehicle-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid #ddd;
        }

        .vehicle-name {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }

        .vehicle-info {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
            text-align: center;
            word-wrap: break-word; /* Wraps the text to prevent overflow */
            overflow-wrap: break-word; /* Ensures long words are wrapped */
            max-width: 100%; /* Prevents overflow */
            word-break: break-word; /* Ensures email wraps correctly */
        }

        .action-btns {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .edit-btn {
            background: #3498db;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .delete-btn {
            background: #e74c3c;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .add-new-box {
            text-align: center;
            margin-bottom: 20px;
        }

        .add-new-btn {
            background: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }

        .add-new-btn:hover {
            background: #27ae60;
        }
    </style>

</head>

<body>

<!-- Add New Vehicle button -->
<div class="add-new-box">
    <a href="vehicle_add.php" class="add-new-btn">➕ Add New Vehicle</a>
</div>

<h2 class="page-title">গাড়ি ম্যানেজমেন্ট</h2>

<div class="vehicle-grid">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="vehicle-card">
            <!-- Vehicle Image -->
            <img src="../uploads/vehicle/<?= $row['photo'] ?>" alt="Vehicle Image" width="120"><br>

            <div class="vehicle-name"><?= htmlspecialchars($row['name']) ?></div>
            <div class="vehicle-info"><strong>গাড়ির ধরন:</strong> <?= htmlspecialchars($row['vehicle_type']) ?></div>
            <div class="vehicle-info"><strong>ঠিকানা:</strong> <?= htmlspecialchars($row['address']) ?></div>
            <div class="vehicle-info"><strong>মোবাইল নাম্বার:</strong> <?= htmlspecialchars($row['mobile']) ?></div>
            <div class="vehicle-info"><strong>ইমেইল:</strong> <a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></div>
            <div class="vehicle-info"><strong>ফেসবুক:</strong> 
                <?php if (!empty($row['facebook_link'])) { ?>
                    <a href="<?= htmlspecialchars($row['facebook_link']) ?>" target="_blank">Facebook</a>
                <?php } else { ?>
                    N/A
                <?php } ?>
            </div>

            <div class="action-btns">
                <a href="vehicle_edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                <a href="vehicle_delete.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this vehicle?')">Delete</a>
            </div>
        </div>
    <?php } ?>
</div>

</body>
</html>
