<?php
session_start();
require_once '../db.php';

$sql = "SELECT * FROM icons WHERE 1";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="bn">
<?php include "../includes/head.php"; ?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faridganj Upazila</title>

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/notice.css">
<link rel="stylesheet" href="../assets/css/footer.css">
<link rel="stylesheet" href="../css/uix-3d.css">
</head>

<body>

<!-- ================= TOP BAR ================= -->
<div class="top-bar">
    <div class="welcome">👋 Welcome, <?= $_SESSION['name'] ?? 'User' ?></div>

    <div class="user-menu" onclick="toggleUserMenu()">
        <img src="../uploads/users/<?= $_SESSION['photo'] ?? 'default.png' ?>" class="user-img">
        <div class="user-dropdown" id="userDropdown">
            <div class="user-info">
                <img src="../uploads/users/<?= $_SESSION['photo'] ?? 'default.png' ?>">
                <strong><?= $_SESSION['name'] ?? 'User' ?></strong>
            </div>
            <a href="profile_update.php">👤 প্রোফাইল আপডেট</a>
            <a href="../auth/logout.php">🚪 Logout</a>
        </div>
    </div>
</div>

<header class="header">WELLCOME TO FARIDGANJ UPAZILA</header>

<div class="search-box">
    <input type="text" id="searchInput" placeholder="সার্চ করুন..." onkeyup="searchIcons(event)">
    <button type="button">🔍</button>
</div>

<!-- ================= BANNER ================= -->
<div class="banner">
    <img id="bannerImg" src="../img/Banar-banar1.jpg" alt="Banner">
</div>

<!-- ================= NOTICE ================= -->
<div class="notice-bar">
    <div class="notice-inner">
        <span class="notice-label">নোটিশ</span>
        <div class="notice-marquee">
            <div class="notice-text">
                📢 ফরিদগঞ্জ উপজেলা অ্যাপসে আপনাকে স্বাগতম |
                📢 সেবা সংক্রান্ত তথ্যের জন্য যোগাযোগ করুন |
                📢 এডমিন +8801611018372
            </div>
        </div>
    </div>
</div>

<!-- ================= ICONS ================= -->
<div class="icon-container">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="icon-box" data-search="<?= strtolower($row['title'].' '.$row['keywords']); ?>">
        <a href="<?= $row['link']; ?>">
            <img src="../img/icons/<?= $row['image']; ?>">
            <p><?= $row['title']; ?></p>
        </a>
    </div>
<?php } ?>
</div>

<p id="noResult" style="display:none;text-align:center;color:#888;margin:20px;">
    😔 কিছু পাওয়া যায়নি
</p>

<?php include 'footer.php'; ?>

<!-- ================= CHAT WIDGET ================= -->
<style>
.chat-btn{
    position:fixed;
    right:20px;
    bottom:20px;
    background:#fff;
    color:#141925;
    padding:12px 18px;
    border-radius:30px;
    cursor:pointer;
    font-weight:bold;
    z-index:9999;
}
.chat-box{
    position:fixed;
    right:20px;
    bottom:80px;
    width:320px;
    height:420px;
    background:#fff;
    border-radius:10px;
    box-shadow:0 8px 25px rgba(0,0,0,.3);
    display:none;
    z-index:9999;
}
.chat-header{
    background:#111827;
    color:#fff;
    padding:12px;
    border-radius:10px 10px 0 0;
    font-weight:bold;
}
.chat-body{
    padding:10px;
    font-size:15px;
    color:black;
    font-style: italic;
}
.chat-footer{
    text-align:center;
    padding:10px;
}
.chat-footer button{
    background:#111827;
    color:#fff;
    padding:10px 15px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-weight:bold;
}
</style>

<div class="chat-btn" onclick="toggleChat()">💬 CHAT WITH US</div>

<div class="chat-box" id="chatBox">
    <div class="chat-header">
        WhatsApp Support
        <span style="float:right;cursor:pointer" onclick="toggleChat()">✖</span>
    </div>

    <div class="chat-body">
        Faridganj Upzilla Support Agent is live and ready to chat with you now.
        <br><br>
        আমরা এই মুহূর্তে অনলাইনে নেই WhatsApp এ মেসেজ পাঠান।
    </div>

    <div class="chat-footer">
        <button onclick="startWhatsAppChat()">Start WhatsApp Chat</button>
    </div>
</div>

<script>
function toggleChat(){
    const box = document.getElementById("chatBox");
    box.style.display = box.style.display === "block" ? "none" : "block";
}

function startWhatsAppChat(){
    const phone = "8801611018372";
    const message = encodeURIComponent("Hello, আমি Faridganj App থেকে যোগাযোগ করছি।");
    window.location.href = "https://wa.me/" + phone + "?text=" + message;
}
</script>

<!-- ================= BANNER SLIDER (5 IMAGES) ================= -->
<script>
const images = [
    "../img/Banar-banar1.jpg",
    "../img/Banar-banar2.jpg",
    "../img/Banar-banar3.jpg",
    "../img/Banar-banar4.jpg",
    "../img/Banar-banar5.jpg"
];

let index = 0;
const bannerImg = document.getElementById("bannerImg");

setInterval(() => {
    index = (index + 1) % images.length;
    bannerImg.style.opacity = 0;
    setTimeout(() => {
        bannerImg.src = images[index];
        bannerImg.style.opacity = 1;
    }, 300);
}, 3000);
</script>

<script>
function toggleUserMenu(){
    const menu = document.getElementById("userDropdown");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}
document.addEventListener("click", function(e){
    if(!e.target.closest(".user-menu")){
        document.getElementById("userDropdown").style.display = "none";
    }
});
</script>

</body>
</html>
