<?php
include 'config.php';
// session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Category</title>
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <?php
    @include 'navbar.php';
    ?>
    <div class="About">
        <h1>Shop category wise</h1>
    </div>
    
    <section class="show-products">

    <!-- <h1 class="heading">products category added</h1> -->

    <div class="box-container">

        <?php
            $select = mysqli_query($conn,"SELECT * FROM product_category where status=1");
            $num = mysqli_num_rows($select);
            if($num>0){
            while($row = mysqli_fetch_assoc($select)){
        ?>
        <div class="box">
            <img src="uploadimage/<?php echo $row['img']; ?>" alt="">
            <div class="name"><a href="Our-product.php?id=<?php echo $row['product_cate_id'];?>"><?php echo $row['cate_name']; ?></a></div>
        </div>
        <?php
            }
        }else{
            echo '<p class="empty">no product category added yet!</p>';
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