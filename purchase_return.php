<?php
include 'admin_header.php';

include 'config.php';
   // to add the purchase return detail
   if(isset($_POST['add_purchase_return'])){
      $purdate = $_POST['purdate'];
      $pdate = $_POST['pudate'];
      $ramt = $_POST['ramt'];
      $rawmaterial_id= $_POST['rawmaterial_id'];
      $qty = $_POST['qty'];
      if(empty($purdate) || empty($pdate) || empty($ramt) || empty($rawmaterial_id) || empty($qty)){
         $warning_msg[] = 'Please fill out all';
      }
      else{
         if(date($purdate) > date($pdate)){
            $error_msg[] = 'Please enter valid purchase return date';   
         }  
         else{
            $insert = "INSERT INTO purchase_return(return_date,return_amt,purchase_id)VALUES('$purdate','$ramt','$pdate')";
            $upload = mysqli_query($conn, $insert);
            $check1=mysqli_query($conn,"SELECT * FROM purchase_return WHERE purchase_return_id NOT IN (SELECT purchase_return_purchase_return_id FROM purchase_return_details)");
            $fetch1=mysqli_fetch_assoc($check1);
            $pid=$fetch1['purchase_return_id'];
            $query = "INSERT INTO purchase_return_details(purchase_return_purchase_return_id,rawmaterial_rawmaterial_id,QTY)VALUES('$pid','$rawmaterial_id','$qty')";
            $fire = mysqli_query($conn,$query);
            if($upload==true and $fire==true){
                 mysqli_query($conn,"UPDATE rawmaterial_details SET QTY=QTY-'$qty'  WHERE rawmaterial_rawmaterial_id='$rawmaterial_id' ");
                 $success_msg[] = 'New purchase return detail added successfully';
                }
            else{
               $error_msg[] = 'Could not add the purchase return detail';
            }
         }
      }
   }
   // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>purchase return</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">add purchase return detail</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
      <div class="inputBox">
            <span>Purchase return date</span>
            <input type="date" class="box" placeholder="Select purchase return date" name="purdate" required>
         </div>
         <div class="inputBox">
            <span>Return amount</span>
            <input type="text" class="box" required  placeholder="Enter return amount" name="ramt">
         </div>
         <div class="inputBox">
            <span>Purchase date</span>
            <select name="pudate" id="" class="box" required>
               <option value="">Select purchase date</option>
               <?php
               $res=mysqli_query($conn,"SELECT DATE_FORMAT(purchase_date,'%d-%m-%Y') AS date,purchase_id FROM purchase ORDER BY purchase_date desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['purchase_id'].">".$row['date']."</option>";
                  }
               ?>
            </select>
         </div>
         <div class="inputBox">
            <span>Supplier</span>
            <select name="supplier_id" id="" class="box" required>
               <option value="">Select Supplier</option>
               <?php
               $res=mysqli_query($conn,"SELECT DISTINCT p.supplier_id,s.* FROM supplier s,purchase p WHERE p.supplier_id=s.supplier_id ORDER BY supplier_name DESC");
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
      
      <input type="submit" value="add purchase return details" class="btn" name="add_purchase_return">
   </form>

<section class="show-products">

<h1 class="heading">Purchase return</h1>
<div class="product-display">

<?php
$select = mysqli_query($conn,"SELECT pr.*,prd.*,p.*,r.*,s.* FROM purchase_return pr,purchase_return_details prd,purchase p,rawmaterial r , supplier s WHERE prd.purchase_return_purchase_return_id=pr.purchase_return_id AND prd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND pr.purchase_id=p.purchase_id AND p.supplier_id=s.supplier_id ORDER BY purchase_return_id DESC");
?>
<table class="product-display-table">
   <thead>
      <tr>
         <th>Purchase return date</th>
         <th>Return Amount</th>
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
         <td><?php echo $row['return_date']; ?></td>
         <td><?php echo $row['return_amt']; ?></td>
         <td><?php echo $row['supplier_name']; ?></td>
         <td><?php echo $row['rawmaterial_name']; ?></td>
         <td><?php echo $row['QTY']; ?></td>
         <td>
            <a href="update_purchase.php?update=<?php echo $row['purchase_return_id']; ?>" class="option-btn">update</a>
            <a href="purchase.php?delete=<?php echo $row['purchase_return_id'];  ?>" class="delete-btn" onclick="return confirm('Delete this purchase return detail?');">delete</a>
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