<?php
include 'config.php'; 
include 'admin_header.php';
try{
if(isset($_POST['submit'])){
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];
    $password=$_POST["pass"];
    $cpassword=$_POST["confirm_pass"];
    $mobile=$_POST["number"];
    $is_admin = 1;
    if($password == $cpassword){
       $sql="INSERT INTO user (Is_Admin,fname,lname,email,password,mob_no)VALUES('$is_admin','$fname','$lname','$email','$password','$mobile')";
       $result=mysqli_query($conn,$sql);
       if($result){
           $success_msg[]= "New admin added successfully";
         }
    else{
            $error_msg[]= "New admin can not be registered";  
        }
    }
    else{
        $warning_msg[]= "Password does not match";
    }
 }
}
catch(Exception $e){
    $warning_msg[]= "Email already exist";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="form-container">
   <form action="" method="post">
      <h3>Register admin</h3>
      <input type="text" name="fname" placeholder="Enter first name" class="box" required>
      <input type="text" name="lname" placeholder="Enter last name" class="box" required>
      <input type="email" name="email" placeholder="Enter email" class="box" required>
      <input type="tel" name="number" placeholder="Enter mobile number" class="box" required pattern="[0-9]{5}[0-9]{5}">
      <input type="password" name="pass" placeholder="Enter password" class="box" required>
      <input type="password" name="confirm_pass" placeholder="Confirm password" class="box" required>
      <input type="submit" value="register now" class="btn" name="submit">
      <a href="admins_accounts.php" class="option-btn">go back</a>
   </form>

</section>

<script src="admin_script.js"></script>
   
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>