<?php
include 'config.php';
session_start();
if(isset($_SESSION['User-login']) && $_SESSION['User-login']!=''){
    $user_name=$_SESSION['User-name'];
    $user_id=$_SESSION['User'];
    $qty=$_POST['qty'];
    $product_id=$_POST['product_id'];
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(isset($_POST['Add_To_Cart']))
        {
            if(isset($_SESSION['cart']))
            {
                $myitems=array_column($_SESSION['cart'],'product_name');
                if(in_array($_POST['product_name'],$myitems))
                {
                    foreach($_SESSION['cart'] as $key => $value)
                    {
                        if($value['product_name']==$_POST['product_name'])
                        {
                            $qty=$_SESSION['cart'][$key]['Quantity']+$_POST['qty'];
                            $_SESSION['cart'][$key]['Quantity']+=$_POST['qty'];
                            $sql = mysqli_query($conn, "UPDATE `cart` SET `QTY`=$qty WHERE product_id=$product_id");
                            if($sql){
                                echo"<script>
                                alert('Item quantity updated');
                                window.location.href='Our-category.php';
                                </script>";
                            }
                        }
                    }
                }
                else
                {
                    $count=count($_SESSION['cart']);
                    $_SESSION['cart'][$count]=array('product_id'=>$_POST['product_id'],'product_name'=>$_POST['product_name'],'price'=>$_POST['price'],'Quantity'=>$_POST['qty']);
                    $sql = mysqli_query($conn, "INSERT INTO `cart`(`QTY`, `product_id`, `user_id`) VALUES ($qty,$product_id,$user_id)");
                    if($sql){
                        echo"<script>
                        alert('Item Added');
                        window.location.href='Our-category.php';
                        </script>";
                    }
                }
            }
            else
            {
                $_SESSION['cart'][0]=array('product_id'=>$_POST['product_id'],'product_name'=>$_POST['product_name'],'price'=>$_POST['price'],'Quantity'=>$_POST['qty']);
                $sql = mysqli_query($conn, "INSERT INTO `cart`(`QTY`, `product_id`, `user_id`) VALUES ('$qty','$product_id','$user_id')");
                if($sql){
                    echo"<script>
                    alert('Item Added');
                    window.location.href='Our-category.php';
                    </script>";
                }
            }
        }
    }
}
else{
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['Add_To_Cart'])){
            if(isset($_SESSION['cart'])){
                $myitems=array_column($_SESSION['cart'],'product_name');
                if(in_array($_POST['product_name'],$myitems)){
                    foreach($_SESSION['cart'] as $key => $value){
                        if($value['product_name']==$_POST['product_name']){
                            $_SESSION['cart'][$key]['Quantity']+=$_POST['qty'];
                            echo"<script>
                            alert('Item quantity updated');
                            window.location.href='Our-category.php';
                            </script>";
                        }
                    }
                }
                else{
                    $count=count($_SESSION['cart']);
                    $_SESSION['cart'][$count]=array('product_id'=>$_POST['product_id'],'product_name'=>$_POST['product_name'],'price'=>$_POST['price'],'Quantity'=>$_POST['qty']);
                    echo"<script>
                    alert('Item Added');
                    window.location.href='Our-category.php';
                    </script>";
                }
            }
            else{
                $_SESSION['cart'][0]=array('product_id'=>$_POST['product_id'],'product_name'=>$_POST['product_name'],'price'=>$_POST['price'],'Quantity'=>$_POST['qty']);
                echo"<script>
                alert('Item Added');
                window.location.href='Our-category.php';
                </script>";
            }
        }      
    }
}
?>