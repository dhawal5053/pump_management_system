<?php
include 'config.php';
include 'functions.php';
include 'navbar.php';
$user_id=$_SESSION['User'];
if(isset($_GET['cancel'])){
   $id = $_GET['cancel'];
   mysqli_query($conn,"UPDATE sales SET Is_cancel=1 WHERE sales_id = $id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="show-products">

   <h1 class="heading">My Orders</h1>
   <div class="product-display">
      <?php
      $select = mysqli_query($conn,"SELECT * FROM sales WHERE user_id='$user_id'");
      ?>
      <table class="product-display-table">
         <thead>
            <tr>
               <th>Order Id</th>
               <th>Order date</th>
               <th>Payment date</th>
               <th>Total Amount</th>
               <th>Payment type</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $num = mysqli_num_rows($select);
            if($num>0){
               while($row = mysqli_fetch_assoc($select)){?>
                  <tr>
                     <td><?php echo $row['sales_id']; ?></td>
                     <td><?php echo $row['sale_date']; ?></td>
                     <td><?php echo $row['payment_date']; ?></td>
                     <td><?php echo $row['total_amt']; ?></td>
                     <td><?php echo $row['payment_type']; ?></td>
                     <td>
                     <button onclick="window.location.href = 'my_order1.php?id=<?php echo $row['sales_id']; ?>';" name="submit" class="option-btn">View Order</button>
                     <button onclick="window.location.href = 'invoice.php?id=<?php echo $row['sales_id']; ?>';" name="submit" class="option-btn">Invoice</button>
                        <?php
                        if ($row['d_status'] == 1) {
                           echo "<p class='delete-btn' style='cursor : default;'>Delivered</p>";
                        }elseif($row['Is_cancel']==1){
                        echo "<p class='delete-btn' style='cursor : default;'>Canceled</p>";
                        } 
                        else{
                           echo '<a href="my_order.php?cancel=' . $row['sales_id'] . '" class="delete-btn" onclick="return confirm(\'Are You sure you want to cancel this order?\');">Cancel</a>';
                        }
                        ?>
                     </td>
               </tr>
         <?php }
            }
            else{
               echo '<p class="empty">No purchase detail available!</p>';
            }?>
         </tbody>
      <table>
   </div>

</section>








<script src="admin_script.js"></script>
   
</body>
</html>