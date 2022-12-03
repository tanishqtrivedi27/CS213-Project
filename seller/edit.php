<?php
	session_start();

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "pedit.php")) 
    {   
		$conn = new mysqli("localhost", "root", "", "booklib");
        $var = test_input($_POST["pname"]);
        
            $_SESSION["price"] = test_input($_POST["price"]);
            $_SESSION["stock"] = test_input($_POST["quantity"]);
            $_SESSION["description"] = test_input($_POST["description"]);
            $_SESSION["author"] = test_input($_POST["author"] );
            $_SESSION["edition"] = test_input($_POST["edition"] );
            $_SESSION["genre"] = test_input($_POST["genre"] );
            $_SESSION["publitionDate"] = test_input($_POST["publitionDate"] );
            $_SESSION["keywords"] = str_replace(' ','#', test_input($_POST["keywords"]));
            $_SESSION["var"] = $var;
            $sql = "SELECT * FROM product WHERE pname ='".$var."'
            and author='".$_SESSION["author"]."' and edition='".$_SESSION["edition"]."' and sid='".$_SESSION["sid"]."'";
            $result = $conn -> query($sql);
            if ($result->num_rows >0)
            {
                $conn->close();
                echo "Book of same name, author and edition already exists ! <br>
                        <form action=\"".htmlspecialchars("./sellerlogin.php")."\">
                        <input type=\"submit\" value=\"Back\">
                        <input type=\"submit\" formaction=\"".htmlspecialchars("./sedit.php")."\" value=\"Update it\">
                        </form>";
            }
            else
            {
                $_SESSION["pname"]=$var; 
                $sql = "UPDATE product
                        SET pname ='".$_SESSION["pname"]."', price = '".$_SESSION["price"]."', stock =  '".$_SESSION["stock"]."'
                        , description = '".$_SESSION["description"]."', author = '".$_SESSION["author"]."', genre = '".$_SESSION["genre"]."',
                        edition = '".$_SESSION["edition"]."', keywords = '".$_SESSION["keywords"]."', publishingDate = '".$_SESSION["publitionDate"]."'
                        WHERE pid='".$_SESSION["pid"]."'";
                $result = $conn -> query($sql);
                $conn->close();
                ?>
                <script>
                    alert('Product has been edited'); 
                    window.location.href= "./sellerlogin.php";
                </script>

            <?php
                }
        }
    else 
    {
        echo "Unauthenticated access";
    }
?>