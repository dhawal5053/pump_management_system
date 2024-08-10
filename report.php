<?php
include 'admin_header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
<section class="show-products">

   <h1 class="heading">REPORTS</h1>

   <div class="product-display">

         <table class="product-display-table">
            <thead>
               <tr>
                  <th>Report name</th>
                  <th colspan=4>Customization</th>
                  <!-- <th>Customization</th> -->
                  <th>Generate report</th>
               </tr>
            </thead>
            <tr>
               <form action="purchase_report.php" method="post">
                  <td>PURCHASE REPORT</td>
                  <td>
                     <label for="month" style="font-size: 2rem;">MONTH:</label>
                    <select id="month" name="month" style="height: 30px; width: 140px; background-color : #eee;">
                    <option value="" style="font-weight: bold; font-size: 20px;">SELECT MONTH</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                  </td>
                  <td>
                  <label for="year" style="font-size: 2rem;">YEAR:</label>
                    <select id="year" name="year" style="height: 30px; width: 140px; background-color : #eee;">
                    <option value="" style="font-weight: bold; font-size: 20px;">SELECT YEAR</option>
                <?php
                    $start_year = 2020; 
                    $end_year = date("Y"); 
                    for ($i = $start_year; $i <= $end_year; $i++) {
                    echo "<option value='".$i."'>".$i."</option>";
                    }
        ?>
    </select>
   </td>
   <td>
   <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" style="height: 30px; width: 140px; background-color : #eee;"><br/>
   </td>
   <td>
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" style="height: 30px; width: 140px; background-color : #eee;">

   </td>
   <td>        
      <button onclick="window.location.href = 'purchase_report.php';" name="submit" class="option-btn">Generate report</button>
   </td>
</form>
               </tr>
               <tr>
                   <form action="purchase_return_report.php" method="post">
                  <td>PURCHASE RETURN REPORT</td>
                  <td>
                   <label for="month" style="font-size: 2rem;">MONTH:</label>
                    <select id="month" name="month" style="height: 30px; width: 140px; background-color : #eee;">
                    <option value="" style="font-weight: bold; font-size: 20px;">SELECT MONTH</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                  </td>
                  <td>
                  <label for="year" style="font-size: 2rem;">YEAR:</label>
                    <select id="year" name="year" style="height: 30px; width: 140px; background-color : #eee;">
                    <option value="" style="font-weight: bold; font-size: 20px;">SELECT YEAR</option>
                <?php
                    $start_year = 2020; 
                    $end_year = date("Y"); 
                    for ($i = $start_year; $i <= $end_year; $i++) {
                    echo "<option value='".$i."'>".$i."</option>";
                    }
        ?>
    </select>
   </td>
   <td>
   <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" style="height: 30px; width: 140px; background-color : #eee;"><br/>
   </td>
   <td>
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" style="height: 30px; width: 140px; background-color : #eee;">

   </td>
   <td>        
      <button onclick="window.location.href = 'purchase_return_report.php';" name="submit" class="option-btn">Generate report</button>
   </td>
</form>
               </tr>
               <tr>
                   <form action="production_report.php" method="post">
                  <td>PRODUCTION REPORT</td>
                  <td>
                   <label for="month" style="font-size: 2rem;">MONTH:</label>
                    <select id="month" name="month" style="height: 30px; width: 140px; background-color : #eee;">
                    <option value="" style="font-weight: bold; font-size: 20px;">SELECT MONTH</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                  </td>
                  <td>
                  <label for="year" style="font-size: 2rem;">YEAR:</label>
                    <select id="year" name="year" style="height: 30px; width: 140px; background-color : #eee;">
                    <option value="" style="font-weight: bold; font-size: 20px;">SELECT YEAR</option>
                <?php
                    $start_year = 2020; 
                    $end_year = date("Y"); 
                    for ($i = $start_year; $i <= $end_year; $i++) {
                    echo "<option value='".$i."'>".$i."</option>";
                    }
        ?>
    </select>
   </td>
   <td>
   <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" style="height: 30px; width: 140px; background-color : #eee;"><br/>
   </td>
   <td>
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" style="height: 30px; width: 140px; background-color : #eee;">

   </td>
   <td>        
      <button onclick="window.location.href = 'production_report.php';" name="submit" class="option-btn">Generate report</button>
   </td>
