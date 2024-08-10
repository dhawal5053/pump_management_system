<?php
include 'config.php';
include 'functions.php';
include 'admin_header.php';

if(isset($_POST['add_product'])){
   $product_name=$_POST['pro_name'];
   $product_qoh=$_POST['qoh'];
   $product_price=$_POST['price'];
   $product_cat_id=$_POST['product_cate_id'];
   $product_des=$_POST['des'];
   $product_img=$_FILES['img']['name'];
   $product_img_tmp_name=$_FILES['img']['tmp_name'];
   $product_img_folder='uploadimage/'.$product_img;

   if(empty($product_name) || empty($product_qoh) || empty($product_price) || empty($product_img) || empty($product_des)){
      $warning_msg[] = 'Please fill out all fields';
   } else {
      // Check if product with same name already exists
      $check_duplicate = mysqli_query($conn, "SELECT * FROM product WHERE product_name = '$product_name'");
      if(mysqli_num_rows($check_duplicate) > 0){
         $info_msg[] = 'Product already exists';
      } else {
         $insert = "INSERT INTO product(product_name,QOH,price,img,description,product_cate_id)VALUES('$product_name','$product_qoh','$product_price','$product_img','$product_des','$product_cat_id')";
         $upload = mysqli_query($conn,$insert);
         if($upload){
            move_uploaded_file($product_img_tmp_name,$product_img_folder);
            $success_msg[] = 'New product added successfully';
         }else{
            $error_msg[] = 'Could not add the product';
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
      $update_status="update product set status='$status' where product_id='$id'";
      mysqli_query($conn,$update_status);
   }
}


// to delete the product
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn,"DELETE FROM product WHERE product_id = $id");
   header('location:product.php');
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

<section class="add-products">

   <h1 class="heading">add product</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Product Name</span>
            <input type="text" class="box" required  maxlength="30" placeholder="Enter produt name" name="pro_name">
         </div>
         <div class="inputBox">
            <span>Quantity On Hand</span>
            <input type="number" class="box" required placeholder="Enter QOH" name="qoh" min="1">
         </div>
         <div class="inputBox">
            <span>Price</span>
            <input type="number" class="box" required placeholder="Enter price" name="price">
         </div>
        <div class="inputBox">
            <span>Image</span>
            <input type="file" name="img" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>Description</span>
            <textarea class="box" name="des" id="" cols="30" rows="2"></textarea>
         </div>
        <div class="inputBox">
            <span>Product_Categories </span>
            <select name="product_cate_id" id="" class="box">
               <option value="">Select Category</option>
               <?php
               $res=mysqli_query($conn,"select product_cate_id,cate_name from product_category order by cate_name desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['product_cate_id'].">".$row['cate_name']."</option>";
                  }
               ?>
            </select>
         </div>
      </div>
      <input type="submit" value="add product" class="btn" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">products added</h1>
   <div class="product-display">

<?php
   $select = mysqli_query($conn,"SELECT p.*,c.cate_name AS cname FROM product p,product_category c WHERE c.product_cate_id=p.product_cate_id");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>Product image</th>
            <th>Product name</th>
            <th>Price</th>
            <th>QOH</th>
            <th>Product category</th>
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
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['QOH']; ?></td>
            <td><?php echo $row['cname']; ?></td>
            <td>
               <a href="update_product.php?update=<?php echo $row['product_id'];?>" class="option-btn">update</a>
               <a href="product.php?delete=<?php echo $row['product_id'];?>" class="delete-btn" onclick="return confirm('Delete this product?');">delete</a>
               </td>
               <td>
               <?php
                  if($row['status']==1){
               
                     echo "<a class='option-btn' href='?type=status&operation=deactive&id=".$row['product_id']." '>Active</a>";
                  }
                  else{
                     echo "<a class='delete-btn'  href='?type=status&operation=active&id=".$row['product_id']."'>Deactive</a>";
                  }
               ?>
               </td>
         </tr>
      <?php
         }
      }else{
         echo '<p class="empty">no product added yet!</p>';
      }
      ?>      
         </table>
         </div>
</section>

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

<script src="admin_script.js"></script>
   
</body>
</html>