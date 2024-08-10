<?php
include 'config.php';
include 'navbar.php';
if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:Our-category.php');
}

if(isset($_POST['submit'])){

   if(isset($_SESSION['User-login'])){
      $user_id=$_SESSION['User'];
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $description = $_POST['description'];
      $description = filter_var($description, FILTER_SANITIZE_STRING);
      $rating = $_POST['rating'];
      $rating = filter_var($rating, FILTER_SANITIZE_STRING);

      $verify_review = mysqli_query($conn,"SELECT * FROM `feedback_rating` WHERE product_id = '$get_id' AND user_id = '$user_id'");
      $num = mysqli_num_rows($verify_review);
      if($num>0){
         $warning_msg[] = 'Your review already added!';
      }else{
         $add_review = mysqli_query($conn,"INSERT INTO `feedback_rating`(`user_id`, `product_id`, `star`, `feedback_titles`, `f_comments`) VALUES ('$user_id','$user_id','$rating','$title','$description')");
         $success_msg[] = 'Review added!';
      }
   }else{
      $warning_msg[] = 'Please login first!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add review</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/s2.css">

</head>
<body>
   
<!-- header section starts  -->
<?php  ?>
<!-- header section ends -->

<!-- add review section starts  -->

<section class="account-form">

   <form action="" method="post">
      <h3>post your review</h3>
      <p class="placeholder">review title <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="enter review title" class="box">
      <p class="placeholder">review description</p>
      <textarea name="description" class="box" placeholder="enter review description" maxlength="1000" cols="30" rows="10"></textarea>
      <p class="placeholder">review rating <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="submit review" name="submit" class="btn">
      <a href="view_review.php?get_id=<?= $get_id; ?>" class="option-btn">go back</a>
   </form>

</section>

<!-- add review section ends -->














<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>