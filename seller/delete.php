<?php
	session_start();

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
		$sql = "DELETE FROM product WHERE pid ='".$_SESSION["pid"]."'";
        $result = $conn -> query($sql);
        $conn->close();
        ?>
			<script>
    			alert('Product has been deleted!'); 
    			window.location.href= "./sellerlogin.php";
    		</script>

		<?php
	}
    else 
    {
        echo "Unauthenticated access";
    }
?>