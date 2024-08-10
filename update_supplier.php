<?php
include 'config.php';
include 'admin_header.php';

$id = $_GET['update'];
// update supplier
if(isset($_POST['update_supplier'])){
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
        $update = "UPDATE supplier SET supplier_name='$supplier_name', contact_no='$number' , email='$email' , address='$address' , GSTIN_no='$gst' , area_id='$area_id' WHERE supplier_id='$id' ";
        $upload = mysqli_query($conn,$update);
          if($upload){
             $success_msg[] = 'supplier updated successfully';
          }
          else{
             $error_msg[] = 'Could not update the supplier';
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
   <title>Update supplier</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">update supplier</h1>

   <?php
       $select = mysqli_query($conn,"SELECT * FROM supplier WHERE supplier_id=$id");
       $num = mysqli_num_rows($select);
       if($num>0){
       while($row = mysqli_fetch_assoc($select)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
   <div class="flex">
   <div class="inputBox">
            <span>Update Supplier name</span>
            <input type="text" class="box" required maxlength="30" placeholder="Enter supplier name" name="name" value="<?php echo $row['supplier_name']; ?>">
         </div>
         <div class="inputBox">
            <span> Update Contact number</span>
            <input type="tel" class="box" required  required pattern="[0-9]{5}[0-9]{5}" placeholder="Enter contact number" name="number" value="<?php echo $row['contact_no']; ?>">
         </div>
         <div class="inputBox">
            <span>Update Email</span>
            <input type="email" class="box" required maxlength="30" placeholder="Enter email" name="email" value="<?php echo $row['email']; ?>">
         </div>
         <div class="inputBox">
            <span>Update Address</span>
            <textarea class="box" required maxlength="100" placeholder="Enter address" name="address"><?php echo $row['address']; ?></textarea>
         </div>
         <div class="inputBox">
            <span>Update GST number</span>
            <input type="text" class="box" required maxlength="15" placeholder="Enter GST number" required pattern="[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}" oninvalid="this.setCustomValidity('Please enter valid GST number.')" name="gst" value="<?php echo $row['GSTIN_no']; ?>">
         </div>
         <div class="inputBox">
            <span>Update Area</span>
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
      <div class="flex-btn">
         <input type="submit" name="update_supplier" class="btn" value="update">
         <a href="supplier.php" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
       }
       }else{
         echo '<p class="empty">No supplier found!</p>';
      }
   ?>

</section>

<script src="admin_script.js"></script>
   
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>