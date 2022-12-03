<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/verify.css">
    </head>
    <body>
    <?php
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "verifyform.php")) 
        {
            $conn = new mysqli("localhost", "root", "", "booklib");
            $_SESSION["input"] = test_input($_POST["otp"]);
            if ( strcmp($_SESSION["input"], $_SESSION["otp"]) == 0 )
            {
                echo "<form class=\"container\" action=\"".htmlspecialchars("./change.php")."\"method=\"POST\">
                <label class=\"item-password-label \" for=\"password\" ><h5>Enter New Password:</h5></label>
                <input class=\"item-password-input \" type=\"password\" id=\"myInput\" name=\"password\" autofocus required>
                <input type=\"checkbox\" onclick=\"myFunction()\">Show Password
                <input class=\"item\" type=\"submit\" name=\"new\" value=\"Change Password\">
                </form>
                ";
            }
            else
            {
                session_destroy();
                $conn->close();
                echo "Incorrect otp <br>
                        <form action=\"".htmlspecialchars("./slogin.php")."\">
                        <input type=\"submit\" value=\"Back\">
                        </form>";
            }
        }
        else 
        {
            echo "Unauthenticated access";
        }
    ?>
    <script>
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
    </body>
</html>