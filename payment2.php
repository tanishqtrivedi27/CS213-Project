<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style/navbar.css">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <?php 
            if(isset($_POST['card']) || isset($_POST['banks']) || isset($_POST['upi']) || isset($_POST['Name']) || isset($_POST['Delivery']))
            {
                echo "<h2>Thank you for choosing to buy books from our website!</h2>";
                ?> 
                    <form action="index.php" method="post">
                        <input type="submit" value="Back to Homepage">
                    </form>
                <?php
                if(isset($_SESSION['cart']))
                {
                    date_default_timezone_set('Asia/Kolkata');
                    include 'db-conn.php';
                    $sql="SELECT * FROM cart;";
                    $result=$conn->query($sql);
                    if($result->num_rows>0)
                    {
                        while($row=$result->fetch_assoc())
                        {
                            if(isset($_POST['card']))
                            {
                                $today = date("m.d.Y");
                                $sql2 = "INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$row['pid']."', '".$row['cid']."', '".$row['qty']."', '".$today."', 'Card');"; 
                                $result2=$conn->query($sql2);

                                $sql2="SELECT `stock` FROM `product` WHERE pid=".$row['pid'].";";
                                $result2=$conn->query($sql2);
                                $row2=$result2->fetch_assoc();
                                $row2['stock']=$row2['stock']-$row['qty'];
                                $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$row['pid']."';";
                                $result3=$conn->query($sql3);
                            }
                            else if(isset($_POST['banks']))
                            {
                                $today = date("m.d.Y");
                                $sql2 = "INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$row['pid']."', '".$row['cid']."', '".$row['qty']."', '".$today."', 'NetBanking');"; 
                                $result2=$conn->query($sql2);  
                                
                                $sql2="SELECT `stock` FROM `product` WHERE pid=".$row['pid'].";";
                                $result2=$conn->query($sql2);
                                $row2=$result2->fetch_assoc();
                                $row2['stock']=$row2['stock']-$row['qty'];
                                $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$row['pid']."';";
                                $result3=$conn->query($sql3);
                            }    
                            else if(isset($_POST['upi']))
                            {
                                $today = date("m.d.Y");
                                $sql2 = "INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$row['pid']."', '".$row['cid']."', '".$row['qty']."', '".$today."', 'UPI');"; 
                                $result2=$conn->query($sql2);   
                                
                                $sql2="SELECT `stock` FROM `product` WHERE pid=".$row['pid'].";";
                                $result2=$conn->query($sql2);
                                $row2=$result2->fetch_assoc();
                                $row2['stock']=$row2['stock']-$row['qty'];
                                $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$row['pid']."';";
                                $result3=$conn->query($sql3);
                            }    
                            else if(isset($_POST['Name']))
                            {
                                $today = date("m.d.Y");
                                $sql2 = "INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$row['pid']."', '".$row['cid']."', '".$row['qty']."', '".$today."', 'EMI');"; 
                                $result2=$conn->query($sql2);    

                                $sql2="SELECT `stock` FROM `product` WHERE pid=".$row['pid'].";";
                                $result2=$conn->query($sql2);
                                $row2=$result2->fetch_assoc();
                                $row2['stock']=$row2['stock']-$row['qty'];
                                $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$row['pid']."';";
                                $result3=$conn->query($sql3);
                            }  
                            else if(isset($_POST['Delivery']))
                            {
                                $today = date("m.d.Y");
                                $sql2 = "INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$row['pid']."', '".$row['cid']."', '".$row['qty']."', '".$today."', 'Pay on Delivery');"; 
                                $result2=$conn->query($sql2);  
                                
                                $sql2="SELECT `stock` FROM `product` WHERE pid=".$row['pid'].";";
                                $result2=$conn->query($sql2);
                                $row2=$result2->fetch_assoc();
                                $row2['stock']=$row2['stock']-$row['qty'];
                                $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$row['pid']."';";
                                $result3=$conn->query($sql3);
                            }  
                        }
                    }
                    $sql4="DELETE FROM `cart`;";
                    $result4=$conn->query($sql4);
                    unset($_SESSION['cart']); 
                }
                else if (isset($_SESSION['product']))
                {
                    date_default_timezone_set("Asia/Kolkata");
                    include 'db-conn.php';
                    if(isset($_POST['card']))
                    {
                        $today = date("m.d.Y");
                        $sql="INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$_SESSION['pid']."','".$_SESSION['cusid']."','1','".$today."','Card');";
                        $result=$conn->query($sql);

                        $sql2="SELECT `stock` FROM `product` WHERE pid=".$_SESSION['pid'].";";
                        $result2=$conn->query($sql2);
                        $row2=$result2->fetch_assoc();
                        $row2['stock']=$row2['stock']-1;
                        $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$_SESSION['pid']."';";
                        $result3=$conn->query($sql3);
                    }
                    else if(isset($_POST['banks']))
                    {
                        $today = date("m.d.Y");
                        $sql="INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$_SESSION['pid']."','".$_SESSION['cusid']."','1','".$today."','NetBanking');";
                        $result=$conn->query($sql);

                        $sql2="SELECT `stock` FROM `product` WHERE pid=".$_SESSION['pid'].";";
                        $result2=$conn->query($sql2);
                        $row2=$result2->fetch_assoc();
                        $row2['stock']=$row2['stock']-1;
                        $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$_SESSION['pid']."';";
                        $result3=$conn->query($sql3);
                    }
                    else if(isset($_POST['upi']))
                    {
                        $today = date("m.d.Y");
                        $sql="INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$_SESSION['pid']."','".$_SESSION['cusid']."','1','".$today."','UPI');";
                        $result=$conn->query($sql);

                        $sql2="SELECT `stock` FROM `product` WHERE pid=".$_SESSION['pid'].";";
                        $result2=$conn->query($sql2);
                        $row2=$result2->fetch_assoc();
                        $row2['stock']=$row2['stock']-1;
                        $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$_SESSION['pid']."';";
                        $result3=$conn->query($sql3);
                    }
                    else if(isset($_POST['Name']))
                    {
                        $today = date("m.d.Y");
                        $sql="INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$_SESSION['pid']."','".$_SESSION['cusid']."','1','".$today."','EMI');";
                        $result=$conn->query($sql);

                        $sql2="SELECT `stock` FROM `product` WHERE pid=".$_SESSION['pid'].";";
                        $result2=$conn->query($sql2);
                        $row2=$result2->fetch_assoc();
                        $row2['stock']=$row2['stock']-1;
                        $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$_SESSION['pid']."';";
                        $result3=$conn->query($sql3);
                    }
                    else if(isset($_POST['Delivery']))
                    {
                        $today = date("m.d.Y");
                        $sql="INSERT INTO `orders` (`pid`,`cid`,`qty`,`date`,`paymentMode`) VALUES ('".$_SESSION['pid']."','".$_SESSION['cusid']."','1','".$today."','Pay on Delivery');";
                        $result=$conn->query($sql);

                        $sql2="SELECT `stock` FROM `product` WHERE pid=".$_SESSION['pid'].";";
                        $result2=$conn->query($sql2);
                        $row2=$result2->fetch_assoc();
                        $row2['stock']=$row2['stock']-1;
                        $sql3="UPDATE `product` SET `stock`='".$row2['stock']."' WHERE pid='".$_SESSION['pid']."';";
                        $result3=$conn->query($sql3);
                    }
                    unset($_SESSION['product']);
                }
            }
            else
            {
                echo '<span style="font-size:20px"> Please choose a payment method </span> <br><br>';
                echo '<form action="payment.php" method="post">
                            <input type="submit" value="Back">
                    </form>';
            }
        ?>
    </body>
</html>