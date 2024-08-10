<?php
include 'config.php';
include 'admin_header.php';

$id = $_GET['update'];
// update supplier
if(isset($_POST['update_rawmaterial'])){
    $rawmaterial_name = $_POST['rawmaterial'];
    $qty = $_POST['qty'];
    $supplier_id = $_POST['supplier_id'];

    if(empty($rawmaterial_name) || empty($qty) || empty($supplier_id)){
       $warning_msg[] = 'Please fill out all';
    }
       else{
        $update = "UPDATE rawmaterial SET rawmaterial_name='$rawmaterial_name' WHERE rawmaterial_id='$id'";
        $upload = mysqli_query($conn,$update);
        $update1 = "UPDATE rawmaterial_details SET QTY='$qty', supplier_supplier_id='$supplier_id' WHERE rawmaterial_rawmaterial_id='$id'";
        $upload1 = mysqli_query($conn,$update1);
          if($upload==true and $upload1==true){
             $success_msg[] = 'Rawmaterial detail updated successfully';
          }
          else{
             $error_msg[] = 'Could not update the rawmaterial detail';
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
   <title>Update rawmaterial</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">update rawmaterial</h1>

   <?php
       $select = mysqli_query($conn,"SELECT rd.*,r.* FROM rawmaterial_details rd,rawmaterial r WHERE rd.rawmaterial_rawmaterial_id=$id AND r.rawmaterial_id = $id");
       $num = mysqli_num_rows($select);
       if($num>0){
       while($row = mysqli_fetch_assoc($select)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
   <div class="flex">
   <div class="inputBox">
            <span>Update Rawmaterial</span>
            <input type="text" class="box" required maxlength="30" placeholder="Enter rawmaterial name" name="rawmaterial" value="<?php echo $row['rawmaterial_name']; ?>">
         </div>
         <div class="inputBox">
            <span>Update Quantity</span>
            <input type="number" class="box" required maxlength="15" placeholder="Enter QTY" value="<?php echo $row['QTY']; ?>" name="qty" min="1">
         </div>
         <div class="inputBox">
            <span>Update Supplier</span>
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
      
      </div>
      <div class="flex-btn">
         <input type="submit" name="update_rawmaterial" class="btn" value="update">
         <a href="rawmaterial.php" class="option-btn">go back</a>
      </div>
               </div>
   </form>
   
   <?php
       }
       }else{
         echo '<p class="empty">No rawmaterial found!</p>';
      }
   ?>

</section>

<script src="admin_script.js"></script>
   
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>