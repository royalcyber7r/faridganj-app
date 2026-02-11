<?php
require_once "sub_admin_guard.php";
require_once "../config/db.php";

if (
    !isset($_SESSION['SUB_ADMIN_LOGIN']) ||
    $_SESSION['SUB_ADMIN_LOGIN'] !== 1 ||
    $_SESSION['role'] !== 'sub_admin'
  ) {
    http_response_code(404);
    include __DIR__ . "/errors/404.php";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sub Admin Dashboard</title>

<style>
*{
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    margin:0;
    background:#f4f6f9;
    display:flex;
}

/* Sidebar */
.sidebar{
    width:240px;
    background:linear-gradient(180deg,#0f172a,#020617);
    color:#fff;
    height:100vh;          /* fixed height */
    padding:20px;

    overflow-y:auto;      /* 🔑 sidebar only scroll */
}

.sidebar h2{
    margin-bottom:25px;
    font-size:20px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 15px;
    margin-bottom:10px;
    color:#cbd5f5;
    text-decoration:none;
    border-radius:10px;
    transition:.3s;
}

.sidebar a:hover,
.sidebar a.active{
    background:#1e293b;
    color:#fff;
}

/* Main */
.main{
    flex:1;
    padding:30px;
}

/* Header */
.header{
    font-size:26px;
    font-weight:600;
    margin-bottom:25px;
}

/* Cards grid */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:22px;
}

/* Card */
.card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 15px 35px rgba(0,0,0,.12);
    text-align:center;
    transition:.3s;
    position:relative;
}

.card::after{
    content:'';
    position:absolute;
    bottom:0;
    left:0;
    height:4px;
    width:100%;
    background:linear-gradient(90deg,#3b82f6,#6366f1);
    border-radius:0 0 18px 18px;
}

.card:hover{
    transform:translateY(-6px);
}

.card h4{
    font-weight:500;
    color:#475569;
    margin-bottom:8px;
}

.card span{
    font-size:30px;
    font-weight:700;
    color:#0f172a;
}

/* Logout */
.logout{
    margin-top:30px;
    display:inline-block;
    padding:12px 25px;
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:#fff;
    text-decoration:none;
    border-radius:30px;
    box-shadow:0 10px 25px rgba(239,68,68,.4);
}
.logout:hover{
    opacity:.9;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Sub Admin Menu</h2>

    <a class="active" href="sub_dashboard.php">🏠 Dashboard</a>

    <a href="ambulance_list.php">🚑 অ্যাম্বুলেন্স</a>
    <a href="diagnostic_list.php">🧪 ডায়াগনস্টিক</a>
    <a href="hospital_list.php">🏥 হাসপাতাল</a>
    <a href="vehicle_list.php">🚗 গাড়ি ভাড়া</a>
    <a href="courier_list.php">📦 কুরিয়ার সার্ভিস</a>
    <a href="police_list.php">👮 থানা পুলিশ</a>
    <a href="poto.php">🏛️ পৌর সেবা</a>
    <a href="poto.phppbs.php">⚡ বিদ্যুৎ অফিস</a>
    <a href="worker_list.php">🛠️ মিস্ত্রি</a>
    <a href="emargency_list.php">🚨 জরুরি সেবা</a>

    <a href="job_list.php">💼 চাকরি</a>
    <a href="uddokta_list.php">🚀 উদ্যোক্তা</a>
    <a href="teacher_list.php">👨‍🏫 শিক্ষক</a>
    <a href="hotel_list.php">🏨 হোটেল</a>
    <a href="restaurant_list.php">🍽️ রেস্টুরেন্ট</a>
    <a href="flat_list.php">🏠 ফ্ল্যাট ও জমি</a>
    <a href="education_list.php">🏫 শিক্ষা প্রতিষ্ঠান</a>
    <a href="graden_list.php">🧑‍⚕️ নার্সারি</a>
    <a href="doctor_list.php">👨‍⚕️ ডাক্তার</a>
    <a href="fireservice_list.php">🔥 ফায়ার সার্ভিস</a>

    <a href="shopping_list.php">🛍️ শপিং</a>
    <a href="Tourist_list.php">📍 দর্শনীয় স্থান</a>
    <a href="website_list.php">🌐 ওয়েবসাইট</a>
    <a href="to_let_list.php">🏘️ বাসা ভাড়া</a>
    <a href="todayfaridganj_list.php">📰 আজকের ফরিদগঞ্জ</a>
    <a href="video_list.php">▶️ ভিডিও দেখুন</a>
    <a href="socialorg_list.php">🤝 সামাজিক সংগঠন</a>
    <a href="blood_list.php">🩸 রক্ত</a>
    <a href="lawyer_list.php">⚖️ আইনজীবী</a>
    <a href="Wedding_list.php">💍 ওয়েডিং সার্ভিস</a>

    <a href="#">⚙️ অন্যান্য সেবা</a>

    <a class="logout" href="../sub_admin/sub_logout.php">Logout</a>

</div>

<!-- Main -->
<div class="main">
    <div class="header">Sub Admin Dashboard</div>

    <div class="grid">
        <div class="card">
            <h4>Doctors</h4>
            <span>1</span>
        </div>
        <div class="card">
            <h4>Bus</h4>
            <span>0</span>
        </div>
        <div class="card">
            <h4>Train</h4>
            <span>0</span>
        </div>
        <div class="card">
            <h4>Locations</h4>
            <span>0</span>
        </div>
        <div class="card">
            <h4>Blood</h4>
            <span>4</span>
        </div>
        <div class="card">
            <h4>Police</h4>
            <span>1</span>
        </div>
    </div>
</div>

</body>
</html>
