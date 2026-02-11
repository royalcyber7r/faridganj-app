<?php
include "../db.php";

/* 🔍 Search handling */
$search = "";
if (!empty($_GET['q'])) {
    $search = trim($_GET['q']);
    $searchSafe = mysqli_real_escape_string($conn, $search);
    $sql = "SELECT * FROM videos 
            WHERE title LIKE '%$searchSafe%' 
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM videos ORDER BY id DESC";
}
$result = mysqli_query($conn, $sql);

function getYoutubeEmbedUrl($url){
    if (strpos($url, 'embed/') !== false) return $url;
    parse_str(parse_url($url, PHP_URL_QUERY), $params);
    if (isset($params['v'])) {
        return "https://www.youtube-nocookie.com/embed/".$params['v'];
    }
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Video List</title>

<style>
*{box-sizing:border-box}
body{
    margin:0;
    padding:25px;
    background:#0f1115;
    font-family:"Segoe UI",Arial,sans-serif;
    color:#fff;
}

/* HEADER */
.header{
    display:grid;
    grid-template-columns: 1fr auto 1fr;
    align-items:center;
    margin-bottom:25px;
}
.header-left{justify-self:start;}
.header-center{justify-self:center;}
.header-right{justify-self:end;}

h2{margin:0;font-weight:600}

/* SEARCH BAR */
.search-wrap{
    display:flex;
    align-items:center;
    gap:10px;
}

.search-form{
    display:flex;
    align-items:center;
    background:#181b20;
    border-radius:14px;
    overflow:hidden;
    width:420px;
}
.search-form input{
    flex:1;
    padding:12px 14px;
    border:none;
    outline:none;
    background:transparent;
    color:#fff;
    font-size:14px;
}
.search-form button{
    background:none;
    border:none;
    color:#ccc;
    cursor:pointer;
    padding:0 14px;
    font-size:18px;
}
.search-form button:hover{color:#fff}

/* MIC BUTTON */
.mic-btn{
    width:42px;
    height:42px;
    border-radius:50%;
    border:none;
    background:#181b20;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
}
.mic-btn:hover{background:#2a2e36}
.mic-btn svg{
    width:20px;
    height:20px;
    fill:#fff;
}

/* GRID */
.video-wrap{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
}

/* CARD */
.video-box{
    background:#181b20;
    padding:14px;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.45);
    transition:.3s;
}
.video-box:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 45px rgba(0,0,0,.7);
}
.video-box h4{
    margin:0 0 12px;
    font-size:15px;
}

/* VIDEO */
video, iframe{
    width:100%;
    height:200px;
    border-radius:10px;
    background:#000;
}

/* EMPTY */
.error{
    grid-column:1/-1;
    padding:40px;
    text-align:center;
    color:#ff5a5a;
}

/* RESPONSIVE */
@media(max-width:900px){
    .video-wrap{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:520px){
    .video-wrap{grid-template-columns:1fr}
    .search-form{width:100%}
}
</style>
</head>

<body>

<div class="header">
    <div class="header-left">
        <h2>🎬 Video List</h2>
    </div>

    <!-- ✅ SEARCH CENTER -->
    <div class="header-center">
        <div class="search-wrap">
            <form class="search-form" method="get">
                <input id="searchInput" type="text" name="q"
                       placeholder="Search video..."
                       value="<?= htmlspecialchars($search) ?>">
                <button type="submit">🔍</button>
            </form>

            <!-- 🎤 MIC -->
            <button class="mic-btn" onclick="startVoice()">
                <svg viewBox="0 0 24 24">
                    <path d="M12 14a3 3 0 0 0 3-3V5a3 3 0 0 0-6 0v6a3 3 0 0 0 3 3zm5-3a1 1 0 1 0-2 0 3 3 0 0 1-6 0 1 1 0 1 0-2 0 5 5 0 0 0 4 4.9V19H9a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-2v-3.1a5 5 0 0 0 4-4.9z"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="header-right"></div>
</div>

<div class="video-wrap">
<?php if(mysqli_num_rows($result) === 0){ ?>
    <div class="error">No video found</div>
<?php } ?>

<?php while($row = mysqli_fetch_assoc($result)){
    $title = htmlspecialchars($row['title']);
    $type  = strtolower($row['video_type']);
    $url   = trim($row['video_url']);
?>
<div class="video-box">
    <h4><?= $title ?></h4>

<?php if($type === 'mp4'){
    $videoPath = "../".ltrim($url,"/");
    if(file_exists($videoPath)){ ?>
        <video controls>
            <source src="<?= $videoPath ?>" type="video/mp4">
        </video>
<?php } else { ?>
        <div class="error">Video not found</div>
<?php } } else {
    $embed = getYoutubeEmbedUrl($url);
    if($embed){ ?>
        <iframe src="<?= htmlspecialchars($embed) ?>" allowfullscreen></iframe>
<?php } else { ?>
        <div class="error">Invalid YouTube link</div>
<?php } } ?>
</div>
<?php } ?>
</div>

<!-- 🎤 VOICE SEARCH -->
<script>
function startVoice(){
    if(!('webkitSpeechRecognition' in window)){
        alert("Voice search not supported");
        return;
    }
    const rec = new webkitSpeechRecognition();
    rec.lang = "en-US";
    rec.start();
    rec.onresult = e => {
        searchInput.value = e.results[0][0].transcript;
        document.querySelector(".search-form").submit();
    };
}
</script>


<script>
/* 🔄 Reload হলে search reset */
if (performance.navigation.type === 1) {
    const url = new URL(window.location.href);
    if (url.searchParams.has("q")) {
        window.location.href = url.pathname;
    }
}
</script>

</body>
</html>



