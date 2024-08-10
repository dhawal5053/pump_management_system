<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .navbar{
            background-color: #02355A;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
        .nav-logo{
            height: 60px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
        .navbar-items{
            display: flex;
            align-items: center;
        }
        .nav-items{
            margin: 0 10px;
        }
        .nav-items a{
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .nav-items a:hover{
            /* background-color: #fff;
            color: #02355A;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1); */
            color: #ec22dc;

        }
        .nav-items.active{
            background-color: #fff;
            color: #02355A;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        }
        .nav-items.active a{
            color: #02355A;
        }
        .nav-items:last-child{
            margin-right: 0;
        }
        .welcome{
            color: #fff;
            margin-right: 20px;
        }
        .welcome span{
            font-weight: bold;
        }
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-icons a {
            color: #ffff;
            /* #3939eeb4; */
            font-size: 20px;
        }

        .nav-icons a:hover {
            color: #ec22dc;
        }
        .sub-menu-wrap{
                    position:absolute;
                    top: 19%;
                    right: 0%;
                    width: 320px;
                    max-height: 0px;
                    overflow: hidden;
                    transition: max-height 0.1s;
        }
        .sub-menu-wrap.open-menu{
                    max-height: 400px;
        }
        .sub-menu{
                    background: #02355A;
                    padding:20px;
                    margin: 10px;
                    text-align: right;
        }
        .sub-menu-link{
                    display: flex;
                    align-items: center;
                    text-decoration: none;
                    color: #525252;
                    margin: 12px 0;
        }
    </style>
</head>
<body>
    <div class="row1">
        <div class="navbar">
            <a href="index.php">
                <img src="Image/10/vala-industries-logo-1.png" alt="Vala industries logo" class="nav-logo">
            </a>
            <div class="navbar-items">
                <p class="nav-items"><a href="index.php">Home</a></p>
                <p class="nav-items"><a href="About-us.php">About us</a></p>
                <p class="nav-items"><a href="Our-category.php">Our Products</a></p>
                <p class="nav-items"><a href="contact_us.php">Contact us</a></p>
                <?php
                    if(isset($_SESSION['User-login'])){?>
                    <div class="nav-icons">
                        <div>
                            <?php
                            $count=0;
                            if(isset($_SESSION['cart']))
                            {
                            $count=count($_SESSION['cart']);
                            }
                            ?>
                            <a href="mycart1.php" > <i class="fa fa-shopping-cart"></i>(<?php echo $count ?>)</a>
                        </div>

                        <a href="#" onclick="toggleMenu()"><i class="fa fa-user"></i></a>
                
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                                <a href="update_profile_user.php" class="sub-menu-link">Update Profile</a>
                                <a href="my_order.php" class="sub-menu-link">My Orders</a>
                                <a href="logout.php" class="sub-menu-link">Logout</a>
                        </div>
                    </div>
                        <?php }
                    else{?>
                    <div class="nav-icons">
                        <div>
                            <?php
                            $count=0;
                            if(isset($_SESSION['cart']))
                            {
                            $count=count($_SESSION['cart']);
                            }
                            ?>
                            <a href="mycart1.php" > <i class="fa fa-shopping-cart"></i>(<?php echo $count ?>)</a>
                        </div>
                        <div class="sub-menu">
                        <a href="login.php" class="sub-menu-link">Login</a>
                        </div>
                        
                    </div>
                    <?php }  ?>
                
                
                <script>
                    let subMenu = document.getElementById("subMenu");
                    function toggleMenu() {
                        subMenu.classList.toggle("open-menu");
                    }
                </script>
                
            </div>
        </div>

    </div>

</body>
</html>
