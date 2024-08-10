<?php

include 'config.php';

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:Our_category.php');
}

if(isset($_POST['delete_review'])){

   $delete_id = $_POST['delete_id'];
   // $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = mysqli_query($conn,"SELECT * FROM `feedback_rating` WHERE f_r_id = '$delete_id'");
   $v_d = mysqli_num_rows($verify_delete);
   if($v_d > 0){
      $delete_review = mysqli_query($conn,"DELETE FROM `feedback_rating` WHERE f_r_id = '$delete_id'");
      $success_msg[] = 'Review deleted!';
   }else{  
      $warning_msg[] = 'Review already deleted!';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>view review</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/s2.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'navbar.php'; ?>
<!-- header section ends -->

<!-- view posts section starts  -->

<section class="view-post">

   <div class="heading"><h1>product details</h1> <a href="Our-category.php" class="inline-option-btn" style="margin-top: 0;">All Products</a></div>

   <?php
      $select = mysqli_query($conn,"SELECT * FROM product where product_id='$get_id'");
      $num = mysqli_num_rows($select);
      if($num>0){
         while($row = mysqli_fetch_assoc($select)){ 
            $total_ratings = 0;
            $rating_1 = 0;
            $rating_2 = 0;
            $rating_3 = 0;
            $rating_4 = 0;
            $rating_5 = 0;

         $select1 = mysqli_query($conn,"SELECT f.*,u.*,p.* FROM feedback_rating f,user u,product p WHERE f.user_id=u.user_id AND f.product_id=p.product_id AND p.product_id=$get_id");
         $total_reivews = mysqli_num_rows($select1);
         if($total_reivews>0){
            while($fetch_rating =  mysqli_fetch_assoc($select1)){
               $total_ratings += $fetch_rating['star'];
               if($fetch_rating['star'] == 1){
               $rating_1 += $fetch_rating['star'];
               }
               if($fetch_rating['star'] == 2){
                  $rating_2 += $fetch_rating['star'];
               }
               if($fetch_rating['star'] == 3){
                  $rating_3 += $fetch_rating['star'];
               }
               if($fetch_rating['star'] == 4){
                  $rating_4 += $fetch_rating['star'];
               }
               if($fetch_rating['star'] == 5){
                  $rating_5 += $fetch_rating['star'];
               }
            }
         }
         if($total_reivews != 0){
               $average = round($total_ratings / $total_reivews, 1);
         }else{
               $average = 0;
         }
        
   ?>
   <div class="row">
      <div class="col">
         <img src="uploadimage/<?= $row['img']; ?>" alt="" class="image">
         <h3 class="title"><?= $row['product_name']; ?></h3>
      </div>
      <div class="col">
         <div class="flex">
            <div class="total-reviews">
               <h3><?= $average; ?><i class="fas fa-star"></i></h3>
               <p><?= $total_reivews; ?> reviews</p>
            </div>
            <div class="total-ratings">
               <p>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <span><?= $rating_5; ?></span>
               </p>
               <p>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <span><?= $rating_4; ?></span>
               </p>
               <p>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <span><?= $rating_3; ?></span>
               </p>
               <p>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <span><?= $rating_2; ?></span>
               </p>
               <p>
                  <i class="fas fa-star"></i>
                  <span><?= $rating_1; ?></span>
               </p>
            </div>
         </div>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">product is missing!</p>';
      }
   ?>

</section>

<!-- view posts section ends -->

<!-- reviews section starts  -->

<section class="reviews-container">

   <div class="heading"><h1>user's reviews</h1> <a href="add_review.php?get_id=<?= $get_id; ?>" class="inline-btn" style="margin-top: 0;">add review</a></div>

   
   <?php
      $select_reviews = mysqli_query($conn,"SELECT f.*,u.*,p.* FROM feedback_rating f,user u,product p WHERE f.user_id=u.user_id AND f.product_id=p.product_id AND p.product_id=$get_id");
      $total_reivews1 = mysqli_num_rows($select_reviews);
      if($total_reivews1>0){
         while($fetch_review =  mysqli_fetch_assoc($select_reviews)){?>
         <div class="box-container">
            <div class="user" style="font-size:25px;">   
               <div id="user-btn" class="fas fa-user">

               </div>
               <div>
                  <p><?= $fetch_review['fname']; ?></p>
                  <span><?= $fetch_review['f_date']; ?></span>
               </div>
            </div>
            <div class="ratings" >
               <?php if($fetch_review['star'] == 1){ ?>
                  <p style="background:var(--red);float:right;font-size:25px;"><i class="fas fa-star"></i> <span><?= $fetch_review['star']; ?></span></p>
               <?php }; ?> 
               <?php if($fetch_review['star'] == 2){ ?>
                  <p style="background:var(--orange);float:right;font-size:25px;"><i class="fas fa-star"></i> <span><?= $fetch_review['star']; ?></span></p>
               <?php }; ?>
               <?php if($fetch_review['star'] == 3){ ?>
                  <p style="background:var(--orange);float:right;font-size:25px;"><i class="fas fa-star"></i> <span><?= $fetch_review['star']; ?></span></p>
               <?php }; ?>   
               <?php if($fetch_review['star'] == 4){ ?>
                  <p style="background:var(--main-color);float:right;font-size:25px;"><i class="fas fa-star"></i> <span><?= $fetch_review['star']; ?></span></p>
               <?php }; ?>
               <?php if($fetch_review['star'] == 5){ ?>
                  <p style="background:var(--main-color);float:right;font-size:25px;"><i class="fas fa-star"></i> <span><?= $fetch_review['star']; ?></span></p>
               <?php }; ?>
            </div>
            <h3 class="title" style="font-size:25px;"><?= $fetch_review['feedback_titles']; ?></h3>
               <p class="description"  style="font-size:25px;"><?= $fetch_review['f_comments']; ?></p>  
            <?php if(isset($_SESSION['User-login']) and $_SESSION['User']==$fetch_review['user_id']){ ?>
               <form action="" method="post" class="flex-btn">
                  <input type="hidden" name="delete_id" value="<?= $fetch_review['f_r_id']; ?>">
                  <a href="update_review.php?get_id=<?= $fetch_review['f_r_id']; ?>" class="inline-option-btn">edit review</a>
                  <input type="submit" value="delete review" class="inline-delete-btn" name="delete_review" onclick="return confirm('delete this review?');">
               </form>
            <?php }; ?>   
         </div>
   <?php
         }
      }else{
         echo '<p class="empty">no reviews added yet!</p>';
      }
   ?>


</section>

<!-- reviews section ends -->














<!-- custom js file link  -->
<script src="js/script.js"></script>

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>