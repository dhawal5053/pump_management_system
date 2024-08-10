<?php 
include 'config.php';
$tota = "";
if(isset($_SESSION['User-login']) && $_SESSION['User-login']!=''){
    if(isset($_POST['Remove_Item'])){
        $product_id=$_POST['product_id'];
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['product_name']==$_POST['product_name'])
            {
                $sql = mysqli_query($conn, "DELETE FROM `cart` WHERE product_id=$product_id");
                unset($_SESSION['cart'][$key]);
                $_SERVER['cart']=array_values($_SESSION['cart']);
                if($sql){
                    echo"<script>
                    alert('Item Removed');
                    window.location.href='mycart1.php';
                    </script>";
                }
            }
        }
    }
    if(isset($_POST['Mod_Quantity'])){
        $product_id=$_POST['product_id'];
        $qty=$_POST['Mod_Quantity'];
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['product_name']==$_POST['product_name'])
            {
                $sql = mysqli_query($conn, "UPDATE `cart` SET `QTY`=$qty WHERE product_id=$product_id");
                $_SESSION['cart'][$key]['Quantity']=$_POST['Mod_Quantity'];
                if($sql){
                    echo"<script>
                    window.location.href='mycart1.php';
                    </script>";
                }
            }
        }
    }
}
else{
    if(isset($_POST['Remove_Item'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['product_name']==$_POST['product_name']){
                unset($_SESSION['cart'][$key]);
                $_SERVER['cart']=array_values($_SESSION['cart']);
                echo"<script>
                alert('Item Removed');
                window.location.href='mycart1.php';
                </script>";
            }
        }
    }
    if(isset($_POST['Mod_Quantity'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['product_name']==$_POST['product_name']){
                $_SESSION['cart'][$key]['Quantity']=$_POST['Mod_Quantity'];
                echo"<script>
                window.location.href='mycart1.php';
                </script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <!-- <link rel="stylesheet" href="css/s1.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<?php include 'navbar.php';?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border rounded bg-light my-5">
                <h1>My Cart</h1>
            </div>
            <div class="col-lg-9">
            
                <table class="table">
                    <thead class="text-center">
                        <tr>
                        <th scope="col">Serial No.</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php 
                           if(isset($_SESSION['cart']))
                           {
                                $tota=0;
                                foreach($_SESSION['cart'] as $key => $value)
                                {  
                                  $pro = $value['price']*$value['Quantity'];
                                  $tota = $tota + $pro;
                                    $sr=$key+1;
                                    echo"
                                    <tr>
                                        <td>$sr</td>
                                        <td>$value[product_name]</td>
                                        <td>$value[price]</td>
                                        <td>
                                            <form action='mycart1.php' method='POST'>
                                                <input type='number' class='text-center iquantity' name='Mod_Quantity' onchange='this.form.submit();' value='$value[Quantity]' min='1' max='10'>
                                                <input type='hidden' name='product_name' value='$value[product_name]'>
                                                <input type='hidden' name='product_id' value='$value[product_id]'>  
                                                <input type='hidden' class=iprice value='$value[price]'>
                                            </form>
                                        </td>
                                        <td class='itotal'></td>
                                        <td>
                                        <form action='mycart1.php' method='POST'>
                                        <button name='Remove_Item' class='btn btn-sm btn-outline-danger'>REMOVE</button>
                                        <input type='hidden' name='product_name' value='$value[product_name]'>
                                        <input type='hidden' name='product_id' value='$value[product_id]'>
                                        </form>
                                        </td>
                                    </tr>
                                    ";
                                }
                           }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
    if(isset($_SESSION['cart'])) {
?>
    <div class="container mt-5">
        <button id="mbtn" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#myModal">Buy Now</button>
<?php 
    } else {
        echo '<p style="background-color: #f8d7da; color: #721c24; padding: 10px; width: 74%;">Please select an item</p>';
    }
?>
            <div id='myModal' class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order now</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="place_order.php" method="POST">
                    <div class="modal-body">
                        <p>Select a payment method</p>
                        <input class="form-check-input" type="radio" name="pay_mode" id="flexRadioDefault1" value="COD" required />
                        <label class="form-check-label" for="flexRadioDefault1">
                            Cash On Delivery
                        </label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="pay_mode" id="flexRadioDefault2" value="ONLINE" required />
                        <label class="form-check-label" for="flexRadioDefault2">
                            Pay with UPI/Debit/Credit/ATM Cards
                        </label>
                    </div>
                    <hr>
                    <hr>
                    <div class="body">
                    <p><b>Shipping To:<textarea style="height: 20%; width: 100%; resize:none;" name="s_address" required></textarea></b></p>
                    <?php 
                           if(isset($_SESSION['cart']))
                           {
                                foreach($_SESSION['cart'] as $key => $value)
                                {?>
                                <br>
                                <input type='hidden' name='product_id[]' value=<?php echo $value['product_id']; ?>>
                                <input type='hidden' name='qty[]' value=<?php echo $value['Quantity']; ?>>
                    Product Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?php echo $value['product_name'] ?></label>
                    <br>
                    Product Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?php echo $value['price'] ?></label>
                    <br>
                    Quantity:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?php echo $value['Quantity'] ?></label>
                    <br>
                       <?php         }
                            }
                     ?>  
                     <br>  
                    <h6>Grand Total:<h6>
                    <input type="hidden" name="tota" id="flexRadioDefault1"  value=<?php echo $tota; ?> />
                    <h5 class="text-right"><?php echo $tota; ?></h5>
                    <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="place-order">Place Your Order</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        </div>
    </div>
    <script>
    var gt=0;        
    var iprice=document.getElementsByClassName('iprice');
    var iquantity=document.getElementsByClassName('iquantity');
    var itotal=document.getElementsByClassName('itotal');
    var gtotal=document.getElementById('gtotal');
        
        function subTotal() 
        {
            gt=0;
            for(i=0;i<iprice.length;i++)
            {
                itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);

                gt=gt+(iprice[i].value)*(iquantity[i].value);
            }
            gtotal.innerText=gt;
        }
        subTotal();
    </script>
</body>
</html>