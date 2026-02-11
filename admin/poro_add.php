<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if (isset($_POST['save'])) {
    // Sanitize and fetch data from form with fallback for empty values
    $mayor_name = isset($_POST['mayor_name']) ? mysqli_real_escape_string($conn, $_POST['mayor_name']) : '';
    $mayor_mobile = isset($_POST['mayor_mobile']) ? mysqli_real_escape_string($conn, $_POST['mayor_mobile']) : '';
    $secretary_name = isset($_POST['secretary_name']) ? mysqli_real_escape_string($conn, $_POST['secretary_name']) : '';
    $secretary_mobile = isset($_POST['secretary_mobile']) ? mysqli_real_escape_string($conn, $_POST['secretary_mobile']) : '';

    // Service Representatives
    $water_supply_name = isset($_POST['water_supply_name']) ? mysqli_real_escape_string($conn, $_POST['water_supply_name']) : '';
    $water_supply_mobile = isset($_POST['water_supply_mobile']) ? mysqli_real_escape_string($conn, $_POST['water_supply_mobile']) : '';
    $road_repair_name = isset($_POST['road_repair_name']) ? mysqli_real_escape_string($conn, $_POST['road_repair_name']) : '';
    $road_repair_mobile = isset($_POST['road_repair_mobile']) ? mysqli_real_escape_string($conn, $_POST['road_repair_mobile']) : '';
    $cleanliness_name = isset($_POST['cleanliness_name']) ? mysqli_real_escape_string($conn, $_POST['cleanliness_name']) : '';
    $cleanliness_mobile = isset($_POST['cleanliness_mobile']) ? mysqli_real_escape_string($conn, $_POST['cleanliness_mobile']) : '';
    
    // Other services
    $citizen_service_name = isset($_POST['citizen_service_name']) ? mysqli_real_escape_string($conn, $_POST['citizen_service_name']) : '';
    $citizen_service_mobile = isset($_POST['citizen_service_mobile']) ? mysqli_real_escape_string($conn, $_POST['citizen_service_mobile']) : '';
    $house_construction_name = isset($_POST['house_construction_name']) ? mysqli_real_escape_string($conn, $_POST['house_construction_name']) : '';
    $house_construction_mobile = isset($_POST['house_construction_mobile']) ? mysqli_real_escape_string($conn, $_POST['house_construction_mobile']) : '';
    
    // Insert the data into the database
    $query = "INSERT INTO poro_services (
                mayor_name, mayor_mobile, secretary_name, secretary_mobile,
                water_supply_name, water_supply_mobile, road_repair_name, road_repair_mobile, 
                cleanliness_name, cleanliness_mobile, citizen_service_name, citizen_service_mobile,
                house_construction_name, house_construction_mobile
              ) VALUES (
                '$mayor_name', '$mayor_mobile', '$secretary_name', '$secretary_mobile',
                '$water_supply_name', '$water_supply_mobile', '$road_repair_name', '$road_repair_mobile',
                '$cleanliness_name', '$cleanliness_mobile', '$citizen_service_name', '$citizen_service_mobile',
                '$house_construction_name', '$house_construction_mobile'
              )";

    if (mysqli_query($conn, $query)) {
        header("Location: poro_list.php");  // Redirect after saving
    } else {
        die("Error inserting data: " . mysqli_error($conn));
    }
}
?>


<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>পৌর সেবা যোগ করুন</title>
    <style>
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }

        .form-container input, .form-container textarea {
            width: 48%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .form-container .full-width {
            width: 100%;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<h2>পৌর সেবা যোগ করুন</h2>

<form method="post" class="form-container">
    <!-- Mayor & Secretary Information -->
    <div class="half-width">
        <label for="mayor_name">মেয়র নাম:</label>
        <input type="text" name="mayor_name" placeholder="মেয়র নাম" required><br><br>
    </div>
    <div class="half-width">
        <label for="mayor_mobile">মোবাইল:</label>
        <input type="text" name="mayor_mobile" placeholder="মোবাইল" required><br><br>
    </div>
    <div class="half-width">
        <label for="secretary_name">সচিব নাম:</label>
        <input type="text" name="secretary_name" placeholder="সচিব নাম" required><br><br>
    </div>
    <div class="half-width">
        <label for="secretary_mobile">সচিব মোবাইল:</label>
        <input type="text" name="secretary_mobile" placeholder="সচিব মোবাইল" required><br><br>
    </div>

    <!-- Service Representative Information -->
    <div class="half-width">
        <label for="water_supply_name">পানি সরবরাহ নাম:</label>
        <input type="text" name="water_supply_name" placeholder="পানি সরবরাহ নাম" required><br><br>
    </div>
    <div class="half-width">
        <label for="water_supply_mobile">পানি সরবরাহ মোবাইল:</label>
        <input type="text" name="water_supply_mobile" placeholder="পানি সরবরাহ মোবাইল" required><br><br>
    </div>
    <div class="half-width">
        <label for="road_repair_name">রাস্তা সংস্কার নাম:</label>
        <input type="text" name="road_repair_name" placeholder="রাস্তা সংস্কার নাম" required><br><br>
    </div>
    <div class="half-width">
        <label for="road_repair_mobile">রাস্তা সংস্কার মোবাইল:</label>
        <input type="text" name="road_repair_mobile" placeholder="রাস্তা সংস্কার মোবাইল" required><br><br>
    </div>
    <div class="half-width">
        <label for="cleanliness_name">পরিচ্ছন্নতা নাম:</label>
        <input type="text" name="cleanliness_name" placeholder="পরিচ্ছন্নতা নাম" required><br><br>
    </div>
    <div class="half-width">
        <label for="cleanliness_mobile">পরিচ্ছন্নতা মোবাইল:</label>
        <input type="text" name="cleanliness_mobile" placeholder="পরিচ্ছন্নতা মোবাইল" required><br><br>
    </div>

    <!-- Other services fields -->
    <div class="half-width">
        <label for="citizen_service_name">নাগরিক সেবা নাম:</label>
        <input type="text" name="citizen_service_name" placeholder="নাগরিক সেবা নাম" required><br><br>
    </div>
    <div class="half-width">
        <label for="citizen_service_mobile">নাগরিক সেবা মোবাইল:</label>
        <input type="text" name="citizen_service_mobile" placeholder="নাগরিক সেবা মোবাইল" required><br><br>
    </div>
    <div class="half-width">
        <label for="house_construction_name">বসত ঘর নাম:</label>
        <input type="text" name="house_construction_name" placeholder="বসত ঘর নাম" required><br><br>
    </div>
    <div class="half-width">
        <label for="house_construction_mobile">বসত ঘর মোবাইল:</label>
        <input type="text" name="house_construction_mobile" placeholder="বসত ঘর মোবাইল" required><br><br>
    </div>

    <!-- Submit -->
    <div class="full-width">
        <button type="submit" name="save">Save</button>
    </div>
</form>

</body>
</html>
