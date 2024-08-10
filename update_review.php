<?php

include 'config.php';

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:Our-category.php');
}

if(isset($_POST['submit'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $rating = $_POST['rating'];
   $rating = filter_var($rating, FILTER_SANITIZE_STRING);

   $update_review = mysqli_query($conn,"UPDATE `feedback_rating` SET star = '$rating', feedback_titles = '$title', f_comments = '$description' WHERE f_r_id = '$get_id'");

   $success_msg[] = 'Review updated!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update review</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/s2.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'navbar.php'; ?>
<!-- header section ends -->

<!-- update reviews section starts  -->

<section class="account-form">

   <?php
      $select_review = mysqli_query($conn,"SELECT * FROM `feedback_rating` WHERE f_r_id = '$get_id'");
      $num = mysqli_num_rows($select_review);
      if($num>0){
         while($fetch_review = mysqli_fetch_assoc($select_review)){
      
   ?>
   <form action="" method="post">
      <h3>edit your review</h3>
      <p class="placeholder">review title <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="enter review title" class="box" value="<?= $fetch_review['feedback_titles']; ?>">
      <p class="placeholder">review description</p>
      <textarea name="description" class="box" placeholder="enter review description" maxlength="1000" cols="30" rows="10"><?= $fetch_review['f_comments']; ?></textarea>
      <p class="placeholder">review rating <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="<?= $fetch_review['star']; ?>"><?= $fetch_review['star']; ?></option>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="update review" name="submit" class="btn">
      <a href="view_review.php?get_id=<?= $fetch_review['product_id']; ?>" class="option-btn">go back</a>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">something went wrong!</p>';
      }
   ?>

</section>

<!-- update reviews section ends -->


<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>