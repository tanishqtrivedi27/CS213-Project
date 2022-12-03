<?php 
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/padd.css">
    </head>
    <body>
        <?php 
            if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "sellerlogin.php"))
            {
                echo    "<h2>book.lib</h2>
                        <form class=\"container\" action=\"".htmlspecialchars("./add.php")."\"method=\"POST\" enctype=\"multipart/form-data\">
                            <div class=\"hello-create hello1 \">Product Details</div>
                            <label class=\"item-pname-label \" for=\"pname\" ><h5>Product Name</h5></label>
                            <input class=\"item-pname-input x\" type=\"text\" name=\"pname\" autofocus required>

                            <label class=\"item-author-label \" for=\"author\" ><h5>Author</h5></label>
                            <input class=\"item-author-input x\" type=\"text\" name=\"author\" required>

                            <label class=\"item-edition-label \" for=\"edition\" ><h5>Edition</h5></label>
                            <input class=\"item-edition-input x\" type=\"number\" name=\"edition\" required>

                            <label class=\"item-genre-label \" for=\"genre\" ><h5>Genre</h5></label>
                            <input class=\"item-genre-input x\" type=\"text\" name=\"genre\" required>

                            <label class=\"item-price-label \" for=\"price\"><h5>Price in &#8377;</h5></label>
                            <input class=\"item-price-input x\" type=\"number\" name=\"price\" step=\"any\" min=\"0\" required>

                            <label class=\"item-quantity-label \" for=\"quantity\"><h5>Quantity</h5></label>
                            <input class=\"item-quantity-input x\" type=\"number\" name=\"quantity\"  required>

                            <label class=\"item-keywords-label \" for=\"keywords\" ><h5>Keywords</h5></label>
                            <input class=\"item-keywords-input x\" type=\"text\" name=\"keywords\" required>

                            <label class=\"item-publitionDate-label \" for=\"publitionDate\" ><h5>Publition Date</h5></label>
                            <input class=\"item-publitionDate-input x\" type=\"text\" name=\"publitionDate\" required>

                            <label class=\"item-image-label \" for=\"file\" ><h5>Image</h5></label>
                            <input class=\"item-image-input x\" type=\"file\" name=\"file\" required>

                            <textarea class=\"item-description-input x\" rows=\"5\" cols=\"40\" name=\"description\" 
                            placeholder=\"Book Details...\" required></textarea>
                            <input class=\"item1\" type=\"submit\" onclick=\"addit()\" name=\"add\" value=\"Add Product\">
                            <input class=\"item2\" type=\"submit\" name=\"cancel\" onclick=\"removeit()\" value=\"Cancel\" 
                            formaction=\"".htmlspecialchars("./sellerlogin.php")."\">
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
            } else {
                echo "Unauthenticated access.";
            }
        ?>
        
    </body>
</html>