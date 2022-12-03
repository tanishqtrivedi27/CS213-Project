<?php 
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "sellerlogin.php")) 
    {
        session_destroy();
        header('Location: ./slogin.php');
    }
    else
    {
        echo "Unauthorized access";
    }
?>