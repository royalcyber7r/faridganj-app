<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
?>
<div class="items-grid">

  <a href="school_list.php" class="item-card">
    <img src="../img/icons/school.png">
    <p>স্কুল</p>
  </a>

  

  <a href="college_list.php" class="item-card">
    <img src="../img/icons/college2.png">
    <p>কলেজ</p>
  </a>
  
  <a href="madrasha_list.php" class="item-card">
    <img src="../img/icons/madrasaha.png">
    <p>মাদ্রাসা</p>
  </a>
  
  <a href="cosingcenter_list.php" class="item-card">
    <img src="../img/icons/coachingcenter.png">
    <p>কোচিং সেন্টার</p>
  </a>
  
  
  <a href="research_list.php" class="item-card">
    <img src="../img/icons/resourch.png">
    <p>প্রশিক্ষণ কেন্দ্র</p>
  </a>
  
  
  
  
 


<style>
.items-grid{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    padding: 20px;
}

.item-card{
    background: #ffffff;
    border-radius: 12px;
    padding: 25px 15px;
    text-align: center;
    text-decoration: none;
    color: #333;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.item-card:hover{
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.15);
}

.item-card img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #ddd;
    margin-bottom:10px;
}


.item-card p{
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}



</style>