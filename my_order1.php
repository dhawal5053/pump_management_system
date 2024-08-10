<?php
include 'config.php';
include 'functions.php';
include 'navbar.php';
$s_id=$_GET['id'];
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
$select = mysqli_query($conn,"SELECT sd.*,s.*,p.* FROM sales_details sd,sales s,product p WHERE sd.sales_sales_id=s.sales_id AND sd.product_product_id=p.product_id AND sd.sales_sales_id='$s_id' ORDER BY sales_id DESC");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>Product Image</th>
            <th>order date</th>
            <th>Amount</th>
            <th>Product name</th>
            <th>QTY</th>
         </tr>
      </thead>
      <?php
         $num = mysqli_num_rows($select);
         if($num>0){
         while($row = mysqli_fetch_assoc($select)){
      ?>
         <tr>
            <td><img src="uploadimage/<?php echo $row['img']; ?>" height="100" alt=""></td>
            <td><?php echo $row['sale_date']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['QTY']; ?></td>
         </tr>
            <?php
         }
      }else{
         echo '<p class="empty">No purchase detail available!</p>';
      }
   ?>

   </div>

</section>








<script src="admin_script.js"></script>
   
</body>
</html>