<?php
session_start();
include 'config.php';
require_once('razorpay-php/Razorpay.php');

use Razorpay\Api\Api;

$api_key = 'rzp_test_BNeQfjpoCpfENi';
$api_secret = 'CGbRlL0ULbjyrhftGSOlkBR7';

if(isset($_SESSION['User-login']) && $_SESSION['User-login']!=''){
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    if(isset($_POST['place-order'])){
    $payment_method = $_POST['pay_mode'];
        if($payment_method == 'COD'){
    {   
        $sale_date= date("Y-m-d");
        $payment_date= "";
        $pay_mode = $_POST['pay_mode'];
        $user_id=$_SESSION['User'];
        $total=$_POST['tota'];
        $address=$_POST['s_address'];
        $product_ids=$_POST['product_id'];
        $qtys=$_POST['qty'];
    
        $query="INSERT INTO sales(sale_date,total_amt,payment_date,d_address,payment_type,user_id) VALUES ('$sale_date','$total','$payment_date','$address','$pay_mode','$user_id')";
        $query_run= mysqli_query($conn,$query);
        $check1=mysqli_query($conn,"SELECT * FROM sales WHERE sales_id NOT IN (SELECT sales_sales_id FROM sales_details)");
        $fetch1=mysqli_fetch_assoc($check1);
        $sid=$fetch1['sales_id'];
        foreach($product_ids as $key => $product_id){
        $qty = $qtys[$key];
        $upload = "INSERT INTO sales_details(sales_sales_id,product_product_id,QTY)VALUES('$sid','$product_id','$qty')";
        $fire = mysqli_query($conn,$upload);
        mysqli_query($conn,"UPDATE product SET QOH=QOH - '$qty' WHERE product_id='$product_id'");
        }
        if($query_run==true and $fire==true)
        {
        echo "<script>
        alert('Your order is placed');
        window.location.href='mycart1.php';
        </script>";
        unset($_SESSION['cart']);
        }
    }
}
else
{
    if($payment_method == 'ONLINE') {
        $api = new Api($api_key, $api_secret);
        $sale_date= date("Y-m-d");
        $payment_date= date("Y-m-d");
        $pay_mode = $_POST['pay_mode'];
        $user_id=$_SESSION['User'];
        $total = $_POST['tota'];
        $address = $_POST['s_address'];
        $product_ids = $_POST['product_id'];
        $qtys = $_POST['qty'];

        $order = $api->order->create(array(
            'amount' => $total * 100, // amount in paise
            'currency' => 'INR',
            'payment_capture' => 1
        ));

        $order_id = $order['id'];

            $_SESSION['order_id'] = $order_id;
            $_SESSION['s_date'] = $sale_date;
            $_SESSION['p_date'] = $payment_date;
            $_SESSION['mode'] = $pay_mode;
            $_SESSION['total'] = $total;
            $_SESSION['address'] = $address;
            $_SESSION['product_ids'] = $product_ids;
            $_SESSION['qtys'] = $qtys;
            header("Location: online_place_order.php");
            
        }
      
    }
}
}
}
else{
    echo "<script>
    alert('Please login to buy the product');
    window.location.href='login.php';
    </script>";
}
?>