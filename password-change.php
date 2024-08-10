<?php
include 'config.php';
$error="";
try{
    if(isset($_POST['submit'])){
        $email=$_POST["email"];
        $password=$_POST["password"];
        $cpassword=$_POST["cpassowrd"];
        $check_mail="SELECT * FROM user WHERE email='$email'";
        $run = mysqli_query($conn, $check_mail);
        if ($run) {
            $row = mysqli_fetch_array($run);
            if ($row) {
                $demail = $row['email'];
                if ($email == $demail) {
                    if($password == $cpassword){
                        $sql="UPDATE `user` SET `password`='$password' WHERE email='$email'";
                        $result=mysqli_query($conn,$sql);
                        if(!$result){
                            $warning_msg[] = "Data not inserted";
                        }
                        else{
                            header("location: login.php");
                        }
                    }
                    else{
                        $warning_msg[] = "Password do not match";
                    }
                } else {
                    $warning_msg[] = "Email do not match";
                }
            } else {
                $warning_msg[] = "Email not found in the database";
            }
        } else {
            $warning_msg[] = "Error executing query: " . mysqli_error($conn);
        }
    }
}catch(Exception $e){
    $e= "found";
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

    <title>Forgot Password</title>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image">
                            <img src="Image/10/about-1.png" style="width: 100%; height:100%;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Change Your Password?</h1>
                                        <p class="mb-4">Just enter your email address, New password and confirm password below
                                        </p>
                                    </div>
                                    <form action="password-change.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter New password...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="cpassowrd" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Confirm password...">
                                        </div>
                                        <input type="submit" name="submit" value="Update password" class="btn btn-primary btn-user btn-block">

                                        <!-- <a href="login.php" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </a> -->
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
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

        </div>

    </div>

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alers.php'; ?>

</body>

</html>