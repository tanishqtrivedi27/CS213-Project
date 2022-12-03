<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Cart</title>
  <link rel="stylesheet" href="./style/cart.css">
  <link rel="stylesheet" href="./style/navbar.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Load icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php include 'navbar.php';?>

<div class="main-cart-content">

      <div class="shop-cart">
        <br><br>
        <img src="./images/mt-cart.png" style="width:40%; display: block; margin-left: auto; margin-right: auto;">
        <?php if (isset($_SESSION['cusid']))
              { ?>
        <center> <h2> Your cart is empty. </h2> </center>
        <center> <button class="signin2" onclick="location.href = './index.php';">Shop Now</button></center>
        <?php } 
              else 
              {?>
        <center> <h2> Please login to start shopping. </h2> </center>
        <center> <button class="signin2" onclick="location.href = './login.php';">Login</button></center>
        <?php } ?>
      </div> 
</div>

</body>

</html>