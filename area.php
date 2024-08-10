<?php
include 'admin_header.php';

include 'config.php';
   // to add the area
   if(isset($_POST['add_area'])){
      $pincode = $_POST['pin'];
      $area_name = $_POST['area_name'];
      $city_id = $_POST['city_id'];
      // Check if area_id or area_name or city_id is empty
      if(empty($pincode) || empty($area_name) || empty($city_id)){
         $info_msg[] = 'Please fill out all';
      }
      else{
         // Check if the same area already exists
         $check_area = mysqli_query($conn, "SELECT * FROM area WHERE pincode = '$pincode'");
         $num_rows = mysqli_num_rows($check_area);
         if($num_rows > 0){
            $error_msg[] = 'Area already exist';
         }
         else{
            // Insert new area
            $insert = "INSERT INTO area(pincode,area_name,city_id)VALUES('$pincode','$area_name','$city_id')";
            $upload = mysqli_query($conn, $insert);
            if($upload){
               $success_msg[] = 'New area added successfully';
            }
            else{
               $warning_msg[] = 'Could not add the area';
            }
         }
      }
   }

   // code to delete the area
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   $check1=mysqli_query($conn,"SELECT * FROM supplier WHERE area_id='$id'");
   $fetch1=mysqli_fetch_assoc($check1);
   $num1=mysqli_num_rows($check1);
   $check2=mysqli_query($conn,"SELECT * FROM user WHERE area_id='$id'");
   $fetch2=mysqli_fetch_assoc($check2);
   $num2=mysqli_num_rows($check2);
   if($num1>0){
     if($id==$fetch1['area_id']){
      $message[] = 'This area can not be deleted';
   }
}
elseif($num2>0){
if($id==$fetch2['area_id']){
      $message[] = 'This area can not be deleted';
   }
}
   else{
      mysqli_query($conn,"DELETE FROM area WHERE area_id = $id");
      header('location:area.php');
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Area</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}
?>


<section class="add-products">

   <h1 class="heading">add area</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
      <div class="inputBox">
            <span>Area Pincode</span>
            <input type="text" class="box" required minlength="6" maxlength="6" pattern="[0-9]{6}" placeholder="Enter pincode of area" name="pin" oninvalid="this.setCustomValidity('Pincode must be of 6 Digit.')">
         </div>
         <div class="inputBox">
            <span>Area Name</span>
            <input type="text" class="box" required  maxlength="30" placeholder="Enter area name" name="area_name">
         </div>
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
      
      </div>
      
      <input type="submit" value="add area" class="btn" name="add_area">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">Area added</h1>
   <div class="product-display">

<?php
   $select = mysqli_query($conn,"SELECT a.*,c.city_name AS cname FROM area a,city c WHERE c.city_id=a.city_id");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>Area pincode</th>
            <th>Area name</th>
            <th>City name</th>
            <th>Action</th>
         </tr>
      </thead>
      <?php
         $num = mysqli_num_rows($select);
         if($num>0){
         while($row = mysqli_fetch_assoc($select)){
      ?>
         <tr>
            <td><?php echo $row['pincode']; ?></td>
            <td><?php echo $row['area_name']; ?></td>
            <td><?php echo $row['cname']; ?></td>
            <td>
               <a href="update_area.php?update=<?php echo $row['area_id']; ?>" class="option-btn">update</a>
               <a href="area.php?delete=<?php echo $row['area_id']; ?>" class="delete-btn" onclick="return confirm('Delete this area?');">delete</a>
               </td>
               </tr>
      <?php
         }
      }else{
         echo '<p class="empty">no area added yet!</p>';
      }
      ?>      
         </table>
         </div>

</section>






<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

<script src="admin_script.js"></script>
   
</body>
</html>