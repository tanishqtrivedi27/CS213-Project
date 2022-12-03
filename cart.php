<?php
// Start the session
session_start();
?>

<!DOCTYPE html> 
<html>
<head>
  <title>Cart | book.lib</title>
  <link rel="stylesheet" href="./style/cart.css">
  <link rel="stylesheet" href="./style/navbar.css">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Load icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php include 'navbar.php';?>

<div class="main-cart-content">

  <?php
    if (isset($_SESSION['cusid'])) 
    {
  ?>
  
  <?php include 'db-conn.php'; ?>

  <?php
      $sql = "SELECT pid, qty FROM cart WHERE cid = '" . $_SESSION["cusid"] . "';";
      $result = $conn->query($sql);

      $sql2 = "SELECT SUM(qty) FROM cart WHERE cid = '" . $_SESSION["cusid"] . "';";
      $result2 = $conn->query($sql2);
      $row2 = $result2->fetch_assoc();
  ?>

      <div class="shop-cart">
        <br><br>
        <h2 class="text-2xl font-bold">Shopping Cart</h2>
        <br>

  <?php
      if ($result->num_rows > 0) 
      {
        while($row = $result->fetch_assoc()) 
        {
  
  ?>
      <?php

$sqlItem = "SELECT * FROM product WHERE pid = '" . $row["pid"] . "';";
$resultItem = $conn->query($sqlItem);
$rowItem = $resultItem->fetch_assoc();

?>
<br>
<div class="Cart-Items grid grid-cols-4">

    <div class="justify-self-stretch">
            <img src="<?php echo"./product-images/".$rowItem["fileName"]; ?>" class="h-28 w-4/5" alt="alt-text"/>
      </div>

      <div class="col-span-2">    
            <h2 class="text-xl font-semibold"> <?php  echo $rowItem["pname"]; ?></h2>
            <h3 class="text-xs font-extralight"> <?php  echo "by ".$rowItem["author"]." "; ?> | <?php  echo "  ".$rowItem["publishingDate"]; ?></h3>
            <br>
            <div class="text-xl font-bold">&#8377; <?php  echo $rowItem["price"]; ?></div>
            <br>
      </div>

    <div class="counter">

        <form class="form-inline" action="counter-cart.php" method="POST">
        <input type="hidden" name="tochange" value="<?php echo $row["pid"] ?>">
        <input type="hidden" name="qty" value="<?php echo $row["qty"] ?>">
        <button type="submit" class="rounded-2xl px-1.5 bg-orange-400" name="inc">+</button> &nbsp;&nbsp;
        <div class="count"><?php  echo $row["qty"] ?></div>  &nbsp;&nbsp;
        <button type="submit" class="rounded-2xl px-1.5 bg-orange-400" name="dec">-</button>
        </form>
        <br>
        <form method="POST" action="delete-cart.php" onsubmit="return confirm('Do you really want to delete the item from cart?');">
        <input type="hidden" name="todelete" value="<?php echo $row["pid"] ?>">
        <input type="submit" class="bg-orange-400 px-2.5 rounded" name="delete" value="Delete">
        </form>
    </div>

</div>
<br>
<hr>

  <?php
        }
      }
      else 
      {
        header("location: ./empty-cart.php");
      }
  ?>
      </div> 

      <div class="subtotal">
        <br><br>
        <p  style="font-size: 14px;">Your Order is eligible for FREE Delivery</p>
        Subtotal: <?php  echo $row2["SUM(qty)"] ?> items
        <br><br>

        <form action="payment.php" method="post">
          <button class="checkout bg-orange-400" type="submit" name="cart"> Proceed to checkout </button>
        </form>

      </div>
</div>

  <?php
  
      $conn->close();
    }
    else
    {
      header("location: ./empty-cart.php");
    }
    ?>
</body>

</html>