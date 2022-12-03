<?php
	session_start();

    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "edit.php")) 
    {
        $conn = new mysqli("localhost", "root", "", "booklib");
        $_SESSION["pname"]=$_SESSION["var"]; 
        $sql = "UPDATE product SET price = '".$_SESSION["price"]."', stock =  '".$_SESSION["stock"]."'
            , description = '".$_SESSION["description"]."', genre = '".$_SESSION["genre"]."',
            keywords = '".$_SESSION["keywords"]."', publishingDate = '".$_SESSION["publitionDate"]."'
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
    else 
    {
        echo "Unauthenticated access";
    }
?>