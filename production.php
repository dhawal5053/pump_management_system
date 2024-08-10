<?php
include 'admin_header.php';

include 'config.php';
   // to add the production detail
   if(isset($_POST['add_production'])){
      $stdate = $_POST['stdate'];
      $edate = $_POST['edate'];
      $product_id = $_POST['product_id'];
      $rawmaterial_id= $_POST['raw_materials'];
      $qty = $_POST['qty'];
      if(empty($stdate) || empty($edate) || empty($product_id) || empty($rawmaterial_id) || empty($qty)){
         $warning_msg[] = 'Please fill out all';
      }
      else{
         if($edate < $stdate){
            $error_msg[] = 'Please enter valid end date';
         }
         else{
            // Insert new production detail
            $insert = "INSERT INTO production(start_date,end_date,product_id)VALUES('$stdate','$edate','$product_id')";
            $upload = mysqli_query($conn, $insert);
            $check1=mysqli_query($conn,"SELECT * FROM production WHERE production_id NOT IN (SELECT production_production_id FROM production_details)");
            $fetch1=mysqli_fetch_assoc($check1);
            $pid=$fetch1['production_id'];
            foreach($rawmaterial_id as $rawmaterial_id){
            $query = "INSERT INTO production_details(production_production_id,rawmaterial_rawmaterial_id,QTY)VALUES('$pid','$rawmaterial_id','$qty')";
            $fire = mysqli_query($conn,$query);
            mysqli_query($conn,"UPDATE rawmaterial_details SET QTY=QTY-$qty*1 WHERE rawmaterial_rawmaterial_id='$rawmaterial_id'");
         }
            mysqli_query($conn,"UPDATE product SET QOH=QOH+'$qty' WHERE product_id='$product_id'");
            if($upload==true and $fire==true){
              $success_msg[] = 'New production detail added successfully';
            }
         
            else{
               $error_msg[] = 'Could not add the production detail';
            }
         }
      }
   }

// code to delete the production detail
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn,"DELETE FROM production_details WHERE production_production_id = $id");
   mysqli_query($conn,"DELETE FROM production WHERE production_id = $id");
   header('location:production.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>production</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">add production detail</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
       <div class="inputBox">
            <span>Start date</span>
            <input type="date" class="box" placeholder="Select start date" name="stdate" required>
         </div>
         <div class="inputBox">
            <span>End date</span>
            <input type="date" class="box" placeholder="Select end date" name="edate" required>
         </div>
         <div class="inputBox">
            <span>Product</span>
            <select name="product_id" id="" class="box" required>
               <option value="">Select product</option>
               <?php
               $res=mysqli_query($conn,"select product_id,product_name from product order by product_name desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['product_id'].">".$row['product_name']."</option>";
                  }
               ?>
            </select>
         </div>
         <div class="inputBox">
            <span>Enter Quantity</span>
            <input type="number" class="box" required maxlength="15" placeholder="Enter QTY" name="qty" min="1">
         </div>
         <div class="inputBox">
            <span>Rawmaterial used</span><br/>
            <?php
                $res=mysqli_query($conn,"select rawmaterial_id,rawmaterial_name from rawmaterial order by rawmaterial_name desc");
                while($row=mysqli_fetch_assoc($res)){
                  echo '<label style="font-size: 20px;"><input type="checkbox" name="raw_materials[]" value=" ' . $row["rawmaterial_id"] . ' ">' . $row["rawmaterial_name"].'</label>';
                  // echo '<input type="number"  class="box" required maxlength="15" placeholder="Enter QTY" name="qty" min="1">';
               }
            ?>      
         </div>
      </div>
      
      <input type="submit" value="add production details" class="btn" name="add_production">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">Production</h1>
   <div class="product-display">

<?php
   $select = mysqli_query($conn,"SELECT DISTINCT prd.QTY,prd.production_production_id,pr.*,p.* FROM production pr,production_details prd,product p WHERE prd.production_production_id=pr.production_id AND pr.product_id=p.product_id ORDER BY production_id DESC");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>Start date</th>
            <th>End date</th>
            <th>Product name</th>
            <th>QTY</th>
            <th>Action</th>
         </tr>
      </thead>
      <?php
         $num = mysqli_num_rows($select);
         if($num>0){
         while($row = mysqli_fetch_assoc($select)){
      ?>
         <tr>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['QTY']; ?></td>
            <td>
               <!-- <a href="update_production.php?update=<?php echo $row['production_id']; ?>" class="option-btn">update</a> -->
               <a href="production.php?delete=<?php echo $row['production_id'];  ?>" class="delete-btn" onclick="return confirm('Delete this production detail?');">delete</a>
               </td>
               </tr>
            <?php
         }
      }else{
         echo '<p class="empty">No production detail available!</p>';
      }
   ?>

   </div>

</section>

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

<script src="admin_script.js"></script>
   
</body>
</html>