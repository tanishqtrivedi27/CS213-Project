<!-- NAVBAR STARTS -->
<div class="navbar grid-col-full">

  <!-- name/logo -->
  <div class="grid-item-2"><a href="./index.php">
    <span class="big-font" style="font-size:2rem;text-align: justify;margin-left: 0.5rem;"> book<span class="small-font" style="font-size:1.35rem;">.lib</span> </span>
</a></div>

  <!-- search bar -->
  <div class="grid-col-span-4 srch-bar">
    <form class="example" action="./search.php" method="GET">
      <input type="text" name="search" placeholder="  Search">
      <button type="submit" class="srch"><i class="fa fa-search"></i></button>
    </form>
  </div>

  <!-- login.php & profile.php-->
  <div class="grid-item-2">
    <?php 
      if (isset($_SESSION['cusid'])) 
      {           
        $var = strpos($_SESSION["name"], " ");
        $guest = "";
        for ($i=0; $i <= $var; $i++) 
        { 
          $guest = $guest . $_SESSION["name"][$i];
        }
        echo "<a href=\"usr-profile.php\"><span class=\"small-font\">Hello ". $guest . "</span></a><br><span class=\"big-font\"><a href=\"./logout.php\">Sign out</a></span>";
      }
      else
      {
        echo "<span class=\"small-font\">Hello guest</span><br><span class=\"big-font\"><a href=\"./login.php\">Sign in</a></span>";
      }
    ?>
  </div>

  <!-- order.php -->
  <div class="grid-item-2">
    <span class="small-font">Returns</span><br><span class="big-font"><a href="./order.php">& Orders</a></span>
  </div>
  
  <!-- cart.php -->
  <div class="grid-item-2">
    <a href="./cart.php"><img src="./images/cart.png" class="nav-img"></a>
  </div>

</div>
<!-- NAVBAR ENDS -->