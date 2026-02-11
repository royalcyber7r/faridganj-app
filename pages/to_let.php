<?php
include "../db.php";
$data = mysqli_query($conn, "SELECT * FROM to_let ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>বাসা ভাড়া</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:20px;
}
h2{margin-bottom:20px}

/* ===== GRID ===== */
.wrapper{
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap:20px;
}
@media (max-width:1024px){
    .wrapper{grid-template-columns:repeat(2,1fr);}
}
@media (max-width:600px){
    .wrapper{grid-template-columns:repeat(1,1fr);}
}

/* ===== CARD ===== */
.card{
    background:#fff;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
    overflow:hidden;
}

/* ===== SLIDER ===== */
.slider{
    position:relative;
    width:100%;
    height:220px;        /* 🔒 fixed height */
    background:#000;     /* 🖤 black background */
    overflow:hidden;
}

/* 🔥 IMAGE : STRETCH & FULL COVER */
.slider img{
    width:100%;
    height:100%;
   
    display:none;
}

.slider img.active{
    display:block;
}

/* ===== ARROWS ===== */
.slider button{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background:rgba(0,0,0,.6);
    color:#fff;
    border:none;
    padding:6px 10px;
    cursor:pointer;
    border-radius:4px;
    z-index:5;
}
.prev{left:10px}
.next{right:10px}

/* ===== INFO ===== */
.info{padding:15px}
.row{
    display:flex;
    justify-content:space-between;
    margin-bottom:8px;
    font-size:14px;
}

/* ===== BUTTONS ===== */
.btns{
    display:flex;
    gap:10px;
    margin-top:15px;
}
.btn{
    flex:1;
    background:#009688;
    color:#fff;
    text-align:center;
    padding:10px;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
}
.btn.disabled{
    background:#aaa;
    cursor:not-allowed;
}
</style>
</head>

<body>

<h2>🏠 বাসা ভাড়া</h2>

<div class="wrapper">

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<?php
$images = [];
$imgQ = mysqli_query(
    $conn,
    "SELECT image FROM to_let_images 
     WHERE to_let_id='{$row['id']}' LIMIT 5"
);
while($img = mysqli_fetch_assoc($imgQ)){
    if(file_exists("../uploads/".$img['image'])){
        $images[] = "../uploads/".$img['image'];
    }
}
if(!$images){
    $images[] = "../uploads/no-image.png";
}

$phone = trim($row['phone'] ?? '');
$map   = trim($row['google_map_link'] ?? '');
?>

<div class="card">

    <!-- SLIDER -->
    <div class="slider">
        <?php foreach($images as $k=>$img){ ?>
            <img src="<?= htmlspecialchars($img) ?>" class="<?= $k==0?'active':'' ?>">
        <?php } ?>

        <?php if(count($images) > 1){ ?>
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        <?php } ?>
    </div>

    <!-- INFO -->
    <div class="info">
        <div class="row"><b>বাসার ধরন</b><span><?= htmlspecialchars($row['house_type']) ?></span></div>
        <div class="row"><b>আয়তন</b><span><?= htmlspecialchars($row['area']) ?> বর্গফুট</span></div>
        <div class="row"><b>রুম</b><span><?= htmlspecialchars($row['rooms']) ?> টি</span></div>
        <div class="row"><b>বাথরুম</b><span><?= htmlspecialchars($row['washroom']) ?> টি</span></div>
        <div class="row"><b>ভাড়া</b><span><?= htmlspecialchars($row['rent']) ?> টাকা</span></div>
        <div class="row"><b>ঠিকানা</b><span><?= htmlspecialchars($row['address']) ?></span></div>

        <div class="btns">
            <?php if($map){ ?>
                <a class="btn" target="_blank" href="<?= htmlspecialchars($map) ?>">📍 গুগল ম্যাপ</a>
            <?php } else { ?>
                <a class="btn disabled" href="#">📍 গুগল ম্যাপ</a>
            <?php } ?>

            <?php if($phone){ ?>
                <a class="btn" href="tel:<?= htmlspecialchars($phone) ?>">📞 যোগাযোগ</a>
            <?php } else { ?>
                <a class="btn disabled" href="#">📞 যোগাযোগ</a>
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>

</div>

<script>
document.querySelectorAll('.slider').forEach(slider=>{
    let imgs = slider.querySelectorAll('img');
    let i = 0;

    const show = n =>{
        imgs.forEach(img=>img.classList.remove('active'));
        imgs[n].classList.add('active');
    };

    let next = slider.querySelector('.next');
    let prev = slider.querySelector('.prev');

    if(next){
        next.onclick = ()=>{ i = (i+1) % imgs.length; show(i); }
        prev.onclick = ()=>{ i = (i-1+imgs.length) % imgs.length; show(i); }
    }
});
</script>

</body>
</html>
