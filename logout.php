<?php
include 'config.php';
session_start();

if(isset($_SESSION['Admin-login']) && $_SESSION['Admin-login']!=''){
    unset($_SESSION['Admin-login']);
    unset($_SESSION['Admin-name']);
    unset($_SESSION['Admin']);
    
    header("location: index.php");
    die();
}
else{
    $user=$_SESSION['User'];
    $sql = mysqli_query($conn, "DELETE FROM `cart` WHERE user_id=$user");
    unset($_SESSION['User-login']);
    unset($_SESSION['User-name']);
    unset($_SESSION['User']);
    unset($_SESSION['cart']);
    
    header('location: index.php');
    die();
}

?>