<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

// Fetch all the data for the municipal services
$query = "SELECT * FROM poro_services";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>পৌর সেবা</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<h2>পৌর সেবা</h2>

<!-- Add New Button for Poro Services -->
<div style="text-align: center; margin-bottom: 20px;">
    <a href="poro_add.php" class="add-new-btn">➕ Add New Poro Service</a>
</div>

<div class="poro-grid">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="poro-card">
            <!-- Mayor Information -->
            <div class="poro-name"><strong>মেয়র:</strong> <?= htmlspecialchars($row['mayor_name']) ?> (মোবাইল: <?= htmlspecialchars($row['mayor_mobile']) ?>)</div>

            <!-- Secretary Information -->
            <div class="poro-name"><strong>সচিব:</strong> <?= htmlspecialchars($row['secretary_name']) ?> (মোবাইল: <?= htmlspecialchars($row['secretary_mobile']) ?>)</div>

            <!-- Ward Councilor Information -->
            <div class="poro-name"><strong>ওয়ার্ড ১:</strong> <?= htmlspecialchars($row['ward1_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward1_mobile']) ?>)</div>
            <div class="poro-name"><strong>ওয়ার্ড ২:</strong> <?= htmlspecialchars($row['ward2_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward2_mobile']) ?>)</div>
            <div class="poro-name"><strong>ওয়ার্ড ৩:</strong> <?= htmlspecialchars($row['ward3_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward3_mobile']) ?>)</div>
            <div class="poro-name"><strong>ওয়ার্ড ৪:</strong> <?= htmlspecialchars($row['ward4_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward4_mobile']) ?>)</div>
            <div class="poro-name"><strong>ওয়ার্ড ৫:</strong> <?= htmlspecialchars($row['ward5_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward5_mobile']) ?>)</div>
            <div class="poro-name"><strong>ওয়ার্ড ৬:</strong> <?= htmlspecialchars($row['ward6_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward6_mobile']) ?>)</div>
            <div class="poro-name"><strong>ওয়ার্ড ৭:</strong> <?= htmlspecialchars($row['ward7_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward7_mobile']) ?>)</div>
            <div class="poro-name"><strong>ওয়ার্ড ৮:</strong> <?= htmlspecialchars($row['ward8_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward8_mobile']) ?>)</div>
            <div class="poro-name"><strong>ওয়ার্ড ৯:</strong> <?= htmlspecialchars($row['ward9_name']) ?> (মোবাইল: <?= htmlspecialchars($row['ward9_mobile']) ?>)</div>

            <!-- Water Supply Representative -->
            <div class="poro-name"><strong>পানি সরবরাহ:</strong> <?= htmlspecialchars($row['water_supply_name']) ?> (মোবাইল: <?= htmlspecialchars($row['water_supply_mobile']) ?>)</div>

            <!-- Road Repair Representative -->
            <div class="poro-name"><strong>রাস্তা সংস্কার:</strong> <?= htmlspecialchars($row['road_repair_name']) ?> (মোবাইল: <?= htmlspecialchars($row['road_repair_mobile']) ?>)</div>

            <!-- Cleanliness and Waste Management Representative -->
            <div class="poro-name"><strong>পরিচ্ছন্নতা ও বর্জ্য ব্যবস্থাপনা:</strong> <?= htmlspecialchars($row['cleanliness_waste_mgmt_name']) ?> (মোবাইল: <?= htmlspecialchars($row['cleanliness_waste_mgmt_mobile']) ?>)</div>

            <!-- Citizen Services Representative -->
            <div class="poro-name"><strong>নাগরিক সেবা:</strong> <?= htmlspecialchars($row['citizen_services_name']) ?> (মোবাইল: <?= htmlspecialchars($row['citizen_services_mobile']) ?>)</div>

            <!-- House Construction Permit Representative -->
            <div class="poro-name"><strong>বসত ঘর নির্মাণ অনুমতি:</strong> <?= htmlspecialchars($row['house_construction_permit_name']) ?> (মোবাইল: <?= htmlspecialchars($row['house_construction_permit_mobile']) ?>)</div>

            <!-- Tax Representative -->
            <div class="poro-name"><strong>আয়কর:</strong> <?= htmlspecialchars($row['tax_rep_name']) ?> (মোবাইল: <?= htmlspecialchars($row['tax_rep_mobile']) ?>)</div>

            <!-- Facebook Link -->
            <div class="poro-name">
                <strong>ফেসবুক লিংক:</strong> 
                <?php if (!empty($row['facebook_link'])) { ?>
                    <a href="<?= htmlspecialchars($row['facebook_link']) ?>" target="_blank">Visit Facebook</a>
                <?php } else { ?>
                    N/A
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

</body>
</html>
