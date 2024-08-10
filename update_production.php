<?php
include 'config.php';
include 'admin_header.php';

$id = $_GET['update'];
// to update production
if(isset($_POST['update_production'])){
    $stdate = $_POST['stdate'];
      $edate = $_POST['edate'];
      $product_id = $_POST['product_id'];
      $rawmaterial_id= $_POST['raw_materials'];
      $qty = $_POST['qty'];
      if(empty($stdate) || empty($edate) || empty($product_id) || empty($rawmaterial_id) || empty($qty)){
         $warning_msg[] = 'Please fill out all';
      }
    // else{
    //     $query= mysqli_query($conn,"SELECT * FROM production_details WHERE production_production_id='$id'");
    //     $fire=mysqli_fetch_assoc($query);
    //     $fire1=$fire['QTY'];
    //     mysqli_query($conn,"UPDATE product SET QOH=QOH-$fire1 WHERE product_id='$product_id'");
    //     foreach($rawmaterial_id as $rawmaterial_id){
    //     mysqli_query($conn,"UPDATE rawmaterial_details SET QTY=QTY+$fire1*1 WHERE rawmaterial_rawmaterial_id='$rawmaterial_id'");
    //     }
        $update = "UPDATE production SET start_date='$stdate', end_date='$edate', product_id='$product_id' WHERE production_id='$id'";
        $upload = mysqli_query($conn,$update);
        foreach($rawmaterial_id as $rawmaterial_id){
        $update1 = "UPDATE production_details SET QTY='$qty', rawmaterial_rawmaterial_id='$rawmaterial_id' WHERE production_production_id='$id'";
        $upload1 = mysqli_query($conn,$update1);
        mysqli_query($conn,"UPDATE rawmaterial_details SET QTY=QTY-$qty*1 WHERE rawmaterial_rawmaterial_id='$rawmaterial_id'");
        }
        mysqli_query($conn,"UPDATE product SET QOH=QOH+'$qty' WHERE product_id='$product_id'");
        if($upload==true and $upload1==true){
           $success_msg[] = 'Production datail updated successfully';
        }
        else{
           $error_msg[] = 'Could not update the production detail';
        }
     }
//   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update production</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">update production</h1>

   <?php
        $select = mysqli_query($conn,"SELECT prd.*,pr.* FROM production pr,production_details prd WHERE prd.production_production_id=$id AND pr.production_id=$id ORDER BY rawmaterial_rawmaterial_id ASC LIMIT 1");
        $num = mysqli_num_rows($select);
       if($num>0){
       while($row = mysqli_fetch_assoc($select)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
   <div class="flex">
       <div class="inputBox">
            <span>Start date</span>
            <input type="date" class="box" placeholder="Select start date" name="stdate" required value="<?php echo $row['start_date']; ?>">
         </div>
         <div class="inputBox">
            <span>End date</span>
            <input type="date" class="box" placeholder="Select end date" name="edate" required value="<?php echo $row['end_date']; ?>">
         </div>
         <div class="inputBox">
            <span>Enter Quantity</span>
            <input type="number" class="box" required maxlength="15" placeholder="Enter QTY" name="qty" min="1" value="<?php echo $row['QTY']; ?>">
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
            <span>Rawmaterial used</span><br/>
            <?php
                $res=mysqli_query($conn,"select rawmaterial_id,rawmaterial_name from rawmaterial order by rawmaterial_name desc");
                while($row=mysqli_fetch_assoc($res)){
                  echo '<label style="font-size: 20px;"><input type="checkbox" name="raw_materials[]" value=" ' . $row["rawmaterial_id"] . ' ">' . $row["rawmaterial_name"].'</label>';
             }
            ?>      
         </div>
      </div>   
   <div class="flex-btn">
         <input type="submit" name="update_production" class="btn" value="update">
         <a href="production.php" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
       }
       }else{
         echo '<p class="empty">No production found!</p>';
      }
   ?>

</section>

<script src="admin_script.js"></script>
   
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>