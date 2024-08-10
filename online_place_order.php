<?php
session_start();
include 'config.php';
require_once('razorpay-php/Razorpay.php');

use Razorpay\Api\Api;

$api_key = 'rzp_test_BNeQfjpoCpfENi';
$api_secret = 'CGbRlL0ULbjyrhftGSOlkBR7';

$api = new Api($api_key, $api_secret);

if(isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];
    $sale_date=$_SESSION['s_date'];
    $payment_date=$_SESSION['p_date'];
    $pay_mode=$_SESSION['mode'];
    $total = $_SESSION['total'];
    $address = $_SESSION['address'];
    $product_ids = $_SESSION['product_ids'];
    $qtys = $_SESSION['qtys'];
    $user_id=$_SESSION['User'];

    if(isset($_POST['razorpay_payment_id'])) {
        $payment_id = $_POST['razorpay_payment_id'];
        $signature = $_POST['razorpay_signature'];

        try {
            $payment = $api->payment->fetch($payment_id);

            $attributes = array(
                'razorpay_order_id' => $order_id,
                'razorpay_payment_id' => $payment_id,
                'razorpay_signature' => $signature
            );

            $api->utility->verifyPaymentSignature($attributes);
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
            if($query_run==true and $fire==true){
                mysqli_query($conn,"DELETE FROM cart WHERE user_id= '$user_id'");
                unset($_SESSION['order_id']);
                unset($_SESSION['total']);
                unset($_SESSION['address']);
                unset($_SESSION['product_ids']);
                unset($_SESSION['s_date']);
                unset($_SESSION['p_date']);
                unset($_SESSION['mode']);
                echo "<script>
                    alert('Payment successful');
                    window.location.href='mycart1.php';
                    </script>";
                    unset($_SESSION['cart']);
            } else {
                echo "<script>
                    alert('Payment failed');
                    window.location.href='mycart1.php';
                    </script>";
            }
        } catch(Exception $e) {
            echo "<script>
                alert('Error: ".$e->getMessage()."');
                window.location.href='mycart1.php';
                </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Place order online</title>
</head>
<body>
    <form method="POST" action="">
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo $api_key; ?>"
            data-amount="<?php echo $total * 100; ?>"
            data-currency="INR"
            data-order_id="<?php echo $order_id; ?>"
            data-name="VALA INDUSTRIES"
            data-description="Payment for order <?php echo $order_id; ?>"
            data-image="image/10/vala-industries-logo-1.png"
            data-theme.color="#02355A"
        ></script>
        <style>
    .razorpay-payment-button {
        display: none;
    }
    </style>
        <div class="content">
         <button>
        <h4>Place&nbsp;&nbsp;order</h4>
        <h4>Place&nbsp;&nbsp;order</h4>
        </button>
        </div>
    </form>
    <style>
  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
  }
  body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: default;
  }
  .content {
      position: relative;
      margin-top: -100px;
  }
  .content h4 {
      position: absolute;
      transform: translate(-50%, -50%);
      font-size: 3.5rem;
  }
  .content h4:nth-child(1) {
      color: transparent;
      -webkit-text-stroke: 2px #0277bd;
  }
  .content h4:nth-child(2) {
      color: #0277bd;
      animation: animate 2s ease-in-out infinite;
  }
  @keyframes animate {
      0%,
      100% {
          clip-path: polygon(0% 45%, 15% 44%, 32% 50%, 54% 60%, 70% 61%, 84% 59%, 100% 52%, 100% 100%, 0% 100%);
      }
      50% {
          clip-path: polygon(0% 60%, 16% 65%, 34% 66%, 51% 62%, 67% 50%, 84% 45%, 100% 46%, 100% 100%, 0% 100%);
      }
  }
  @media(max-width: 768px) {
      .content h2 {
          font-size: 3em;
      }
  }
  button {
      background-color: transparent;
      border: 5px solid #0277bd;
      border-radius: 5px;
      color: #fff;
      font-weight: bold;
      padding: 27px 165px;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
  }
  button:hover {
      background-color: transparent;
      transform: scale(1.1);
  }
  button:focus {
      outline: none;
  }
  button:active {
      transform: scale(0.9);
  }
  @keyframes zoom-in-out {
      0% {
          transform: scale(1);
      }
      50% {
          transform: scale(1.2);
      }
      100% {
          transform: scale(1);
      }
  }
  @media (prefers-reduced-motion: no-preference) {
      button:hover {
          animation: zoom-in-out 1s ease-in-out infinite;
      }
  }
</style>  
</body>
</html>
