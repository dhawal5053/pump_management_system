<?php
include 'config.php';
include 'admin_header.php';

$id = $_GET['update'];
// update area
if(isset($_POST['update_area'])){
   $pincode=$_POST['pincode'];
   $area_name=$_POST['name'];
   $city=$_POST['city_id'];

   if(empty($pincode) || empty($area_name) || empty($city)){
      $warning_msg[] = 'Please fill out all';
   }
   else{
      $update = "UPDATE area SET pincode='$pincode', area_name='$area_name' , city_id='$city' WHERE area_id='$id' ";
      $upload = mysqli_query($conn,$update);
      if($upload){
         $success_msg[]= 'Area updated successfully';
      }else{
         $error_msg[] = 'Could not update the area';
      }
    }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update area</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">update area</h1>

   <?php
       $select = mysqli_query($conn,"SELECT * FROM area WHERE area_id=$id");
       $num = mysqli_num_rows($select);
       if($num>0){
       while($row = mysqli_fetch_assoc($select)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <span>Update pincode</span>
      <input type="text" name="pincode" required class="box" maxlength="100" placeholder="Enter pincode" value="<?php echo $row['pincode']; ?>">
      <span>Update Area name</span>
      <input type="text" class="box" required placeholder="Enter area name" name="name" value="<?php echo $row['area_name']; ?>">
      <div class="inputBox">
            <span>City</span>
            <select name="city_id" id="" class="box" required>
               <option value="">Select City</option>
               <?php
               $res=mysqli_query($conn,"select city_id,city_name from city order by city_name desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['city_id'].">".$row['city_name']."</option>";
                  }
               ?>
            </select>
         </div>
      <div class="flex-btn">
         <input type="submit" name="update_area" class="btn" value="update">
         <a href="area.php" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
       }
       }else{
         echo '<p class="empty">No area found!</p>';
      }
   ?>

</section>

<script src="admin_script.js"></script>

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>