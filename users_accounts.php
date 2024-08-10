<?php
include 'config.php';
include 'admin_header.php';

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn,"DELETE FROM user WHERE user_id = $delete_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<section class="show-products">

   <h1 class="heading">user accounts</h1>
   <div class="product-display">

<?php
   $select = mysqli_query($conn,"SELECT * FROM user WHERE Is_admin=0");
?>
   <table class="product-display-table">
      <thead>
         <tr>
            <th>User id</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Action</th>
         </tr>
      </thead>
      <?php
         $num = mysqli_num_rows($select);
         if($num>0){
         while($row = mysqli_fetch_assoc($select)){
      ?>
         <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['lname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['mob_no']; ?></td>
            <td>
                  <a href="users_accounts.php?delete=<?php echo $row['user_id'];  ?>" class="delete-btn" onclick="return confirm('Delete this user?');">delete</a>
            </td>
         </tr>
   
   <?php
         }
      }else{
         echo '<p class="empty">No accounts available!</p>';
      }
   ?>

   </div>

</section>












<script src="admin_script.js"></script>
   
</body>
</html>