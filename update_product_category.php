<?php
include 'config.php';
include 'admin_header.php';

$id = $_GET['update'];
// update product category
if(isset($_POST['update_cate'])){

   $product_cat_name=$_POST['pro_cat_name'];
   $product_cat_img=$_FILES['img']['name'];
   $product_cat_img_tmp_name=$_FILES['img']['tmp_name'];
   $product_cat_img_folder='uploadimage/'.$product_cat_img;

   if(empty($product_cat_name) || empty($product_cat_img)){
      $warning_msg[] = 'Please fill out all';
   }
   else{
      $update = "UPDATE product_category SET cate_name='$product_cat_name', img='$product_cat_img' WHERE product_cate_id=$id";
      $upload = mysqli_query($conn,$update);
      if($upload){
         move_uploaded_file($product_cat_img_tmp_name,$product_cat_img_folder);
      }else{
         $error_msg[] = 'Could not add the product category';
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
   <title>Update product Category</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="update-product">

   <h1 class="heading">update product category</h1>

   <?php
       $select = mysqli_query($conn,"SELECT * FROM product_category WHERE product_cate_id=$id");
       $num = mysqli_num_rows($select);
       if($num>0){
       while($row = mysqli_fetch_assoc($select)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <div class="image-container">
         <div class="main-image">
            <img src="uploadimage/<?= $row['img']; ?>" alt="">
         </div>
      </div>
      <span>Update name</span>
      <input type="text" name="pro_cat_name" required class="box" maxlength="100" placeholder="Enter product category name" value="<?php echo $row['cate_name']; ?>">
      <span>Update image</span>
      <input type="file" name="img" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <div class="flex-btn">
         <input type="submit" name="update_cate" class="btn" value="update">
         <a href="product_category.php" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
       }
       }else{
         echo '<p class="empty">No product found!</p>';
      }
   ?>

</section>

<script src="admin_script.js"></script>
   
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>