<?php
include 'config.php';  
session_start();
$id=$_SESSION['Admin-name'];
if(isset($_SESSION['Admin-login']) && $_SESSION['Admin-login']!=''){
   
}
else{
   header("location: login.php");
   die();
}
?>
<link rel="stylesheet" href="css/admin_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


<header class="header">

   <section class="flex">

      <!-- <a href="dashboard.php" class="logo">Admin<span>Panel</span></a> -->
      <img src="Image/10/vala-industries-logo-1.png" alt="Vala industries logo" class="logo">

      <nav class="navbar">
         <a href="dashboard.php">Home</a>
         <a href="product.php">Products</a>
         <a href="product_category.php">Product Category</a>
         <!-- <a href="#">Orders</a> -->
         <a href="admins_accounts.php">Admins</a>
         <a href="users_accounts.php">Users</a>
         <!-- <a href="#">Messages</a> -->
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <p>
            <?php
               echo $id;?>
         </p>
         <a href="update_profile_admin.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn" onclick="">logout</a> 
      </div>

   </section>

</header>