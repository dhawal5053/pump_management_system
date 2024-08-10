<?php
include 'admin_header.php';

include 'config.php';
   // to add the purchase detail
   if(isset($_POST['add_purchase'])){
      $pudate = $_POST['pudate'];
      $pdate = $_POST['pdate'];
      $pamt = $_POST['pamt'];
      $popt = $_POST['popt'];
      $cgst = $_POST['cgst'];
      $sgst = $_POST['sgst'];
      $tamt = $pamt+(($cgst/100+$sgst/100)*$pamt);
      $supplier_id = $_POST['supplier_id'];
      $rawmaterial_id= $_POST['rawmaterial_id'];
      $qty = $_POST['qty'];
      if(empty($pudate) || empty($pdate) || empty($pamt) || empty($popt) || empty($cgst) || empty($sgst) || empty($supplier_id) || empty($rawmaterial_id) || empty($qty)){
         $warning_msg[] = 'Please fill out all';
      }
      else{
         if($pdate < $pudate){
            $error_msg[] = 'Please enter valid payment date';
         }
         else{
            // Insert new purchase detail
            $insert = "INSERT INTO purchase(purchase_date,total_amt,payment_date,payment_amt,payment_type,CGST,SGST,supplier_id)VALUES('$pudate','$tamt','$pdate','$pamt','$popt','$cgst','$sgst','$supplier_id')";
            $upload = mysqli_query($conn, $insert);
            $check1=mysqli_query($conn,"SELECT * FROM purchase WHERE purchase_id NOT IN (SELECT purchase_purchase_id FROM purchase_details)");
            $fetch1=mysqli_fetch_assoc($check1);
            $pid=$fetch1['purchase_id'];
            $query = "INSERT INTO purchase_details(purchase_purchase_id,rawmaterial_rawmaterial_id,QTY)VALUES('$pid','$rawmaterial_id','$qty')";
            $fire = mysqli_query($conn,$query);
            if($upload==true and $fire==true){
              mysqli_query($conn,"UPDATE rawmaterial_details SET QTY=QTY+'$qty' WHERE rawmaterial_rawmaterial_id='$rawmaterial_id'");
              $success_msg[] = 'New purchase detail added successfully';
            }
            else{
               $error_msg[] = 'Could not add the purchase detail';
            }
         }
      }
   }
// code to delete the purchase detail
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   $check1=mysqli_query($conn,"SELECT * FROM purchase_return WHERE purchase_id='$id'");
   $fetch1=mysqli_fetch_assoc($check1);
   $num1=mysqli_num_rows($check1);
   if($num1>0){
     if($id==$fetch1['purchase_id']){
      $warning_msg[] = 'This purchase detail can not be deleted';
   }
}
   else{
      mysqli_query($conn,"DELETE FROM purchase_details WHERE purchase_purchase_id = $id");
      mysqli_query($conn,"DELETE FROM purchase WHERE purchase_id = $id");
      header('location:purchase.php');
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>purchase</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">add purchase detail</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
      <div class="inputBox">
            <span>Purchase date</span>
            <input type="date" class="box" placeholder="Select purchase date" name="pudate" required>
         </div>
         <div class="inputBox">
            <span>Payment date</span>
            <input type="date" class="box" placeholder="Select payment date" name="pdate" required>
         </div>
         <div class="inputBox">
            <span>Payment amount</span>
            <input type="text" class="box" required  placeholder="Enter payment amount" name="pamt">
         </div>
         <div class="inputBox">
            <span>Payment option</span>
            <select class="box" required name="popt" required> 
               <option>Select payment option</option>
               <option selected>Cash</option>
               <option>Check</option>
               <option>Debit card</option>
               <option>Credit card</option>
               <option>UPI</option>
            </select>
         </div>
         <div class="inputBox">
            <span>CGST</span>
            <input type="text" class="box" required maxlength="1" placeholder="Enter CGST" required pattern="[0-9]{1}" oninvalid="this.setCustomValidity('Please enter valid CGST amount.')" name="cgst">
         </div>
         <div class="inputBox">
            <span>SGST</span>
            <input type="text" class="box" required maxlength="1" placeholder="Enter SGST" required pattern="[0-9]{1}" oninvalid="this.setCustomValidity('Please enter valid SGST amount.')" name="sgst">
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
            <span>Rawmaterial</span>
            <select name="rawmaterial_id" id="" class="box" required>
               <option value="">Select Rawmaterial</option>
               <?php
               $res=mysqli_query($conn,"select rawmaterial_id,rawmaterial_name from rawmaterial order by rawmaterial_name desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['rawmaterial_id'].">".$row['rawmaterial_name']."</option>";
                  }
               ?>
            </select>
         </div>
         <div class="inputBox">
            <span>Enter Quantity</span>
            <input type="number" class="box" required maxlength="15" placeholder="Enter QTY" name="qty" min="1">
         </div>
      </div>
      
      <input type="submit" value="add purchase details" class="btn" name="add_purchase">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">Purchase</h1>
   <div class="product-display">

<?php
   $select = mysqli_query($conn,"SELECT pd.*,p.*,s.*,r.* FROM purchase_details pd,purchase p,supplier s,rawmaterial r WHERE pd.purchase_purchase_id=p.purchase_id AND pd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND p.supplier_id=s.supplier_id ORDER BY purchase_id DESC");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>Purchase date</th>
            <th>Payment date</th>
            <th>Amount</th>
            <th>Payment type</th>
            <th>Supplier name</th>
            <th>Rawmaterial name</th>
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
            <td><?php echo $row['purchase_date']; ?></td>
            <td><?php echo $row['payment_date']; ?></td>
            <td><?php echo $row['total_amt']; ?></td>
            <td><?php echo $row['payment_type']; ?></td>
            <td><?php echo $row['supplier_name']; ?></td>
            <td><?php echo $row['rawmaterial_name']; ?></td>
            <td><?php echo $row['QTY']; ?></td>
            <td>
               <a href="update_purchase.php?update=<?php echo $row['purchase_id']; ?>" class="option-btn">update</a>
               <a href="purchase.php?delete=<?php echo $row['purchase_id'];  ?>" class="delete-btn" onclick="return confirm('Delete this purchase detail?');">delete</a>
               </td>
               </tr>
            <?php
         }
      }else{
         echo '<p class="empty">No purchase detail available!</p>';
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