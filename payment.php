<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Payment interface </title>
        <link rel="stylesheet" href="./style/navbar.css"> 
        <link rel="stylesheet" href="./style/payment.css">
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body onload=Default()>
        <?php include 'navbar.php'; ?> 
        <br>
        <?php
            if(isset($_POST['product']))
            { 
                $_SESSION['product']="product";
                include 'db-conn.php';
                $sql = "SELECT * FROM product WHERE pid=".$_SESSION['pid'].";";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
        ?>
        <div class="Cart-Items grid grid-cols-4 pl-10">
            <div class="justify-self-stretch">
                <img src="<?php echo"./product-images/".$row["fileName"]; ?>" class="h-28 w-3/5" alt="alt-text"/>
            </div>
            <div>    
                <h2 class="text-xl font-semibold"> <?php  echo $row["pname"]; ?></h2>
                <h3 class="text-xs font-extralight"> <?php  echo "by ".$row["author"]." "; ?> | <?php  echo "  ".$row["publishingDate"]; ?></h3>
            </div>
            <div>
                <div class="text-xl font-bold">&#8377; <?php  echo $row["price"]." x 1"; ?></div> 
            </div>
        </div>
        <br>
        <span class="pl-10 text-2xl font-semibold">Total: &#8377;<?php echo $row['price']?>  </b></span> 
        <hr>
        <?php 
                $conn->close();
            } 
            else if(isset($_POST['cart']))
            {
                $total=0;
                $_SESSION['cart']="cart";
                include 'db-conn.php';
                $sql="SELECT * FROM cart WHERE cid='".$_SESSION['cusid']."';";
                $result = $conn->query($sql);
                if($result->num_rows>0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        $sql2="SELECT * FROM product WHERE pid=".$row['pid'].";";
                        $result2=$conn->query($sql2);
                        $row2=$result2->fetch_assoc();
                        ?>
                        <br>
                        <div class="Cart-Items grid grid-cols-4 pl-10">
                            <div class="justify-self-stretch">
                                <img src="<?php echo"./product-images/".$row2["fileName"]; ?>" class="h-28 w-3/5" alt="alt-text"/>
                            </div>
                            <div>    
                                <h2 class="text-xl font-semibold"> <?php  echo $row2["pname"]; ?></h2>
                                <h3 class="text-xs font-extralight"> <?php  echo "by ".$row2["author"]." "; ?> | <?php  echo "  ".$row2["publishingDate"]; ?></h3>
                            </div>
                            <div>
                                <div class="text-xl font-bold">&#8377; <?php  echo $row2["price"]." x ".$row['qty']; $total+=($row2["price"]*$row["qty"]) ?></div> 
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                    echo '<span class="pl-10 text-2xl font-semibold"> <br>Total Amount: &#8377;'.$total.'</b><br><br></span>';
                }
                $conn->close();   
            }
        ?>
        <h1 class="text-3xl font-bold pl-10">   Select a payment method: </h1>
        <form action="payment2.php" method="post">
            <div class="grid-container pl-10">
            <div class="row border-solid border-black border-2" id="DebitCredit"> 
                <input type="radio" name="1" value="Card" onclick="myFunction(1);Hide(1)">  Pay with Debit/Credit Cards 
                <div class="text-base" id="Card">
                    &nbsp; &nbsp; &nbsp; &nbsp; Enter Card Details: <br>
                    <form action="payment2.php" method="post"> 
                        &nbsp; &nbsp; &nbsp; &nbsp;  Card Number: <input class="border-x border-y border-black my-px" type="text" required name="card"> <br> </span>
                        &nbsp; &nbsp; &nbsp; &nbsp; Name On Card: <input class="border-x border-y border-black my-px" type="text" required> <br> 
                        &nbsp; &nbsp; &nbsp; &nbsp;  Expiry Date: <input class="border-x border-y border-black my-px" type="month" required> <br>
                        &nbsp; &nbsp; &nbsp; &nbsp; CVV: <input class="border-x border-y border-black my-px" type="text" required> <br> 
                        &nbsp; &nbsp; &nbsp; &nbsp; <input class="border-x border-y border-black bg-orange-300 px-2" type="submit" value="Submit">
                    </form>
                </div>
            </div>
            <div class="row border-solid border-black border-2" id="NetBanking"> 
                <input type="radio" name="1" value="NB" onclick="myFunction(2);Hide(2)"> Net Banking
                <div class="text-base" id="NB">
                &nbsp; &nbsp; &nbsp; &nbsp; Choose an option: <br>
                    <form action="payment2.php" method="post">
                        &nbsp; &nbsp; &nbsp; &nbsp; <select class="border-x border-y border-black" name="banks">
                                                        <option value = "Airtel">Airtel Payments Bank</option>
                                                        <option value = "Axis">Axis Bank</option>
                                                        <option value = "HDFC">HDFC Bank</option>
                                                        <option value = "ICICI">ICICI Bank</option>
                                                        <option value = "Kotak">Kotak Bank</option>
                                                        <option value = "SBI">State Bank of India</option>
                                                    </select>   <br>
                        &nbsp; &nbsp; &nbsp; &nbsp; <input class="border-x border-y border-black bg-orange-300 px-2" type="submit" value="Submit"> 
                    </form>
                </div>
            </div>
            <div class="row border-solid border-black border-2" id="Upi"> 
                <input type="radio" name="1" value="UPI" onclick="myFunction(3);Hide(3)">  UPI 
                <div class="text-base" id="UPI">
                    &nbsp; &nbsp; &nbsp; &nbsp; Enter your UPI Id: <br>
                    <form action="payment2.php" method="post">                    
                    &nbsp; &nbsp; &nbsp; &nbsp; <input class="border-x border-y border-black" type="text" name="upi" placeholder="Ex: MobileNumber@upi" required> <br>
                    &nbsp; &nbsp; &nbsp; &nbsp; <input class="border-x border-y border-black bg-orange-300 px-2" type="submit" value="Submit">
                    </form>
                </div>
            </div>
            <div class="row border-solid border-black border-2" id="emi"> 
                <input type="radio" name="1" value="EMI" onclick="myFunction(4);Hide(4)">  EMI 
                <div class="text-base" id="EMI">
                    &nbsp; &nbsp; &nbsp; &nbsp; Enter Card Details: <br>
                    <form action="payment2.php" method="post">                         
                        &nbsp; &nbsp; &nbsp; &nbsp;  Card Number: <input class="border-x border-y border-black my-px" type="text" required> <br> 
                        &nbsp; &nbsp; &nbsp; &nbsp; Name On Card: <input class="border-x border-y border-black my-px" type="text" required name="Name"> <br> 
                        &nbsp; &nbsp; &nbsp; &nbsp;  Expiry Date: <input class="border-x border-y border-black my-px" type="month" required> <br>
                        &nbsp; &nbsp; &nbsp; &nbsp; CVV: <input class="border-x border-y border-black my-px" type="text" required> <br> 
                        &nbsp; &nbsp; &nbsp; &nbsp; <input class="border-x border-y border-black bg-orange-300 px-2" type="submit" value="Submit">
                    </form>
                </div>
            </div>
            <div class="row border-solid border-black border-2" id="pay"> 
                <input type="radio" name="1" value="Cash" onclick="myFunction(5);Hide(5)">  Pay on Delivery 
                <div class="text-base" id="PAY">
                    <form action="payment2.php" method="post">
                    &nbsp; &nbsp; &nbsp; &nbsp; <input class="border-x border-y border-black bg-orange-300 px-2" type="submit" value="Submit" name="Delivery">
                    </form>
                </div>
            </div>
            </div>
        </form>
        <script>
            function myFunction(p1) {
                if(p1==1)
                {
                    var x = document.getElementById("Card");
                    if (x.style.display === "none") {
                         x.style.display = "block";
                        document.getElementById("DebitCredit").style.backgroundColor = "Gainsboro";
                    } else {
                        x.style.display = "none";
                        document.getElementById("DebitCredit").style.backgroundColor = "white";
                    }
                }
                else if(p1==2)
                {
                    var x = document.getElementById("NB");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                        document.getElementById("NetBanking").style.backgroundColor = "Gainsboro";
                    } else {
                        x.style.display = "none";
                        document.getElementById("NetBanking").style.backgroundColor = "white";
                    }
                }
                else if(p1==3)
                {
                    var x = document.getElementById("UPI");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                        document.getElementById("Upi").style.backgroundColor = "Gainsboro";
                    } else {
                        x.style.display = "none";
                        document.getElementById("Upi").style.backgroundColor = "white";
                    }      
                }
                else if(p1==4)
                {
                    var x = document.getElementById("EMI");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                        document.getElementById("emi").style.backgroundColor = "Gainsboro";
                    } else {
                        x.style.display = "none";
                        document.getElementById("emi").style.backgroundColor = "white";
                    }
                }
                else if(p1==5)
                {
                    var x = document.getElementById("PAY");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                        document.getElementById("pay").style.backgroundColor = "Gainsboro";
                    } else {
                        x.style.display = "none";
                        document.getElementById("pay").style.backgroundColor = "white";
                    }    
                }
            }
            function Default(){
                document.getElementById("Card").style.display = "none";
                document.getElementById("NB").style.display = "none";
                document.getElementById("UPI").style.display = "none";
                document.getElementById("EMI").style.display = "none";
                document.getElementById("PAY").style.display = "none";
            }
            function Hide(x){
                if(x==1)
                {
                    document.getElementById("NB").style.display = "none";
                    document.getElementById("NetBanking").style.backgroundColor = "white";
                    document.getElementById("UPI").style.display = "none";
                    document.getElementById("Upi").style.backgroundColor = "white";
                    document.getElementById("EMI").style.display = "none";
                    document.getElementById("emi").style.backgroundColor = "white";
                    document.getElementById("PAY").style.display = "none";
                    document.getElementById("pay").style.backgroundColor = "white";
                }
                else if(x==2)
                {
                    document.getElementById("Card").style.display = "none";
                    document.getElementById("DebitCredit").style.backgroundColor = "white";
                    document.getElementById("UPI").style.display = "none";
                    document.getElementById("Upi").style.backgroundColor = "white";
                    document.getElementById("EMI").style.display = "none";
                    document.getElementById("emi").style.backgroundColor = "white";
                    document.getElementById("PAY").style.display = "none";
                    document.getElementById("pay").style.backgroundColor = "white";
                }
                else if(x==3)
                {
                    document.getElementById("Card").style.display = "none";
                    document.getElementById("DebitCredit").style.backgroundColor = "white";
                    document.getElementById("NB").style.display = "none";
                    document.getElementById("NetBanking").style.backgroundColor = "white";
                    document.getElementById("EMI").style.display = "none";
                    document.getElementById("emi").style.backgroundColor = "white";
                    document.getElementById("PAY").style.display = "none";
                    document.getElementById("pay").style.backgroundColor = "white";
                }
                else if(x==4)
                {
                    document.getElementById("Card").style.display = "none";
                    document.getElementById("DebitCredit").style.backgroundColor = "white";
                    document.getElementById("NB").style.display = "none";
                    document.getElementById("NetBanking").style.backgroundColor = "white";
                    document.getElementById("UPI").style.display = "none";
                    document.getElementById("Upi").style.backgroundColor = "white";
                    document.getElementById("PAY").style.display = "none";
                    document.getElementById("pay").style.backgroundColor = "white";
                }
                 else if(x==5)
                {
                    document.getElementById("Card").style.display = "none";
                    document.getElementById("DebitCredit").style.backgroundColor = "white";
                    document.getElementById("NB").style.display = "none";
                    document.getElementById("NetBanking").style.backgroundColor = "white";
                    document.getElementById("UPI").style.display = "none";
                    document.getElementById("Upi").style.backgroundColor = "white";
                    document.getElementById("EMI").style.display = "none";
                    document.getElementById("emi").style.backgroundColor = "white";
                }
            }
        </script>
    </body>
</html>