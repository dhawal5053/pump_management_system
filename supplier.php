<?php
include 'admin_header.php';

include 'config.php';
   // to add the supplier
   if(isset($_POST['add_supplier'])){
      $supplier_name = $_POST['name'];
      $number = $_POST['number'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $gst = $_POST['gst'];
      $area_id = $_POST['area_id'];

      if(empty($supplier_name) || empty($number) || empty($email) || empty($address) || empty($gst) || empty($area_id)){
         $warning_msg[] = 'Please fill out all';
      }
      else{
         // Check if the same supplier already exists
         $check_supplier = mysqli_query($conn, "SELECT * FROM supplier WHERE email = '$email' OR contact_no = '$number' OR GSTIN_no = '$gst'");
         $num_rows = mysqli_num_rows($check_supplier);
         if($num_rows > 0){
            $warning_msg[] = 'Supplier already exist';
         }
         else{
            // Insert new supplier
            $insert = "INSERT INTO supplier(supplier_name,contact_no,email,address,GSTIN_no,area_id)VALUES('$supplier_name','$number','$email','$address','$gst','$area_id')";
            $upload = mysqli_query($conn, $insert);
            if($upload){
               $success_msg[] = 'New supplier added successfully';
            }
            else{
               $error_msg[] = 'Could not add the supplier';
            }
         }
      }
   }

// code to delete the supplier
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   $check1=mysqli_query($conn,"SELECT * FROM rawmaterial_details WHERE supplier_supplier_id='$id'");
   $fetch1=mysqli_fetch_assoc($check1);
   $num1=mysqli_num_rows($check1);
   $check2=mysqli_query($conn,"SELECT * FROM purchase WHERE supplier_id='$id'");
   $fetch2=mysqli_fetch_assoc($check2);
   $num2=mysqli_num_rows($check2);
   if($num1>0){
     if($id==$fetch1['supplier_supplier_id']){
      $error_msg[] = 'This supplier can not be deleted';
   }
}
   elseif($num2>0){
   if($id==$fetch2['supplier_id']){
      $error_msg[] = 'This supplier can not be deleted';
   }
}
   else{
      mysqli_query($conn,"DELETE FROM supplier WHERE supplier_id = $id");
      header('location:supplier.php');
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Supplier</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">add supplier</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
      <div class="inputBox">
            <span>Supplier name</span>
            <input type="text" class="box" required maxlength="30" placeholder="Enter supplier name" name="name">
         </div>
         <div class="inputBox">
            <span>Contact number</span>
            <input type="tel" class="box" required  required pattern="[0-9]{5}[0-9]{5}" placeholder="Enter contact number" name="number">
         </div>
         <div class="inputBox">
            <span>Email</span>
            <input type="email" class="box" required maxlength="30" placeholder="Enter email" name="email">
         </div>
         <div class="inputBox">
            <span>Address</span>
            <textarea class="box" required maxlength="100" placeholder="Enter address" name="address"></textarea>
         </div>
         <div class="inputBox">
            <span>GST number</span>
            <input type="text" class="box" required maxlength="15" placeholder="Enter GST number" required pattern="[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}" oninvalid="this.setCustomValidity('Please enter valid GST number.')" name="gst">
         </div>
         <div class="inputBox">
            <span>Area</span>
            <select name="area_id" id="" class="box" required>
               <option value="">Select Area</option>
               <?php
               $res=mysqli_query($conn,"select area_id,area_name from area order by area_name desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['area_id'].">".$row['area_name']."</option>";
                  }
               ?>
            </select>
         </div>
      
      </div>
      
      <input type="submit" value="add supplier" class="btn" name="add_supplier">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">Supplier</h1>
   <div class="product-display">

<?php
   $select = mysqli_query($conn,"SELECT s.*,a.area_name AS aname FROM supplier s,area a WHERE a.area_id=s.area_id");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>Supplier name</th>
            <th>contact_no</th>
            <th>Email</th>
            <th>Address</th>
            <th>GSTIN_no</th>
            <th>Area</th>
            <th>Action</th>
         </tr>
      </thead>
      <?php
         $num = mysqli_num_rows($select);
         if($num>0){
         while($row = mysqli_fetch_assoc($select)){
      ?>
         <tr>
            <td><?php echo $row['supplier_name']; ?></td>
            <td><?php echo $row['contact_no']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['GSTIN_no']; ?></td>
            <td><?php echo $row['aname']; ?></td>
            <td>
               <a href="update_supplier.php?update=<?php echo $row['supplier_id']; ?>" class="option-btn">update</a>
               <a href="supplier.php?delete=<?php echo $row['supplier_id']; ?>" class="delete-btn" onclick="return confirm('Delete this supplier?');">delete</a>
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

<script src="admin_script.js"></script>
   
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>