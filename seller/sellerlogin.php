<?php
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/sellerlogin.css">
    </head>
    <body>

        <?php
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "slogin.php")) 
            {
                $conn = new mysqli("localhost", "root", "", "booklib");
                $_SESSION["semail"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["email"] : $_GET["email"]);
                $_SESSION["spassword"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["password"] : $_GET["password"]);
                $sql = "SELECT * FROM seller WHERE semail ='".$_SESSION["semail"]."' AND spassword = '".$_SESSION["spassword"]."'";
                $result = $conn ->query($sql);
                if ($result->num_rows==1 )
                {
                    $row = $result -> fetch_assoc();
                    $_SESSION["sname"] = $row["sname"];
                    $_SESSION["semail"] = $row["semail"];
                    $_SESSION["sid"] = $row["sid"];
                    $conn = new mysqli("localhost", "root", "", "booklib");
                    echo "<h1>Welcome, ".$_SESSION["sname"]."</h1><br>";
                    echo "<form action=\"".htmlspecialchars("./padd.php")."\">
                    <input class=\"item\" type=\"submit\" value=\"Add Product\">
                    <input class=\"item\" type=\"submit\" formaction=\"".htmlspecialchars("./signout.php")."\" value=\"Sign Out\">
                    <input class=\"item\" type=\"submit\" formaction=\"".htmlspecialchars("./usr-profile.php")."\" value=\"Profile\">
                    </form>";
                    echo "<h2>All Products</h2>";
                    
                    echo "<table> <tr><th><h3>Book<h3></th> <th><h3>Author<h3></th> <th><h3>Edition<h3></th> <th><h3>About</h3></th> 
                        <th><h3>Stock</h3></th> <th><h3>Price</h3></th> 
                        <th><h3>Delete</h3></th> <th><h3>Edit</h3></th></tr>";
                    $sql = "SELECT * FROM product WHERE sid = '".$_SESSION["sid"]."' ORDER BY pname";
                    $result = $conn -> query($sql);
                    if ($result -> num_rows >0){
                        while ($row = $result -> fetch_assoc()){
                            echo "<tr>";
                              
                            echo "<td> ".$row["pname"]."</td> <td>".$row["author"]."</td> <td>".$row["edition"]."</td> <td class=\"about\"> <textarea class=\"customize\" rows=\"5\" cols=\"50\" readonly >".$row["description"]."</textarea></td> 
                            <td>".$row["stock"]."</td> <td> ".$row["price"]."</td>";
                            echo "<td> <form method=\"POST\" onsubmit=\"return confirm('Do you really want to delete the item from inventory?');\" action=\"".htmlspecialchars("./delete.php")."\">
                            <input class=\"item-table-delete\" name=\"".$row["pid"]."\" onclick=\"myfunc(this.name)\" type=\"submit\" value=\"Delete\">
                            </form> </td>";
                            echo "<td> <form method=\"POST\" onsubmit=\"return confirm('Do you really want to edit the item from inventory?');\" action=\"".htmlspecialchars("./pedit.php")."\">
                            <input class=\"item-table-edit\" name=\"".$row["pid"]."\"  onclick=\"myfunc(this.name)\" type=\"submit\" value=\"Edit\">
                            </form> </td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                    $conn->close();
                }
                else
                {
                    session_destroy();
                    $conn->close();
                    echo "Incorrect login credentials . <br>
                        <form action=\"".htmlspecialchars("./slogin.php")."\">
                        <input type=\"submit\" value=\"Back\">
                        </form>";
                }
            }
            elseif(isset($_SERVER["HTTP_REFERER"]) and (strpos($_SERVER["HTTP_REFERER"], "sellerlogin.php") or 
            strpos($_SERVER["HTTP_REFERER"], "add.php") or strpos($_SERVER["HTTP_REFERER"], "edit.php") or 
            strpos($_SERVER["HTTP_REFERER"], "pedit.php") or strpos($_SERVER["HTTP_REFERER"], "delete.php")))
            {
                $conn = new mysqli("localhost", "root", "", "booklib");
                echo "<h1>Welcome, ".$_SESSION["sname"]."</h1><br>";
                    echo "<form action=\"".htmlspecialchars("./padd.php")."\">
                        <input class=\"item\" type=\"submit\" value=\"Add Product\">
                        <input class=\"item\" type=\"submit\" formaction=\"".htmlspecialchars("./signout.php")."\" value=\"Sign Out\">
                        <input class=\"item\" type=\"submit\" formaction=\"".htmlspecialchars("./usr-profile.php")."\" value=\"Profile\">
                        </form>";
                    echo "<h2>All product</h2>";
                    
                    echo "<table> <tr><th><h3>Book<h3></th> <th><h3>Author<h3></th> <th><h3>Edition<h3></th> <th><h3>About</h3></th> 
                        <th><h3>Stock</h3></th> <th><h3>Price</h3></th> 
                        <th><h3>Delete</h3></th> <th><h3>Edit</h3></th></tr>";
                    $sql = "SELECT * FROM product WHERE sid = '".$_SESSION["sid"]."' ORDER BY pname";
                    $result = $conn -> query($sql);
                    if ($result -> num_rows >0){
                        while ($row = $result -> fetch_assoc()){
                            echo "<tr>";

                            echo "<td> ".$row["pname"]."</td> <td>".$row["author"]."</td> <td>".$row["edition"]."</td> <td class=\"about\"> <textarea class=\"customize\" rows=\"5\" cols=\"50\" readonly >".$row["description"]."</textarea></td>
                            <td>".$row["stock"]."</td> <td> ".$row["price"]."</td>";
                            echo "<td> <form method=\"POST\" onsubmit=\"return confirm('Do you really want to delete the item from inventory?');\" action=\"".htmlspecialchars("./delete.php")."\">
                            <input class=\"item-table-delete\" name=\"".$row["pid"]."\" onclick=\"myfunc(this.name)\" type=\"submit\" value=\"Delete\">
                            </form> </td>";
                            echo "<td> <form method=\"POST\" onsubmit=\"return confirm('Do you really want to edit the item from inventory?');\" action=\"".htmlspecialchars("./pedit.php")."\">
                            <input class=\"item-table-edit\" name=\"".$row["pid"]."\" onclick=\"myfunc(this.name)\" type=\"submit\" value=\"Edit\">
                            </form> </td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                    $conn->close();
            }
            else {
                echo "Unauthenticated access.";
            }
        ?>
        <script>
            function myfunc($str){
                document.cookie = "pid="+$str+";path=/";
            }
        </script>
    </body>
</html>