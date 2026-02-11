<?php
include "../db.php";

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
    <title>গাড়ি ভাড়া তালিকা</title>
    <link rel="stylesheet" href="../assets/css/admin.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            width: 95%;
            margin: auto;
            margin-top: 20px;
        }

        .vehicle-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .vehicle-card {
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
            border: 1px solid #ddd;
        }

        .vehicle-name {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
            word-break: break-word;
        }

        .vehicle-type {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
            text-align: center;
        }

        .vehicle-number,
        .vehicle-contact {
            font-size: 14px;
            color: #222;
            margin-top: 5px;
            text-align: center;
        }

        /* Preventing the email overflow */
        .vehicle-contact p {
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
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
    </style>
</head>

<body>

<div class="container">
    <h2>গাড়ি ভাড়া তালিকা</h2>

    <div class="vehicle-grid">
        <?php while ($row = mysqli_fetch_assoc($result)) {
            $photoPath = "../uploads/vehicle/" . $row['photo'];
            if (empty($row['photo']) || !file_exists($photoPath)) {
                $photoPath = "../uploads/no-image.png"; // Default image if no photo exists
            }
        ?>
            <div class="vehicle-card">
                <img src="<?= $photoPath ?>" alt="Vehicle Image">

                <div class="vehicle-name"><?= htmlspecialchars($row['name']) ?></div>
                <div class="vehicle-type"><?= htmlspecialchars($row['vehicle_type']) ?></div>
                <div class="vehicle-number"><strong>Vehicle No:</strong> <?= htmlspecialchars($row['vehicle_number']) ?></div>

                <div class="vehicle-contact">
                    <p><strong>Mobile:</strong> <?= htmlspecialchars($row['mobile']) ?></p>
                    <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></p>
                    
                    <!-- Display Facebook link if exists -->
                    <?php if (!empty($row['facebook_link'])) { ?>
                        <p><strong>Facebook:</strong> <a href="<?= htmlspecialchars($row['facebook_link']) ?>" target="_blank">Visit Facebook</a></p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
