<?php
include 'config.php';
include 'functions.php';
include 'admin_header.php';
try{
   // to add the product_category
   if(isset($_POST['add_product_category'])){
      $product_cat_name = $_POST['pro_cat_name'];
      $product_cat_img = $_FILES['img']['name'];
      $product_cat_img_tmp_name = $_FILES['img']['tmp_name'];
      $product_cat_img_folder = 'uploadimage/' . $product_cat_img;
      
      // Check if product category name or image is empty
      if(empty($product_cat_name) || empty($product_cat_img)){
         $warning_msg[] = 'Please fill out all';
      }
      else{
         // Check if the same category name already exists
         $check_category = mysqli_query($conn, "SELECT * FROM product_category WHERE cate_name = '$product_cat_name'");
         $num_rows = mysqli_num_rows($check_category);
         if($num_rows > 0){
            $info_msg[] = 'Product category already exists';
         }
         else{
            // Insert new product category
            $insert = "INSERT INTO product_category(cate_name,img)VALUES('$product_cat_name','$product_cat_img')";
            $upload = mysqli_query($conn, $insert);
            if($upload){
               move_uploaded_file($product_cat_img_tmp_name, $product_cat_img_folder);
               $success_msg[] = 'New product category added successfully';
            }
            else{
               $error_msg[] = 'Could not add the product category';
            }
         }
      }
   }
   if(isset($_GET['type']) && $_GET['type']!=''){
      $type=get_safe_value($conn,$_GET['type']);
      if($type=='status'){
         $operatin=get_safe_value($conn,$_GET['operation']);
         $id=get_safe_value($conn,$_GET['id']);
         if($operatin=='active'){
            $status="1";
         }
         else{
            $status="0";
         }
         $update_status="update product_category set status='$status' where product_cate_id='$id'";
         mysqli_query($conn,$update_status);
      }
   }

   // code to delete the product category
   if(isset($_GET['delete'])){
      $id = $_GET['delete'];
      $product=mysqli_query($conn,"SELECT * FROM product");
      $fetch=mysqli_fetch_assoc($product);
      if($id==$fetch['product_cate_id']){
         $info_msg[] = 'This product category can not be delete beacuse it is available in product section';
      }
      else{
         mysqli_query($conn,"DELETE FROM product_category WHERE product_cate_id = $id");
         header('location:product_category.php');
      }
   }
}
catch(Exception $e){
   $info_msg[]= "This product category can not be delete beacuse it is available in product section";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products Category</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="add-products">

   <h1 class="heading">add product category</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Product Category Name</span>
            <input type="text" class="box" required  maxlength="100" placeholder="Enter product category name" name="pro_cat_name">
         </div>
        <div class="inputBox">
            <span>Image</span>
            <input type="file" name="img" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
      
      </div>
      
      <input type="submit" value="add product category" class="btn" name="add_product_category">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">products category added</h1>

   <div class="product-display">

      <?php
         $select = mysqli_query($conn,"SELECT * FROM product_category");
      ?>
      <!-- <div class="box">
         <img src="uploadimage/<?php// echo $row['img']; ?>" alt="">
         <div class="name"><?php //echo $row['cate_name']; ?></div>
         <div class="flex-btn">
            <a href="update_product_category.php?update=<?php// echo $row['product_cate_id'];?>" class="option-btn">update</a>
            <a href="product_category.php?delete=<?php //echo $row['product_cate_id'];?>" class="delete-btn" onclick="return confirm('Delete this product category?');">delete</a>
         </div>
      </div> -->
         <table class="product-display-table">
            <thead>
               <tr>
                  <th>Product category image</th>
                  <th>Product category name</th>
                  <th>Action</th>
                  <th>Status</th>
               </tr>
            </thead>
            <?php
               $num = mysqli_num_rows($select);
               if($num>0){
               while($row = mysqli_fetch_assoc($select)){
            ?>
               <tr>
                  <td><img src="uploadimage/<?php echo $row['img']; ?>" height="100" alt=""></td>
                  <td><?php echo $row['cate_name']; ?></td>
                  <td>
                     <a href="update_product_category.php?update=<?php echo $row['product_cate_id'];?>" class="option-btn">update</a>
                     <a href="product_category.php?delete=<?php echo $row['product_cate_id'];?>" class="delete-btn" onclick="return confirm('Delete this product category?');">delete</a>                     
                  </td>
                  <td>
                     <?php
                        if($row['status']==1){                     
                           echo "<a class='option-btn' href='?type=status&operation=deactive&id=".$row['product_cate_id']." '>Active</a>";
                        }
                        else{
                           echo "<a class='delete-btn' href='?type=status&operation=active&id=".$row['product_cate_id']."'>Deactive</a>";
                        }
                     ?>
                  </td>
               </tr>
      <?php
         }
      }else{
         echo '<p class="empty">no product category added yet!</p>';
      }
      ?>      
         </table>
         </div>
   
   <!-- </div> -->

</section>

<script src="admin_script.js"></script>

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>
   
</body>
</html>