</form>
               </tr>
               <tr>
                   <form action="sales_report.php" method="post">
                  <td>SALES REPORT</td>
                  <td>
                   <label for="month" style="font-size: 2rem;">MONTH:</label>
                    <select id="month" name="month" style="height: 30px; width: 140px; background-color : #eee;">
                    <option value="" style="font-weight: bold; font-size: 20px;">SELECT MONTH</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                  </td>
                  <td>
                  <label for="year" style="font-size: 2rem;">YEAR:</label>
                    <select id="year" name="year" style="height: 30px; width: 140px; background-color : #eee;">
                    <option value="" style="font-weight: bold; font-size: 20px;">SELECT YEAR</option>
                <?php
                    $start_year = 2020; 
                    $end_year = date("Y"); 
                    for ($i = $start_year; $i <= $end_year; $i++) {
                    echo "<option value='".$i."'>".$i."</option>";
                    }
        ?>
    </select>
   </td>
   <td>
   <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" style="height: 30px; width: 140px; background-color : #eee;"><br/>
   </td>
   <td>
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" style="height: 30px; width: 140px; background-color : #eee;">

   </td>
   <td>        
      <button onclick="window.location.href = 'sales_report.php';" name="submit" class="option-btn">Generate report</button>
   </td>
</form>
               </tr>
               <tr>
                      <form action="feedback_rating_report.php" method="post">
                     <td>FEEDBACK & RATING REPORT</td>
                     <td>----</td>
                     <td>----</td>
                     <td>----</td>
                     <td>----</td>
                     <td>        
                        <button onclick="window.location.href = 'feedback_rating_report.php';" name="submit" class="option-btn">Generate report</button>
                     </td>
                  </form>
               </tr>   
               <tr>
                   <form action="rawmaterial_report.php" method="post">
                  <td>RAWMATERIAL REPORT</td>
                  <td>
                   <label style="font-size: 2rem;">SUPPLIER:</label>
                   <select name="supplier_id" id="" style="height: 30px; width: 150px; background-color : #eee;">
               <option value="" style="font-weight: bold; font-size: 20px;">SELECT SUPPLIER</option>
               <?php
               $res=mysqli_query($conn,"select supplier_id,supplier_name from supplier order by supplier_name desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['supplier_id'].">".$row['supplier_name']."</option>";
                  }
               ?>
            </select>
                  </td>
                  <td>----</td>
                  <td>----</td>
                  <td>----</td>
   <td>        
      <button onclick="window.location.href = 'rawmaterial_report.php';" name="submit" class="option-btn">Generate report</button>
   </td>
</form>
               </tr>  
               <tr>
                   <form action="product_report.php" method="post">
                  <td>PRODUCT REPORT</td>
                  <td>
                   <label style="font-size: 2rem;">PRODUCT CATEGORY:</label>
                   <select name="cate_id" id="" style="height: 30px; width: 150px; background-color : #eee;">
               <option value="" style="font-weight: bold; font-size: 20px;">SELECT CATEGORY</option>
               <?php
               $res=mysqli_query($conn,"select product_cate_id,cate_name from product_category order by cate_name desc");
                  while($row=mysqli_fetch_assoc($res)){
                     echo "<option value=".$row['product_cate_id'].">".$row['cate_name']."</option>";
                  }
                  ?>
            </select>
                  </td>
                  <td>----</td>
                  <td>----</td>
                  <td>----</td>
                  <td>        
                     <button onclick="window.location.href = 'product_report.php';" name="submit" class="option-btn">Generate report</button>
                  </td>
               </form>
            </tr>
            <tr>
              <td>CUSTOMER REPORT</td>
              <td>----</td>
              <td>----</td>
              <td>----</td>
              <td>----</td>
                <td>                    
                   <a href="customer_report.php"class="option-btn">Generate report</a>                   
                  </td>
            </tr>
            <tr>
               <td>AREA REPORT</td>
               <td>----</td>
               <td>----</td>
               <td>----</td>
               <td>----</td>
                 <td>                    
                  <a href="area_report.php"class="option-btn">Generate report</a>                   
               </td>
             </tr>
            </table>
         </div>
      </section>
      
      <script src="admin_script.js"></script>
</body>
</html>
