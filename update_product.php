<?php
include 'config.php';
include 'admin_header.php';

$id = $_GET['update'];
// update product category
if(isset($_POST['update_product'])){
   $product_name=$_POST['product_name'];
   $product_qoh=$_POST['qoh'];
   $product_des=$_POST['des'];
   $product_price=$_POST['price'];
   $product_cat_id=$_POST['product_cate_id'];
   $product_img=$_FILES['img']['name'];
   $product_img_tmp_name=$_FILES['img']['tmp_name'];
   $product_img_folder='uploadimage/'.$product_img;

   if(empty($product_name) || empty($product_qoh) || empty($product_price) || empty($product_img) || empty($product_des)){
      $warning_msg[] = 'Please fill out all';
   }
   else{
      $update = "UPDATE product SET product_name='$product_name', QOH='$product_qoh' , price='$product_price' , product_cate_id='$product_cat_id' , img='$product_img' , description='$product_des' WHERE product_id=$id";
      $upload = mysqli_query($conn,$update);
      if($upload){
         move_uploaded_file($product_img_tmp_name,$product_img_folder);
      }else{
         $error_msg[] = 'Could not add the product';
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

   <h1 class="heading">update product</h1>

   <?php
       $select = mysqli_query($conn,"SELECT * FROM product WHERE product_id=$id");
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
      <input type="text" name="product_name" required class="box" maxlength="100" placeholder="Enter product name" value="<?php echo $row['product_name']; ?>">
      <span>Update Quantity On Hand</span>
      <input type="number" class="box" required placeholder="Enter QOH" name="qoh" min="1" value="<?php echo $row['QOH']; ?>">
      <span>Update Price</span>
      <input type="number" class="box" required placeholder="Enter price" name="price" value="<?php echo $row['price']; ?>">
      <span>Update Product Categories </span>
            <select name="product_cate_id" id="" class="box">
               <option value="">Select Category</option>
               <?php
               $res=mysqli_query($conn,"select product_cate_id,cate_name from product_category order by cate_name desc");
                     while($row1=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row1['product_cate_id'].">".$row1['cate_name']."</option>";
                  }
               ?>
            </select>
      <span>Update image</span>
      <input type="file" name="img" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>Update Description</span>
      <input type="text" name="des" required class="box" placeholder="Enter Description" value="<?php echo $row['description']; ?>">
      <span>Update Price</span>
      <div class="flex-btn">
         <input type="submit" name="update_product" class="btn" value="update">
         <a href="product.php" class="option-btn">go back</a>
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