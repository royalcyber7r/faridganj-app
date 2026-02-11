<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

$result = mysqli_query($conn, "SELECT * FROM videos ORDER BY id DESC");
if(!$result){
    die("Query Failed");
}

// 🔹 Helper: YouTube embed generator
function getYoutubeEmbedUrl($url){
    // Already embed
    if(strpos($url, 'embed/') !== false){
        return str_replace("youtube.com", "youtube-nocookie.com", $url);
    }

    // watch?v=xxxx
    parse_str(parse_url($url, PHP_URL_QUERY), $params);

    if(isset($params['v'])){
        return "https://www.youtube-nocookie.com/embed/".$params['v'];
    }

    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> Video List Admin </title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    padding:20px;
}

h2{
    margin-bottom:10px;
}

.add-btn{
    display:inline-block;
    margin-bottom:15px;
    text-decoration:none;
    font-size:16px;
    color:#007bff;
}

table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
}

th, td{
    border:1px solid #ccc;
    padding:10px;
    vertical-align:top;
}

th{
    background:#f0f0f0;
}

video, iframe{
    max-width:100%;
    border-radius:4px;
}

.action a{
    margin-right:8px;
    text-decoration:none;
    color:#007bff;
}

.error{
    color:#c00;
    font-size:14px;
}
</style>
</head>

<body>

<h2>Video List Admin</h2>

<a href="video_add.php" class="add-btn">➕ Add Video</a>

<table>
<tr>
    <th width="5%">ID</th>
    <th width="20%">Title</th>
    <th width="55%">Video</th>
    <th width="20%">Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ 

    $id    = $row['id'];
    $title = htmlspecialchars($row['title']);
    $type  = strtolower($row['video_type']);
    $url   = trim($row['video_url']);
?>

<tr>
    <td><?= $id; ?></td>

    <td><?= $title; ?></td>

    <td>
<?php if($type === "mp4"){ 

    $path = "../" . ltrim($url, "/");

    if(file_exists($path)){
?>
        <video width="320" controls>
            <source src="<?= $path; ?>" type="video/mp4">
        </video>
<?php } else { ?>
        <div class="error">❌ Video file not found</div>
<?php } ?>

<?php } else {

    $embed = getYoutubeEmbedUrl($url);

    if($embed){
?>
        <iframe
            width="320"
            height="180"
            src="<?= htmlspecialchars($embed); ?>"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
<?php } else { ?>
        <div class="error">❌ Invalid YouTube link</div>
<?php } ?>

<?php } ?>
    </td>

    <td class="action">
        <a href="video_edit.php?id=<?= $id; ?>">Edit</a> |
        <a href="video_delete.php?id=<?= $id; ?>"
           onclick="return confirm('Delete this video?')">
           Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>
