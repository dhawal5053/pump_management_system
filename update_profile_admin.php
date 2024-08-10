<?php
include 'config.php'; 
include 'admin_header.php';
$id = $_SESSION['Admin'];
if(isset($_POST['submit'])){
   $update_fname=$_POST['fname'];
   $update_lname=$_POST['lname'];
   $update_email=$_POST['email'];
   $update_number=$_POST['number'];

   mysqli_query($conn,"UPDATE user SET fname = '$update_fname', lname = '$update_lname', email = '$update_email', mob_no = '$update_number' WHERE user_id = $id");

   $old_pass=$_POST['prev_pass'];
   $update_pass=$_POST['old_pass'];
   $new_pass=$_POST['new_pass'];
   $cnf_pass=$_POST['confirm_pass'];

   if(!empty($update_pass) || !empty($new_pass) || !empty($cnf_pass)){
      if($update_pass != $old_pass){
         $warning_msg[] = 'Old password not matched';
      }elseif($new_pass != $cnf_pass){
         $warning_msg[] = 'Password and confirm password not matched';
      }
      else{
         mysqli_query($conn,"UPDATE user SET password = '$cnf_pass' WHERE user_id = $id");
         $success_msg[] = 'Password successfully changed';
      }
   }
   else{
      $success_msg[] = 'data successfully changed';
   }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update profile</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
  
<section class="form-container">
<?php
$select = mysqli_query($conn,"SELECT * FROM user WHERE user_id = '$id' ");
if(mysqli_num_rows($select) > 0){
   $fetch=mysqli_fetch_assoc($select);
}
?>
   <form action="" method="post">
      <h3>update profile</h3>
      <input type="hidden" name="prev_pass" value="<?php echo $fetch['password'];?>">
      <input type="text" name="fname" value="<?php echo $fetch['fname'];?>" placeholder="Enter your first name" class="box">
      <input type="text" name="lname" value="<?php  echo $fetch['lname'];?>" placeholder="Enter your last name" class="box">
      <input type="email" name="email" value="<?php  echo $fetch['email'];?>" placeholder="Enter your email" class="box">
      <input type="tel" name="number" value="<?php  echo $fetch['mob_no'];?>" placeholder="Enter your mobile number" class="box" pattern="[0-9]{5}[0-9]{5}">
      <input type="password" name="old_pass" placeholder="Enter old password" class="box" >
      <input type="password" name="new_pass" placeholder="Enter new password" class="box">
      <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">
      <input type="submit" value="update now" class="btn" name="submit">
      <a href="dashboard.php" class="option-btn">go back</a>
   </form>

</section>

<script src="admin_script.js"></script>
   
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>