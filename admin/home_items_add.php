<?php
require_once "admin_guard.php";
require_once "../db.php";
?>

<div class="items-grid">

  <a href="ambulance_list.php" class="item-card">
    <img src="../img/icons/Ambulance.png">
    <p>অ্যাম্বুলেন্স</p>
  </a>

  

  <a href="diagnostic_list.php" class="item-card">
    <img src="../img/icons/diagnostic.jpeg">
    <p>ডায়গনস্টিক</p>
  </a>
  

  <a href="hospital_list.php" class="item-card">
    <img src="../img/icons/hospital.jpeg">
    <p>হাসপাতাল</p>
   </a>
    
  <a href="vehicle_list.php" class="item-card">
    <img src="../img/icons/micro_car.jpeg">
    <p>গাড়ি ভাড়া</p>
  </a>
  
  
  <a href="Courier_list.php" class="item-card">
    <img src="../img/icons/IMG_20251217_074313.jpg">
    <p>কুরিয়ার সার্ভিস</p>
  </a>
  
  
  <a href="police_list.php" class="item-card">
    <img src="../img/icons/pngtree-police-officer-3d-icon-isolated-on-a-white-background-representing-safety-png-image_15137926.png">
    <p>থানা পুলিশ</p>
  </a>
  
  <a href="poro_list.php" class="item-card">
    <img src="../img/icons/poro.jpg">
    <p>পৌর সেবা</p>
  </a>
  
  <a href="pbs_list.php" class="item-card">
    <img src="../img/icons/images.png">
    <p>বিদ্যুৎ অফিস</p>
  </a>
  
  <a href="worker_list.php" class="item-card">
    <img src="../img/icons/electrician.jpeg">
    <p>মিস্ত্রি</p>
  </a>
  
  <a href="emargency_list.php" class="item-card">
    <img src="../img/icons/images.jpg">
    <p>জরুরী সেবা</p>
  </a>
  
  <a href="job_list.php" class="item-card">
    <img src="../img/icons/jobs.jpeg">
    <p>চাকরি</p>
  </a>
  
  <a href="uddokta_list.php" class="item-card">
    <img src="../img/icons/uddokta.jpeg">
    <p>উদ্যোক্তা</p>
  </a>
  
  <a href="teacher_list.php" class="item-card">
    <img src="../img/icons/teacher.jpeg">
    <p>শিক্ষক</p>
  </a>
  
  <a href="hotel_list.php" class="item-card">
    <img src="../img/icons/hotel.jpeg">
    <p>হোটেল</p>
  </a>
   
  <a href="restaurant_list.php" class="item-card">
    <img src="../img/icons/1784942-200.png">
    <p>রেষ্টুরেন্ট</p>
  </a>
  
  <a href="flat_list.php" class="item-card">
    <img src="../img/icons/Flat.png">
    <p>ফ্ল্যাট ও জমি</p>
  </a>
  
  <a href="education_list.php" class="item-card">
    <img src="../img/icons/College.jpeg">
    <p>শিক্ষা প্রতিষ্ঠান</p>
  </a>
  
  
  <a href="graden_list.php" class="item-card">
    <img src="../img/icons/garden.jpeg">
    <p>নার্সারি</p>
  </a>
  
  
   <a href="doctor_list.php" class="item-card">
    <img src="../img/icons/doctor.jpeg">
    <p>ডাক্তার</p>
  </a>
  
  
  <a href="fireservice_list.php" class="item-card">
    <img src="../img/icons/fireservice.jpg">
    <p>ফায়ার সার্ভিস</p>
  </a>
  
  
   <a href="shopping_list.php" class="item-card">
    <img src="../img/icons/shopping.jpeg">
    <p>শপিং</p>
   </a>
  
  <a href="Tourist_list.php" class="item-card">
    <img src="../img/icons/Tourist attractiveness.png">
    <p>দর্শনীয় স্থান</p>
   </a>
  
  <a href="website_list.php" class="item-card">
    <img src="../img/icons/website.jpeg">
    <p>ওয়েবসাইট</p>
   </a>


  <a href="to_let_list.php" class="item-card">
    <img src="../img/icons/house-let-showing-rent-3d-260nw-480163498.webp">
    <p>বাসা ভাড়া</p>
   </a>
 
  
  
  <a href="todayfaridganj_list.php" class="item-card">
    <img src="../img/icons/website.jpeg">
    <p>আজকের ফরিদগঞ্জ</p>
   </a>
  
  
  <a href="video_list.php" class="item-card">
    <img src="../img/icons/play-video-graphic-icon-design-template-png_300932.jpg">
    <p>ভিডিও দেখুন</p>
   </a>
 
  
  
  <a href="socialorg_list.php" class="item-card">
    <img src="../img/icons/WhatsApp Image 2025-12-19 at 6.34.16 AM.jpeg">
    <p>সামাজিক সংগঠনন</p>
   </a>
  
  
  
  <a href="blood_list.php" class="item-card">
    <img src="../img/icons/blood.jpeg">
    <p>রক্ত</p>
   </a>
  
  
  
  <a href="lawyer_list.php" class="item-card">
    <img src="../img/icons/lawyer.png">
    <p>আইনজীবী</p>
   </a>
  
  <a href="Wedding_list.php" class="item-card">
    <img src="../img/icons/Wedding.jpg">
    <p>ওয়েডিং সার্ভিস</p>
  </a>
  
  <a href="other_list.php" class="item-card">
    <img src="../img/icons/অন্যান্য সেবা.png">
    <p>অন্যান্য সেবা</p>
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