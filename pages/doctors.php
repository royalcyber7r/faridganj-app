<?php
include "../db.php";

$sql = "SELECT * FROM doctors ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if(!$result){
    die("Query Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>ডাক্তার তালিকা</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
}

.container{
    width:95%;
    margin:auto;
    margin-top:20px;
}

h2{
    margin-bottom:15px;
}

.doctor-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
    gap:15px;
}

.doctor-card{
    background:#fff;
    padding:15px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,.1);
}

/* IMAGE */
.doctor-card img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #eee;
    margin-bottom:10px;
}

.doctor-card h4{
    margin:6px 0;
    font-size:18px;
}

.doctor-card p{
    margin:4px 0;
    font-size:14px;

    /* 🔥 IMPORTANT FIX */
    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-all;
}

.doctor-card a{
    color:#0d6efd;
    text-decoration:none;
    font-size:14px;

    /* email / link fix */
    word-break: break-all;
}
</style>
</head>

<body>

<div class="container">
    <h2>👨‍⚕️ ডাক্তার তালিকা</h2>

    <div class="doctor-grid">

        <?php while($row = mysqli_fetch_assoc($result)) {

            if(!empty($row['photo']) && file_exists("../uploads/doctors/".$row['photo'])){
                $photo = "../uploads/doctors/".$row['photo'];
            }else{
                $photo = "../assets/default-doctor.png";
            }
        ?>

        <div class="doctor-card">

            <img src="<?php echo $photo; ?>" alt="Doctor Photo">

            <h4><?php echo htmlspecialchars($row['name']); ?></h4>

            <p><strong>ডিপার্টমেন্ট:</strong>
                <?php echo htmlspecialchars($row['department']); ?>
            </p>

            <p><strong>মোবাইল:</strong>
                <?php echo htmlspecialchars($row['phone']); ?>
            </p>

            <?php if(!empty($row['address'])){ ?>
                <p><strong>ঠিকানা:</strong><br>
                    <?php echo htmlspecialchars($row['address']); ?>
                </p>
            <?php } ?>

            <?php if(!empty($row['email'])){ ?>
                <p><strong>ইমেইল:</strong><br>
                    <?php echo htmlspecialchars($row['email']); ?>
                </p>
            <?php } ?>

            <?php if(!empty($row['facebook'])){ ?>
                <p>
                    <a href="<?php echo htmlspecialchars($row['facebook']); ?>" target="_blank">
                        🔗 Facebook Profile
                    </a>
                </p>
            <?php } ?>

        </div>

        <?php } ?>

    </div>
</div>

</body>
</html>
