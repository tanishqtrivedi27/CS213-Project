<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Orders | book.lib</title>
  <link rel="stylesheet" href="./style/navbar.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Load icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php include 'navbar.php';?>
<?php
    if (isset($_SESSION['cusid'])) 
    {
?>

    <br>
    <h2 class="text-2xl font-bold pl-10">Orders</h2>
    <div class="main-content p-10 grid grid-cols-6">
    
    <div class="list-items col-span-4">
<?php include 'db-conn.php'; ?>

<?php
      $sql = "SELECT * FROM `orders` WHERE `cid` = '" . $_SESSION["cusid"] . "';";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) 
      {
        while($row = $result->fetch_assoc()) 
        {
          $sqlItem = "SELECT * FROM product WHERE pid = '" . $row["pid"] . "';";
          $resultItem = $conn->query($sqlItem);
          $rowItem = $resultItem->fetch_assoc();
?>     <br>
      <div class="grid grid-cols-5">


          <div class="justify-self-stretch">
                <img src="<?php echo"./product-images/".$rowItem["fileName"]; ?>" class="h-28 w-3/5" alt="alt-text"/>
          </div>

          <div class="col-span-2">    
                <h2 class="text-xl font-semibold"> <?php  echo $rowItem["pname"]; ?></h2>
                <h3 class="text-xs font-extralight"> <?php  echo "by ".$rowItem["author"]." "; ?> | <?php  echo "  ".$rowItem["publishingDate"]; ?></h3>
                <br>
          </div>

          <div class="s">
            <h2 class="text-md font-semibold"> <?php  echo"Quantity: ".$row["qty"]; ?></h2>
            <h2 class="text-md font-semibold"> <?php  echo"Price: &#8377;".$rowItem["price"]; ?></h2>
          </div>

          <div>
            <h2 class="text-md font-semibold"> <?php  echo "Ordered on ".$row["date"]; ?></h2>
        </div>

      </div>
      <br><hr>
<?php
        }
      } 

      else
      {
        echo "No orders";
      }
?>

      </div>

      <div class="part col-span-2"></div>

      </div>

<?php
    }
    else
    {
    ?>

    <script>
    alert('Login to continue seeing your orders'); 
    window.location.href= "login.php";
    </script>

    <?php
    }
    ?>

</body>

</html>
