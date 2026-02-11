<?php
session_start();
require_once "../config/db.php";

if (
    !isset($_SESSION['ADMIN_LOGIN']) ||
    $_SESSION['ADMIN_LOGIN'] !== 1 ||
    $_SESSION['role'] !== 'admin'
) {
    header("Location: /admin");
    exit();
}

function countTable(mysqli $conn, string $table): int {
    $sql = "SELECT COUNT(*) as total FROM `$table`";
    $res = mysqli_query($conn, $sql);

    if ($res && $row = mysqli_fetch_assoc($res)) {
        return (int)$row['total'];
    }

    return 0;
}

$doctorCount = countTable($conn, "doctors");
$busCount = countTable($conn, "bus");
$trainCount = countTable($conn, "train");
$locationCount = countTable($conn, "locations");
$houseCount = countTable($conn, "houses");
$shoppingCount = countTable($conn, "shopping");
$fireCount = countTable($conn, "fireservice");
$bloodCount = countTable($conn, "blood");
$diagnosticCount = countTable($conn, "diagnostic");
$weddingCount = countTable($conn, "wedding");
$policeCount = countTable($conn, "police");
$municipalCount = countTable($conn, "municipal");
$electricCount = countTable($conn, "electricity");
$technicianCount = countTable($conn, "technician");
$jobCount = countTable($conn, "jobs");
$entreCount = countTable($conn, "entrepreneur");
$teacherCount = countTable($conn, "teachers");
$hotelCount = countTable($conn, "hotels");
$restaurantCount = countTable($conn, "restaurants");
$landCount = countTable($conn, "land");
$collegeCount = countTable($conn, "colleges");
$nurseryCount = countTable($conn, "nursery");
$websiteCount = countTable($conn, "websites");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
*{box-sizing:border-box}
body{
    margin:0;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    background:#f1f5f9;
}

/* ===== Sidebar ===== */
.sidebar{
    position:fixed;
    left:0; top:0;
    width:260px;
    height:100%;
    background:linear-gradient(180deg,#111827,#1f2933);
    color:#fff;
    padding:25px 20px;
}

.sidebar h3{
    margin:0 0 25px;
    font-size:20px;
    text-align:center;
    letter-spacing:.5px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    color:#e5e7eb;
    text-decoration:none;
    padding:12px 15px;
    border-radius:8px;
    margin-bottom:8px;
    transition:.25s;
}

.sidebar a:hover{
    background:#2563eb;
    color:#fff;
}

/* ===== Content ===== */
.content{
    margin-left:280px;
    padding:35px;
}

.content h2{
    font-size:30px;
    margin-bottom:25px;
    color:#0f172a;
}

/* ===== Dashboard Cards ===== */
.dashboard{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
}

.box{
    background:#fff;
    padding:25px 20px;
    border-radius:14px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
    transition:.3s;
    position:relative;
    overflow:hidden;
}

.box::after{
    content:"";
    position:absolute;
    left:0; bottom:0;
    width:100%;
    height:4px;
    background:#2563eb;
    opacity:.8;
}

.box:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 40px rgba(0,0,0,.12);
}

.box span{
    font-size:15px;
    color:#475569;
}

.box b{
    display:block;
    margin-top:8px;
    font-size:30px;
    color:#111827;
}

/* ===== Responsive ===== */
@media(max-width:1200px){
    .dashboard{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:900px){
    .dashboard{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:600px){
    .content{margin-left:0}
    .sidebar{position:relative;width:100%;height:auto}
    .dashboard{grid-template-columns:1fr;}
}
</style>
</head>

<body>

<!-- ===== Sidebar ===== -->
<div class="sidebar">
    <h3>Admin Menu</h3>
    <a href="icons.php">✏ Icon Modify</a>
    <a href="users.php">👤 Users</a>
    <hr style="border-color:#374151">
    <a href="home_items_adds.php">🏠 Home Page Items</a>
    <a href="sub_admin_create.php">➕ Create Sub Admin</a>
    <a href="sub_users.php">👤 Sub Admin Users</a>
    <a href="logout.php">🚪Logout</a>
</div>

<!-- ===== Content ===== -->
<div class="content">
    <h2>Admin Dashboard</h2>

    <div class="dashboard">
        <div class="box"><span>Doctors</span><b><?= $doctorCount ?></b></div>
        <div class="box"><span>Bus</span><b><?= $busCount ?></b></div>
        <div class="box"><span>Train</span><b><?= $trainCount ?></b></div>
        <div class="box"><span>Locations</span><b><?= $locationCount ?></b></div>
        <div class="box"><span>House Rent</span><b><?= $houseCount ?></b></div>
        <div class="box"><span>Shopping</span><b><?= $shoppingCount ?></b></div>
        <div class="box"><span>Fire Service</span><b><?= $fireCount ?></b></div>
        <div class="box"><span>Blood</span><b><?= $bloodCount ?></b></div>
        <div class="box"><span>Diagnostic</span><b><?= $diagnosticCount ?></b></div>
        <div class="box"><span>Wedding</span><b><?= $weddingCount ?></b></div>
        <div class="box"><span>Police</span><b><?= $policeCount ?></b></div>
        <div class="box"><span>Municipal</span><b><?= $municipalCount ?></b></div>
        <div class="box"><span>Electric Office</span><b><?= $electricCount ?></b></div>
        <div class="box"><span>Technician</span><b><?= $technicianCount ?></b></div>
        <div class="box"><span>Jobs</span><b><?= $jobCount ?></b></div>
        <div class="box"><span>Entrepreneur</span><b><?= $entreCount ?></b></div>
        <div class="box"><span>Teachers</span><b><?= $teacherCount ?></b></div>
        <div class="box"><span>Hotels</span><b><?= $hotelCount ?></b></div>
        <div class="box"><span>Restaurants</span><b><?= $restaurantCount ?></b></div>
        <div class="box"><span>Land / Flat</span><b><?= $landCount ?></b></div>
        <div class="box"><span>Colleges</span><b><?= $collegeCount ?></b></div>
        <div class="box"><span>Nursery</span><b><?= $nurseryCount ?></b></div>
        <div class="box"><span>Websites</span><b><?= $websiteCount ?></b></div>
    </div>
</div>

</body>
</html>
