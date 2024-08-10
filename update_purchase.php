<?php
include 'config.php';
include 'admin_header.php';

$id = $_GET['update'];
// to update purchase
if(isset($_POST['update_purchase'])){
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
        $query= mysqli_query($conn,"SELECT * FROM purchase_details WHERE purchase_purchase_id='$id'");
        $fire=mysqli_fetch_assoc($query);
        $fire1=$fire['QTY'];
        $fire2=$fire['rawmaterial_rawmaterial_id'];
        mysqli_query($conn,"UPDATE rawmaterial_details SET QTY=QTY-'$fire1' WHERE rawmaterial_rawmaterial_id='$fire2'");
        $update = "UPDATE purchase SET purchase_date='$pudate', total_amt='$tamt', payment_date='$pdate', payment_amt='$pamt', payment_type='$popt', CGST='$cgst', SGST='$sgst', supplier_id='$supplier_id' WHERE purchase_id='$id'";
        $upload = mysqli_query($conn,$update);
        $update1 = "UPDATE purchase_details SET QTY='$qty', rawmaterial_rawmaterial_id='$rawmaterial_id' WHERE purchase_purchase_id='$id'";
        $upload1 = mysqli_query($conn,$update1);
        if($upload==true and $upload1==true){
          mysqli_query($conn,"UPDATE rawmaterial_details SET QTY=QTY+'$qty' WHERE rawmaterial_rawmaterial_id='$rawmaterial_id'");
          $success_msg[] = 'Purchase datail updated successfully';
        }
        else{
           $error_msg[] = 'Could not update the purchase detail';
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
   <title>Update purchase</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">update purchase</h1>

   <?php
        $select = mysqli_query($conn,"SELECT p.*,pd.* FROM purchase_details pd,purchase p WHERE p.purchase_id=$id AND pd.purchase_purchase_id=$id");
        $num = mysqli_num_rows($select);
       if($num>0){
       while($row = mysqli_fetch_assoc($select)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
          <div class="inputBox">
              <span>Update purchase date</span>
              <input type="date" class="box" placeholder="Select purchase date" name="pudate" required value="<?php echo $row['purchase_date']; ?>">
            </div>
            <div class="inputBox">
                <span>Update payment date</span>
                <input type="date" class="box" placeholder="Select payment date" name="pdate" required value="<?php echo $row['payment_date']; ?>">
            </div>
            <div class="inputBox">
                <span>Update payment amount</span>
                <input type="text" class="box" required  placeholder="Enter payment amount" name="pamt" value="<?php echo $row['payment_amt']; ?>">
            </div>
            <div class="inputBox">
                <span>Update payment option</span>
                <select class="box" required name="popt" required>
                    <option>Select payment option</option>
                    <option selected><?php echo $row['payment_type']; ?></option>
                    <option>Cash</option>
                    <option>Check</option>
                    <option>Debit card</option>
                    <option>Credit card</option>
                    <option>UPI</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Update CGST</span>
                <input type="text" class="box" required maxlength="1" placeholder="Enter CGST" required pattern="[0-9]{1}" oninvalid="this.setCustomValidity('Please enter valid CGST amount.')" name="cgst" value="<?php echo $row['CGST']; ?>">
            </div>
            <div class="inputBox">
                <span>Update SGST</span>
                <input type="text" class="box" required maxlength="1" placeholder="Enter SGST" required pattern="[0-9]{1}" oninvalid="this.setCustomValidity('Please enter valid SGST amount.')" name="sgst" value="<?php echo $row['SGST']; ?>">
            </div>
            <div class="inputBox">
                  <span>Update quantity</span>
                  <input type="number" class="box" required maxlength="15" placeholder="Enter QTY" name="qty" min="1" value="<?php echo $row['QTY']; ?>">
            </div>
            <div class="inputBox">
                <span>Update supplier</span>
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
            <span>Update rawmaterial</span>
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
    </div>
      <div class="flex-btn">
         <input type="submit" name="update_purchase" class="btn" value="update">
         <a href="purchase.php" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
       }
       }else{
         echo '<p class="empty">No purchase found!</p>';
      }
   ?>

</section>

<script src="admin_script.js"></script>
   
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>