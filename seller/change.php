<?php
    session_start();

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "verify.php"))
    {
        $conn = new mysqli("localhost", "root", "", "booklib");
        $_SESSION["password"] = test_input($_POST["password"]);
        $sql="UPDATE seller
        SET spassword = '".$_SESSION["password"]."'
        WHERE sid = '".$_SESSION["sid"]."' ";
        $result = $conn->query($sql);
        $conn->close();
        session_destroy();
        header("Location:./slogin.php");
    }
    else
    {
        echo "Unauthenticated access";
    }
?>