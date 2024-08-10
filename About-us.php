<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .About{
            background: url('image/11/about-us-banner-1-1.png');
            height: 350px;
        }

        .About h1{
            padding: 175px;
            color: #f5f5f5;
            font-size: 70px;
        }
        .About2{
            padding: 50px;
            font-size: 25px;
            text-align: justify;
        }
        .About3{
            height: 400px;
            background-color: #02355A;
            padding: 30px;
            text-align: justify;
            color: #f5f5f5;
            display: flex;
            justify-content: space-between;
            margin: 2px;
        }
        .A3c1{
            width: 400px;
        }
        .A3c2{
            width: 350px;
            height: 450px;
            background-color: #f5f5f5;
            margin-top: 10px;
            color: #000000;
            border-radius: 30px;
        }
        .A3r21{
            display: flex;
            align-items: center;
            padding: 40px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <?php
    @include 'navbar.php';
    ?>
    <div class="About">
        <h1>About Us</h1>
    </div>
    <div class="About2">
        <p>Being at the forefront of the Indian pump industry, we at Vala Industries, manufacture and supply the most high-quality pumps, ranging through various industrial sectors. Our products are revered for their finesse and integrity which has been honed by our expert engineers.</p>
        <p>Our products are also backed by our unflinching warranty and support which provides our clients, not only premium quality but also world-class service. Our products are highly durable and made with superior quality raw materials that can stand the toughest tests.</p>
    </div>
    <div class="About3">
        <div class="A3c1">
            <h3>Vala Industries</h3>
            <h1>Why Choose Us?</h1>
            <p>Being at the forefront of the Indian pump industry, we, at Vala Industries, manufacture and supply the most high-quality pumps, ranging through various industrial sectors. Our products are revered for their finesse and integrity which has been honed by our expert engineers.</p>
        </div>
        <div class="A3c2">
            <div class="A3r21">
                <img src="image/11/solution-icon-1.png" alt="Truck">
                <p>Timely Delivery</p>
            </div>
            <div class="A3r21">
                <img src="image/11/product-1.png" alt="Motor">
                <p>100s of Products</p>
            </div>
            <div class="A3r21">
                <img src="image/11/solution-icon-3.png" alt="Payment">
                <p>Secure Payment</p>
            </div>
        </div>
    </div>
    <br><br><br>
    <!-- footer start -->
    <?php
    @include 'footer.php';
    ?>
    <!-- footer end -->
</body>
</html>