<?php
    session_start();
    if (isset($_POST['product-id']))
    {
        $_SESSION['pid']=$_POST['product-id']; 
    }

    if (!isset($_SESSION['cusid']))
    {

    ?>
        <script>
        alert('Login to continue seeing product'); 
        window.location.href= "login.php";
        </script>
    <?php
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style/product.css">
        <link rel="stylesheet" href="./style/navbar.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <body>
    <?php include 'navbar.php';?>
        <div class="grid grid-cols-3 p-3.5 space-x-2 space-y-10">
            <div>
                <?php
                    include 'db-conn.php';
                    $sql10= "SELECT fileName FROM product WHERE pid=".$_SESSION['pid'].";";
                    $result10 =$conn->query($sql10);
                    $row10=$result10->fetch_assoc();
                ?>
                <img src="<?php echo './product-images/'.$row10['fileName'] ?>" class="h-80 w-80">
            </div>
            <div>
               
                <?php
                    $sql = "SELECT * FROM product WHERE pid=".$_SESSION['pid'].";";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    echo "<span class='text-3xl font-bold'>".$row['pname']."</span>  <br> <span class='text-slate-400 text-xl'>published on ".$row['publishingDate']."</span> <br> by ".$row['author']."<br><br> <span class='text-slate-600 text-xl'>Paperback &#8377;".$row['price']."</span><br><br> <br><br> <span class='text-slate-900 font-xl'>Description </span><br><br>".$row['description']."<br>";
                ?>
            </div>            
            <div class="text-center">
                <br> <br><div class="border-2 border-gray-300 py-4"> <br> <br> 
                <?php
                    $qu = "EXISTS (SELECT * from cart WHERE `cid`= '" . $_SESSION['cusid'] . "'  AND `pid` = '" . $_SESSION['pid'] . "')";
                    $sql = "SELECT EXISTS (SELECT * from cart WHERE `cid`= '" . $_SESSION['cusid'] . "'  AND `pid` = '" . $_SESSION['pid'] . "');";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    if ($row[$qu]) //already in cart
                    {

                        $sql123= "SELECT qty from cart WHERE `cid`= '" . $_SESSION['cusid'] . "'  AND `pid` = '" . $_SESSION['pid'] . "'";
                        $result123 = $conn->query($sql123);
                        $row= $result123->fetch_assoc();
                        $qty = $row['qty'];
                ?>
                <form action="addtocart.php" method="POST">
                <input type="hidden" name="product-id" value="<?php echo $_SESSION['pid'] ?>">
                <input type="hidden" name="qty" value="<?php echo $qty ?>">
                <button class="rounded-2xl px-1.5 bg-orange-400" type="submit" name="inc">+</button>
                <div class="qty"><?php echo $qty ?></div> 
                <!-- get a query to get qty -->
                <button class="rounded-2xl px-2 bg-orange-400" type="submit" name="dec">-</button>
                </form>

                <br><br>

                <form action="payment.php" method="post">
                <button class="bg-orange-400 px-9 py-1 rounded-md" type="submit" name="product" >Buy Now</button>
                </form>
                </div>
                <?php
                }
                    else //not in cart
                {   
                ?>

                <br> <br> <br> 

                <form action="addtocart.php" method="POST">
                <input type="hidden" name="product-id" value="<?php echo $_SESSION['pid'] ?>">
                <button class="bg-orange-400 px-9 py-1 rounded-md" type="submit" name="addtocart" >Add to Cart</button>
                </form>

                <br> <br> <br>

                <form action="payment.php" method="post">
                <button class="bg-orange-400 px-12 py-1 rounded-md" type="submit" name="product" >Buy Now</button>
                </form>
                </div>
                <?php
                }
                    $conn->close();
                ?>
            </div>

        

        <!-- Review section -->
            <div><!-- Write a Review -->
                <?php
                    if(isset($_POST['review']))
                    {
                        include 'db-conn.php';
                        $qu2 = "EXISTS (SELECT * from `orders` WHERE `cid`= '" . $_SESSION['cusid'] . "'  AND `pid` = '" . $_SESSION['pid'] . "')";
                        $sql2 = "SELECT EXISTS (SELECT * from `orders` WHERE `cid`= '" . $_SESSION['cusid'] . "'  AND `pid` = '" . $_SESSION['pid'] . "');";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        if($row2[$qu2])
                        {
                            $review=$_POST['review'];
                            echo '<script> alert("Review has been submitted"); </script>';
                            $sql3 = "INSERT INTO `review` (`cid`, `pid`, `review`) VALUES ('".$_SESSION['cusid']."', '".$_SESSION['pid']."', '".$review."');";
                            $result3 = $conn->query($sql3);
                        }
                        else
                        {
                            echo '<script> alert("You are not allowed to review this book"); </script>';
                        }
                        $conn->close();
                    } 
                ?>
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="review">Enter your review</label><br>
                    <textarea name="review" id="review" class="border-black border-2" rows="10" columns="30"></textarea>
                    <button class="bg-orange-400 px-8 py-1 rounded-md" type="submit" name="buy" >Submit your Review</button>
                </form>
            </div>
            <div class="col-span-2">
                <span class="font-bold text-2xl"> Reviews: <br><br> </span>
                <?php
                    include 'db-conn.php';
                    $sql5="SELECT * FROM `review` WHERE pid=".$_SESSION['pid'].";";
                    $result5=$conn->query($sql5);
                    if($result5->num_rows>0) 
                    {
                        while($row5 = $result5->fetch_assoc())
                        {
                            $sql6="SELECT name FROM customer WHERE cid = ".$row5['cid'].";";
                            $result6=$conn->query($sql6);
                            $row6=$result6->fetch_assoc();
                            echo "<br><span class='text-xs'> by ".$row6['name']."</span><br>".$row5['review']."<br><br><hr><br>";
                        }
                    }
                    else 
                    {
                        echo "No reviews";
                    }
                ?>
            </div>
        </div>
    </body>
</html>