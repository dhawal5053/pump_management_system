<?php
include 'config.php';
include 'navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/s1.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<section class="quick-view">

   <h1 class="heading">Product Details</h1>

   <?php
     $pid = $_GET['pid'];
     $select = mysqli_query($conn,"SELECT * FROM product where product_id=$pid");
     $num = mysqli_num_rows($select);
     if($num>0){
      while($row = mysqli_fetch_assoc($select)){ 
   ?>
   <form action="manage_cart1.php" method="post" class="box">
      <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
      <input type="hidden" name="product_name" value="<?= $row['product_name']; ?>">
      <input type="hidden" name="price" value="<?= $row['price']; ?>">
      <!-- <input type="hidden" name="image" value="<?= $row['img']; ?>"> -->
      <div class="row" style="display: flex;">
         <div class="image-container">
            <div class="main-image">
               <img style="width: 350px;height: 200px;" src="uploadimage/<?= $row['img']; ?>" alt="">
            </div>
            <!-- <div class="sub-image">
               <img src="uploadimage/<?= $row['img']; ?>" alt="">
               <img src="uploadimage/<?= $row['img']; ?>" alt="">
               <img src="uploadimage/<?= $row['img']; ?>" alt="">
            </div> -->
         </div>
         <div class="content">
            <div class="name"><?= $row['product_name']; ?></div>
            <div class="details"><?= $row['description']; ?></div>
            <div class="flex">
               <div class="price"><span>$</span><?= $row['price']; ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="flex-btn">
               <input type="submit" value="add to cart" class="btn" name="Add_To_Cart">
               <a href="Our-category.php" class="option-btn">go back</a>
               <!-- <input class="option-btn" type="submit" name="Back" value="Back"> -->
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>