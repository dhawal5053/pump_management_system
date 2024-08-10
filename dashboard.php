<?php
include 'config.php';
include 'admin_header.php';

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Dashboard</title>
      
      
      <link rel="stylesheet" href="css/admin_style.css">
      
   </head>
   <body>
      
    
      
      <section class="dashboard">
         
         <h1 class="heading">Dashboard</h1>
         
         <div class="box-container">
            
      <div class="box">
               <h3>WELCOME!</h3>
               <p><?php
               echo $id;
               ?></p>
               <a href="update_profile_admin.php" class="btn">Update profile</a>
      </div>

      <div class="box">
         <?php
            $select_area =mysqli_query($conn,"SELECT * FROM area");
            $num = mysqli_num_rows($select_area);   
         ?>
         <h3><?php echo $num; ?></h3>
         <p>Area added</p>
         <a href="area.php" class="btn">See area</a>
      </div>
            
      <div class="box">
         <?php
            $select_supplier =mysqli_query($conn,"SELECT * FROM supplier");
            $num = mysqli_num_rows($select_supplier);   
         ?>
         <h3><?php echo $num; ?></h3>
         <p>Supplier added</p>
         <a href="supplier.php" class="btn">See supplier</a>
      </div>

      <div class="box">
         <?php
            $select_rawmaterial =mysqli_query($conn,"SELECT * FROM rawmaterial");
            $num = mysqli_num_rows($select_rawmaterial);   
         ?>
         <h3><?php echo $num; ?></h3>
         <p>Rawmaterial added</p>
         <a href="rawmaterial.php" class="btn">See Rawmaterial</a>
      </div>
      <div class="box">
         <?php
            $total_purchase=0;
            $select_purchase =mysqli_query($conn,"SELECT * FROM purchase");
            $num = mysqli_num_rows($select_purchase); 
            if($num > 0){
               while($fetch_purchase=mysqli_fetch_assoc($select_purchase)){
                  $total_purchase += $fetch_purchase['total_amt'];
               }
            }  
         ?>
         <h3><span>₹</span><?= $total_purchase; ?><span>/-</span></h3>
         <p>Purchase detail added</p>
         <a href="purchase.php" class="btn">See Purchase</a>
      </div>

      <div class="box">
         <?php
            $total_purchase_return=0;
            $select_purchase_return=mysqli_query($conn,"SELECT * FROM purchase_return");
            $num = mysqli_num_rows($select_purchase_return); 
            if($num > 0){
               while($fetch_purchase_return=mysqli_fetch_assoc($select_purchase_return)){
                  $total_purchase_return += $fetch_purchase_return['return_amt'];
               }
            }  
         ?>
         <h3><span>₹</span><?= $total_purchase_return; ?><span>/-</span></h3>
         <p>Purchase return added</p>
         <a href="purchase_return.php" class="btn">See Purchase Return </a>
      </div>

      <div class="box">
         <?php
            $total_sales=0;
            $select_sales=mysqli_query($conn,"SELECT * FROM sales WHERE Is_cancel=0");
            $num = mysqli_num_rows($select_sales); 
            if($num > 0){
               while($fetch_sales=mysqli_fetch_assoc($select_sales)){
                  $total_sales += $fetch_sales['total_amt'];
               }
            }  
         ?>
         <h3><span>₹</span><?= $total_sales; ?><span>/-</span></h3>
         <p>Sales added</p>
         <a href="sales.php" class="btn">See sales</a>
      </div>

      <div class="box">
         <?php
            $select_production =mysqli_query($conn,"SELECT * FROM production");
            $num = mysqli_num_rows($select_production);   
         ?>
         <h3><?php echo $num; ?></h3>
         <p>Production detail added</p>
         <a href="production.php" class="btn">See production</a>
      </div>
            <!-- <div class="box">
            <?php
               
            ?>
          <h3><span>$</span><//?= $total_pendings; ?><span>/-</span></h3> 
         <p>Total pendings</p>
         <a href="#" class="btn">See orders</a>
      </div> -->

      <!-- <div class="box">
         <?php
            
         ?>
         <h3><span>$</span><//?= $total_completes; ?><span>/-</span></h3> 
         <p>Completed orders</p>
         <a href="#" class="btn">See orders</a>
      </div>
      
      <div class="box">
         <?php
         ?>
          <h3><//?= $number_of_orders; ?></h3> 
         <p>Orders placed</p>
         <a href="#" class="btn">See orders</a>
      </div> -->
      
      <div class="box">
         <?php
          $select_admin_user=mysqli_query($conn,"SELECT * FROM user WHERE Is_Admin!=0");
          $num = mysqli_num_rows($select_admin_user);
         ?>
         <h3><?php echo $num; ?></h3>
         <p>Admin users</p>
         <a href="admins_accounts.php" class="btn">See admins</a>
      </div>
      <div class="box">
         <?php
            $select_user=mysqli_query($conn,"SELECT * FROM user WHERE Is_Admin=0");
            $num = mysqli_num_rows($select_user);
         ?>
         <h3><?php echo $num; ?></h3>
         <p>Normal users</p>
         <a href="users_accounts.php" class="btn">See users</a>
      </div>
      <div class="box">
         <?php
            $select_product_category =mysqli_query($conn,"SELECT * FROM product_category");
            $num = mysqli_num_rows($select_product_category);   
         ?>
         <h3><?php echo $num; ?></h3>
         <p>Product Category added</p>
         <a href="product_category.php" class="btn">See product category</a>
      </div>

      <div class="box">
      <?php
            $select_product=mysqli_query($conn,"SELECT * FROM product");
            $num = mysqli_num_rows($select_product);   
      ?>
         <h3><?php echo $num; ?></h3>
         <p>Products added</p>
         <a href="product.php" class="btn">See products</a>
      </div>
      

      
      <div class="box">
          <h3><?php echo 'REPORTS'; ?></h3> 
         <p>Generate report</p>
         <a href="report.php" class="btn">Reports</a>
      </div>
      
   </div>
   
</section>
<script src="admin_script.js"></script> 
</body>
</html>