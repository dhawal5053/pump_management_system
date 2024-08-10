<?php
include 'admin_header.php';

include 'config.php';
   // to add the rawmaterial
   if(isset($_POST['add_rawmaterial'])){
      $rawmaterial_name = $_POST['rawmaterial'];
      $qty = $_POST['qty'];
      $supplier_id = $_POST['supplier_id'];

      if(empty($qty) || empty($supplier_id) || empty($rawmaterial_name)){
         $warning_msg[] = 'Please fill out all';
      }
      else{
         // Check if the same rawmaterial already exists
         $check_rawmaterial = mysqli_query($conn, "SELECT * FROM rawmaterial WHERE rawmaterial_name = '$rawmaterial_name'");
         $num_rows = mysqli_num_rows($check_rawmaterial);
         if($num_rows > 0){
            $info_msg[] = 'Rawmaterial already exist';
         }
      else{
            // Insert new rawmaterial
            $insert= "INSERT INTO rawmaterial(rawmaterial_name)VALUES('$rawmaterial_name')";
            $upload = mysqli_query($conn,$insert);
            $check1=mysqli_query($conn,"SELECT * FROM rawmaterial WHERE rawmaterial_id NOT IN (SELECT rawmaterial_rawmaterial_id FROM rawmaterial_details)");
            $fetch1=mysqli_fetch_assoc($check1);
            $rid=$fetch1['rawmaterial_id'];
            $query = "INSERT INTO rawmaterial_details(rawmaterial_rawmaterial_id,supplier_supplier_id,QTY)VALUES('$rid','$supplier_id','$qty')";
            $fire = mysqli_query($conn,$query);
            if($upload==true and $fire==true){
               $success_msg[] = 'New rawmaterial added successfully';
            }
            else{
               $error_msg[] = 'Could not add the rawmaterial';
            }
      }
   }
}
// code to delete the rawmaterial
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   $check1=mysqli_query($conn,"SELECT * FROM purchase_details WHERE rawmaterial_rawmaterial_id='$id'");
   $fetch1=mysqli_fetch_assoc($check1);
   $num1=mysqli_num_rows($check1);
   $check2=mysqli_query($conn,"SELECT * FROM purchase_return_details WHERE rawmaterial_rawmaterial_id='$id'");
   $fetch2=mysqli_fetch_assoc($check2);
   $num2=mysqli_num_rows($check2);
   $check3=mysqli_query($conn,"SELECT * FROM production_details WHERE rawmaterial_rawmaterial_id='$id'");
   $fetch3=mysqli_fetch_assoc($check3);
   $num3=mysqli_num_rows($check3);
   if($num1>0){
     if($id==$fetch1['rawmaterial_rawmaterial_id']){
      $error_msg[] = 'This rawmaterial can not be deleted';
   }
}
elseif($num2>0){
if($id==$fetch2['rawmaterial_rawmaterial_id']){
      $error_msg[] = 'This rawmaterial can not be deleted';
   }
}
elseif($num3>0){
   if($id==$fetch2['rawmaterial_rawmaterial_id']){
         $error_msg[] = 'This rawmaterial can not be deleted';
      }
   }
   else{
      mysqli_query($conn,"DELETE FROM rawmaterial_details WHERE rawmaterial_rawmaterial_id = $id");
      mysqli_query($conn,"DELETE FROM rawmaterial WHERE rawmaterial_id = $id");
      header('location:rawmaterial.php');
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Raw material</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">add rawmaterial</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
      <div class="inputBox">
            <span>Rawmaterial</span>
            <input type="text" class="box" required maxlength="30" placeholder="Enter rawmaterial name" name="rawmaterial">
         </div>
         <div class="inputBox">
            <span>Supplier</span>
            <select name="supplier_id" id="" class="box" required>
               <option value="">Select Supplier</option>
               <?php
               $res=mysqli_query($conn,"select supplier_id,supplier_name from supplier order by supplier_name desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['supplier_id'].">".$row['supplier_name']."</option>";
                  }
               ?>
            </select>
         </div>
         <div class="inputBox">
            <span>Enter Quantity</span>
            <input type="number" class="box" required maxlength="15" placeholder="Enter QTY" name="qty" min="1">
         </div>
      
      </div>
      
      <input type="submit" value="add raw material" class="btn" name="add_rawmaterial">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">Rawmaterial</h1>
   <div class="product-display">

<?php
   $select = mysqli_query($conn,"SELECT rd.*,r.*,s.supplier_name AS sname FROM rawmaterial_details rd,rawmaterial r,supplier s WHERE rd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND rd.supplier_supplier_id=s.supplier_id");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>Rawmaterial name</th>
            <th>QTY</th>
            <th>Supplier name</th>
            <th>Action</th>
         </tr>
      </thead>
      <?php
         $num = mysqli_num_rows($select);
         if($num>0){
         while($row = mysqli_fetch_assoc($select)){
      ?>
         <tr>
            <td><?php echo $row['rawmaterial_name']; ?></td>
            <td><?php echo $row['QTY']; ?></td>
            <td><?php echo $row['sname']; ?></td>
            <td>
               <a href="update_rawmaterial.php?update=<?php echo $row['rawmaterial_id']; ?>" class="option-btn">update</a>
               <a href="rawmaterial.php?delete=<?php echo $row['rawmaterial_id'];  ?>" class="delete-btn" onclick="return confirm('Delete this rawmaterial?');">delete</a>
               </td>
               </tr>
      <?php
         }
      }else{
         echo '<p class="empty">no rawmaterial added yet!</p>';
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