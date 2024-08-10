<?php
include 'config.php';
session_start();
$error ="";
$id=$_SESSION['User'];

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
         $success_msg[] = 'User Password & data successfully changed';
      }
   }
   else{
      $success_msg[] = 'User Data successfully changed';
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update profile</title>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
    <?php
      $select = mysqli_query($conn,"SELECT * FROM user where user_id=$id");
      if(mysqli_num_rows($select) > 0){
         $fetch=mysqli_fetch_assoc($select);
      }
      ?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">
                <img src="Image/10/about-1.png" style="width: 115%; height:100%;">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Update Profile</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="fname" value="<?php echo $fetch['fname'];?>" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="lname" value="<?php  echo $fetch['lname'];?>" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="<?php  echo $fetch['email'];?>" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="number" maxlength=10 value="<?php  echo $fetch['mob_no'];?>" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Mobile Number" required pattern="[0-9]{5}[0-9]{5}">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="old_pass" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Enter old password">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="prev_pass" value="<?php echo $fetch['password'];?>">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="new_pass" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="New password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="confirm_pass" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Confirm password">
                                    </div>
                                </div>
                                <input type="submit" name="submit" value="Update Now" class="btn btn-primary btn-user btn-block">
                                <a href="index.php" class="btn btn-primary btn-user btn-block">Go Back</a>
                                <!-- <a href="login.php" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a> -->
                                <hr>
                            </form>
                            <hr>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>