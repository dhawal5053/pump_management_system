<?php

  session_start();
  $con=mysqli_connect("localhost","root","","test");

  if(mysqli_connect_error()){
    echo"<script>
    alert('cannot connect to database');
    window.location.href='mycart1.php';
    </script>";
    exit();
  }

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if(isset($_POST['purchase']))
    {
      $query1="INSERT INTO `order_manager`(`full_name`, `phone_no`, `address`, `pay_mode`) VALUES ('$_POST[full_name]','$_POST[phone_no]','$_POST[address]','$_POST[pay_mode]')";
      if(mysqli_query($con,$query1))
      {
        $order_id=mysqli_insert_id($con);
        $query2="INSERT INTO `user_orders`(`order_id`, `item_name`, `price`, `quantity`) VALUES (?,?,?,?)";
        $stmt=mysqli_prepare($con,$query2);
        if($stmt){
          mysqli_stmt_bind_param($stmt,"isii",$order_id,$item_name,$price,$quantity);
          foreach($_SESSION['cart'] as $key => $values) {
            $item_name=$values['product_name'];
            $price=$values['price'];
            $quantity=$values['Quantity'];
            mysqli_stmt_execute($stmt);
          }
          unset($_SESSION['cart']);
          echo"<script>
          alert('order placed');
          window.location.href='Our-category.php';
          </script>";
        }else{
          echo "<script>
          alert('SQL Error);
          window.location.href='mycart1.php';
          </script>";
          }
      }
      else {
        echo "<script>
        alert('SQL Error);
        window.location.href='mycart1.php';
        </script>";
      }
    }
  }
  
?>