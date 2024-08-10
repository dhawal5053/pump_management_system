<?php
// session_start();
include 'config.php';

$id = $_GET['id'];
$select1 = mysqli_query($conn,"SELECT * FROM product_category where product_cate_id=$id");
$num = mysqli_num_rows($select1);
$row1= mysqli_fetch_assoc($select1);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $row1['cate_name']; ?></title>
        <style>
            .About{
                background: url('image/11/services-banner-1.png');
                height: 350px;
            } 
            .About h1{
                padding: 175px;
                color: #f5f5f5;
                font-size: 70px;
            }  
            </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">


</head>
<body>
<?php include 'navbar.php';?>
    
    <div class="About">
        <h1>Our product</h1>
    </div>
    
    <section class="show-products">
        
        <!-- <h1 class="heading">products added</h1> -->
        
   <div class="box-container">

   <?php
        $select = mysqli_query($conn,"SELECT * FROM product where product_cate_id=$id and status=1");
        $num = mysqli_num_rows($select);
        if($num>0){
            while($row = mysqli_fetch_assoc($select)){ 
   ?>
   <div class="box">
        <form action="manage_cart1.php" method="POST">
        <a href="quick_view.php?pid=<?= $row['product_id']; ?>" class="fa fa-eye" style="font-size:15px; color:#000000"></a>
            <img src="uploadimage/<?php echo $row['img']; ?>" alt="">
            <div class="name"><?php echo $row['product_name']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="10" value="1" style="width: 50px; padding: 5px; border: 5px solid #ccc; border-radius: 3px;">
            <div class="price">₹<span><?php echo $row['price']; ?></span>/-</div>
            <!-- <p class="total-reviews"><i class="fas fa-star"></i> <span><?= $total_reviews; ?></span></p> -->
            <a href="view_review.php?get_id=<?= $row['product_id']; ?>" class="btn btn-primary">view reviews</a>
    <?php   if( $row['QOH'] >= 1 ){ ?>
                <button type="submit" name="Add_To_Cart" class="btn btn-primary">Add To Cart</button>
    <?php   }
            else{?>
                <h3 class="delete-btn">This item not in stock</h3>
    <?php   }?>
            <input type="hidden" name="product_id" value='<?php echo $row['product_id']; ?>'>
            <input type="hidden" name="product_name" value='<?php echo $row['product_name']; ?>'>
            <input type="hidden" name="price" value='<?php echo $row['price']; ?>'>
        </form>
   </div>

   <!-- <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3">
                <form action="manage_cart.php" method="POST">
                    <div class="card">
                        <img src="about-us-banner-1-1.png" class="card-img-top">
                            <div class="card-body text-center">
                                <h5 class="card-title">bag 1</h5>
                                <p class="card-text">Price: Rs.450</p>
                                <button type="submit" name="Add_To_Cart" class="btn btn-primary">Add To Cart</a>
                                <input type="hidden" name="Item_Name" value="bag 1">
                                <input type="hidden" name="Price" value="450">
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

   <?php
         }
      }else{
         echo '<p class="empty">no product added yet!</p>';
      }
   ?>
   
   </div>

    </section>
   
    <!-- footer start -->
    <?php
    include 'footer.php';
    ?>
    <!-- footer end -->
</body>
</html>