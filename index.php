<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Homepage | book.lib</title>
  <link rel="stylesheet" href="./style/navbar.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Load icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php include 'navbar.php';?>
<div class="main-cart-content px-16">
  <div class="grid grid-cols-9">
    <div class="col-span-5 px-16 py-16">
      <h1 class="text-5xl"> Buy and Sell your </h1><br>
      <h1 class="text-5xl"> books for the </h1><br>
      <h1 class="text-5xl"> best price </h1><br>

      <span class="font-light"> From applied literature to educational resource <br>
        we have lot of books to offer you. We provide <br>
        only the best books.</span>
    </div>


    <div class="col-span-4 py-12">
      <img alt="alt-text" src="./images/b-3.jpg">
    </div>  
  </div>
  <hr style="height:1px;border-width:0;color:gray;background-color:gray">
  <br>
  <br>
  <div class="text-center">
    <h1 class="text-3xl"> Shop books by genre</h1><br><br>
  </div>
  <div class="grid grid-cols-4">

    <div class="pl-20 pr-6">
      <span class="text-center">Computer programming</span>
    <a href="./search.php?search=computer">
      <img src="./product-images/4.png" class="h-72" alt="alt-text">
    </a>
    </div>

    <div class="px-6">
    <span class="text-center">Novels & Literature</span>
      <a href="./search.php?search=novel">
      <img src="./images/novel.jpg" class="h-72 w-full" alt="alt-text">
      </a>
    </div>

      
    <div class="px-6">
    <span class="text-center">Fiction</span>
      <a href="./search.php?search=fiction">
      <img src="./images/fict.jpg" class="h-72 w-full" alt="alt-text">
      </a>
    </div>
      
    <div class="pl-6 pr-16">
    <span class="text-center">Story books</span>
      <a href="./search.php?search=story">
      <img src="./images/story.jpg" class="h-72 w-full" alt="alt-text">
      </a>
    </div>

  </div>
  <br><br><br>
  <hr style="height:1px;border-width:0;color:gray;background-color:gray">
  <div class="grid grid-cols-2">

    <div class="grid grid-cols-2">
      <div class="p-10"><form method="POST" action="send-index.php"><button name="11" type="submit"><img src="./product-images/4.png" class="h-52 w-48" alt="alt-text"></button></form></div>
      <div class="p-10"><form method="POST" action="send-index.php"><button name="12" type="submit"><img src="./images/tsc.jpg" class="h-52 w-48" alt="alt-text"></button></form></div>
    </div>

    <div class="text-align p-16">
      <br><br>
      <span class="text-3xl">Find your Favourite <br><br> Books Here </span>
    </div>

  </div>

  <br><br><hr style="height:1px;border-width:0;color:gray;background-color:gray"><br><br>
  <!-- Seller login integration -->

  <div class="grid grid-cols-5 pl-16">
    <div class="col-span-3"><span class="text-3xl">Start selling now </span></div>
    <div><a href="./seller/slogin.php"><button class="bg-orange-400 px-9 py-1 rounded-md"> Seller Login </button></a></div>
  </div>

  <br><br><hr style="height:1px;border-width:0;color:gray;background-color:gray"><br><br>
</div>

</body>

</html>
