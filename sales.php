<?php
include 'config.php';
include 'functions.php';
include 'admin_header.php';

if(isset($_GET['type']) && $_GET['type']!=''){
   $type=get_safe_value($conn,$_GET['type']);
   if($type=='d_status'){
      $operatin=get_safe_value($conn,$_GET['operation']);
      $id=get_safe_value($conn,$_GET['id']);
      if($operatin=='delivered'){
         $status="1";
         $system_date = date("Y-m-d");
         mysqli_query($conn,"UPDATE sales SET payment_date = '$system_date' WHERE sales_id='$id'");
      }
      else{
         $status="0";
      }
      $update_status="update sales set d_status='$status' where sales_id='$id'";
      mysqli_query($conn,$update_status);
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
<section class="show-products">

   <h1 class="heading">Sales</h1>
   <div class="product-display">

<?php
   $select = mysqli_query($conn,"SELECT sd.*,s.*,u.*,p.*,DATE_FORMAT(s.sale_date, '%d-%m-%Y') AS sdate ,DATE_FORMAT(s.payment_date, '%d-%m-%Y') AS pdate  FROM sales_details sd,sales s,user u,product p WHERE sd.sales_sales_id=s.sales_id AND sd.product_product_id=p.product_id AND s.user_id=u.user_id ORDER BY sales_id DESC");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>Sales&nbsp;&nbsp;date</th>
            <th>Payment date</th>
            <th>Amount</th>
            <th>Payment type</th>
            <th>Customer name</th>
            <th>Product name</th>
            <th>QTY</th>
            <th>Delivery status</th>
         </tr>
      </thead>
      <?php
         $num = mysqli_num_rows($select);
         if($num>0){
         while($row = mysqli_fetch_assoc($select)){
      ?>
         <tr>
            <td><?php echo $row['sdate']; ?></td>
            <?php if($row['pdate']==00-00-0000){
               echo '<td>PENDING</td>';
            }
            else{
               echo '<td>' . $row['pdate'] . '</td>';
            }
            ?>
            <td><?php echo $row['total_amt']; ?></td>
            <td><?php echo $row['payment_type']; ?></td>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['QTY']; ?></td>
            <td>
                     <?php
                        if($row['Is_cancel']==1){
                           echo "<p class='delete-btn' style='cursor : default;'>Canceled</p>";
                        }
                        else if($row['d_status']==1){
                     
                           echo "<a class='option-btn' href='?type=d_status&operation=pending&id=".$row['sales_id']." '>Delivered</a>";
                        }
                        else{
                           echo "<a class='delete-btn' href='?type=d_status&operation=delivered&id=".$row['sales_id']."'>Pending</a>";
                        }
                     ?>
                  </td>
        </tr>
            <?php
         }
      }else{
         echo '<p class="empty">No sales detail available!</p>';
      }
   ?>

   </div>

</section>








<script src="admin_script.js"></script>
   
</body>
</html>