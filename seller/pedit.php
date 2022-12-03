<?php 
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/pedit.css">
    </head>
    <body>
        <?php 
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "sellerlogin.php"))
            {   
                $conn = new mysqli("localhost", "root", "", "booklib");
                $_SESSION["pid"] = test_input($_COOKIE["pid"]);
                setcookie("pid", "", time() - 3600);
                $sql = "SELECT * FROM product WHERE pid ='".$_SESSION["pid"]."'";
                $result = $conn -> query($sql);
                $conn->close();
                if($result->num_rows==1)
                {   
                    $row=$result->fetch_assoc();
                    $_SESSION["img"]=$row["fileName"];
                    echo    "<h2>book.lib Books</h2>
                        <form class=\"container\" action=\"".htmlspecialchars("./edit.php")."\"method=\"POST\">
                            <div class=\"hello-create hello1\">Product Details</div>
                            <label class=\"item-pname-label\" for=\"pname\" ><h5>Product Name</h5></label>
                            <input class=\"item-pname-input x\" type=\"text\" value=\"".$row["pname"]."\" name=\"pname\" autofocus required>

                            <label class=\"item-price-label \" for=\"price\"><h5>Price in &#8377;</h5></label>
                            <input class=\"item-price-input x\" type=\"number\" value=\"".$row["price"]."\" name=\"price\" step=\"any\" min=\"0\" required>

                            <label class=\"item-author-label\" for=\"author\" ><h5>Author</h5></label>
                            <input class=\"item-author-input x\" type=\"text\" value=\"".$row["author"]."\" name=\"author\" required>

                            <label class=\"item-edition-label\" for=\"number\" ><h5>Edition</h5></label>
                            <input class=\"item-edition-input x\" type=\"number\" value=\"".$row["edition"]."\" name=\"edition\" required>

                            <label class=\"item-genre-label\" for=\"genre\" ><h5>Genre</h5></label>
                            <input class=\"item-genre-input x\" type=\"text\" value=\"".str_replace('#', ' ', $row["genre"])."\" name=\"genre\" required>

                            <label class=\"item-keywords-label\" for=\"keywords\"><h5>Keywords</h5></label>
                            <input class=\"item-keywords-input x\" type=\"text\" value=\"".str_replace('#', ' ', $row["keywords"])."\" name=\"keywords\"  required>

                            <label class=\"item-publitionDate-label\" for=\"publitionDate\"><h5>Publition Date</h5></label>
                            <input class=\"item-publitionDate-input x\" type=\"text\" value=\"".$row["publishingDate"]."\" name=\"publitionDate\"  required>

                            <label class=\"item-quantity-label\" for=\"quantity\"><h5>Quantity</h5></label>
                            <input class=\"item-quantity-input x\" type=\"number\" value=\"".$row["stock"]."\" name=\"quantity\"  required>

                            <textarea class=\"item-description-input x\" rows=\"5\" cols=\"40\" name=\"description\" required>".$row["description"]."</textarea>

                            <input class=\"item1\" type=\"submit\" name=\"add\" value=\"Edit Product\">
                            <input class=\"item2\" type=\"submit\" name=\"cancel\" onclick=\"removeit()\" 

                            value=\"Cancel\" formaction=\"".htmlspecialchars("./sellerlogin.php")."\">
                        </form>
                        <script>
                        function removeit(){
                            const a = document.getElementsByClassName(\"x\");
                            for (let i = 0; i < a.length; i++) {
                                a[i].removeAttribute('required');
                            }
                        }

                        function addit() {
                            const a = document.getElementsByClassName(\"x\");
                            for (let i = 0; i < a.length; i++) {
                                a[i].setAttribute('required', '');
                            }
                        }
                        </script>";
                }
                else
                {
                    ?>
                    <script>
                        alert('Error occured'); 
                        window.location.href= "./sellerlogin.php";
                    </script>
        
                    <?php
                }
                
            } else {
                echo "Unauthenticated access.";
            }
        ?>
        
    </body>
</html>