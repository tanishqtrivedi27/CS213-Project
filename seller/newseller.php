<?php
    session_start();
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "nseller.php")) 
    {
        $conn = new mysqli("localhost", "root", "", "booklib");
        $_SESSION["sname"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["name"] : $_GET["name"]);
        $_SESSION["spassword"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["password"] : $_GET["password"]);
        $_SESSION["semail"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["email"] : $_GET["email"]);
        $_SESSION["street"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["street"] : $_GET["street"]);
        $_SESSION["city"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["city"] : $_GET["city"]);
        $_SESSION["state"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["state"] : $_GET["state"]);
        $_SESSION["pin"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["pin"] : $_GET["pin"]);
        
        $sql = "SELECT * FROM seller WHERE semail ='".$_SESSION["semail"]."'";
        $result = $conn -> query($sql);
        if ($result -> num_rows == 0)
        {
            $sql = "INSERT INTO seller(sname, semail, spassword, street, city, state, postalCode)
            VALUES ('".$_SESSION["sname"]."','".$_SESSION["semail"]."','".$_SESSION["spassword"]."', '".$_SESSION["street"]."',
            '".$_SESSION["city"]."', '".$_SESSION["state"]."', '".$_SESSION["pin"]."')";
            $result = $conn->query($sql);
            echo $sql; 
            $sql = "SELECT sid FROM seller WHERE semail ='".$_SESSION["semail"]."' ";
            $result1 = $conn -> query($sql);
            $row = $result1 -> fetch_assoc();
            $_SESSION["sid"] = $row["sid"];
            if ($result == true)
            {
                header("Location:./slogin.php");
            }
            $conn->close();
        }
        else 
        {
            echo "email already exists! <br>
				<form action=\"slogin.php\">
				<input type=\"submit\" value=\"Login\">
                <input type=\"submit\" formaction=\" ".htmlspecialchars("./nseller.php")."\"value=\"Create New account with different email\">
				</form>";
        }
        
    }
    else {
        echo "Unauthenticated access.";
    }

?>