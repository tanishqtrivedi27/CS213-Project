<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage | book.lib</title>
    <link rel="stylesheet" href="./style/search.css">
    <link rel="stylesheet" href="./style/navbar.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php include 'navbar.php';?>
<?php include 'input-function.php'; ?>
<?php include 'db-conn.php'; ?>
<?php
    if(isset($_POST["query"]))
    {
        $_SESSION["search_query"] = $_POST["query"];
    }
    
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "search.php"))
    {
        $sql="SELECT * FROM `product` WHERE keywords LIKE '%".$_SESSION["search_query"]."%' ORDER BY price";
        if ($_POST["price"] == "lh")
        {
            $sql.=" ASC";
        }
        else 
        {
            $sql.=" DESC";
        }
    }
    $result = $conn->query($sql);
?>

<div class="main-search-content">

  <div class="sort">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="radio" id="lh" name="price" value="lh">
        <label for="lh">Price: Lowest to Highest</label><br>

        <input type="radio" id="hl" name="price" value="hl">
        <label for="hl">Price: Highest to Lowest</label><br><br>

        <input type="submit" name="filter" value="Filter">
    </form>

  </div>

  <div class="list-items">

    
    <h2 class="text-xl font-semibold">RESULTS FOR <?php echo $_SESSION["search_query"] ?></h2>
    <br>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">

    <br><br>
    <?php
      if ($result->num_rows > 0) 
      {
        while($row = $result->fetch_assoc()) 
        {
    ?>
        <br>
        <div class="grid grid-cols-5 space-x-1">    
            <div class="justify-self-stretch">
                <img src="<?php echo"./product-images/".$row["fileName"]; ?>" class="h-36 w-4/5" alt="alt-text"/>
            </div>

            <div class="about col-span-4">    
                <h2 class="text-xl font-semibold"> <?php  echo $row["pname"]; ?></h2>
                <h3 class="text-xs font-extralight"> <?php  echo "by ".$row["author"]." "; ?> | <?php  echo "  ".$row["publishingDate"]; ?></h3>
                <br>
                <div class="text-xl font-bold">&#8377; <?php  echo $row["price"]; ?></div>
                <br>
                <form method="POST" action="product.php">
                <input type="hidden" name="product-id" value="<?php echo $row["pid"]; ?>">
                <input type="submit" name="see-more" value="See in detail >>">
                </form>
            </div>
        </div>
        <br>
        <hr style="height:1px;border-width:0;color:gray;background-color:gray">

    <?php
        }
    }
    else 
    {
        echo "No results.";
    }
    ?>
    <?php $conn->close(); ?>
  </div>
  
  
</div>

</body>

</html>