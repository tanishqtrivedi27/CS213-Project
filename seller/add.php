<?php
	session_start();

    function test_input($data) 
	{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "padd.php")) 
    {
		$conn = new mysqli("localhost", "root", "", "booklib");
		
		$_SESSION["pname"] = test_input($_POST["pname"]);
		$_SESSION["price"] = test_input($_POST["price"]);
		$_SESSION["stock"] = test_input($_POST["quantity"]);
		$_SESSION["description"] = test_input($_POST["description"]);
		$_SESSION["author"] = test_input($_POST["author"]);
		$_SESSION["edition"] = test_input($_POST["edition"]);
		$_SESSION["genre"] = str_replace(' ','#', test_input($_POST["genre"]));
		$_SESSION["publitionDate"] = test_input($_POST["publitionDate"]);
		$_SESSION["key"] = str_replace(' ','#', test_input($_POST["keywords"]));
		$sql = "SELECT * FROM product WHERE pname ='".$_SESSION["pname"]."' and author ='".$_SESSION["author"]."' and 
		`edition`='".$_SESSION["edition"]."' and sid='".$_SESSION["sid"]."' and genre='".$_SESSION["genre"]."'";
        $result = $conn -> query($sql);
		
		if ($result -> num_rows == 0)
        {
			$sql = "INSERT INTO product (pname, price, stock, description, sid, author, edition, genre, publishingDate, keywords)
			VALUES ( '".$_SESSION["pname"]."', '".$_SESSION["price"]."', '".$_SESSION["stock"]."', '".$_SESSION["description"]."',
			'".$_SESSION["sid"]."', '".$_SESSION["author"]."', '".$_SESSION["edition"]."', '".$_SESSION["genre"]."',
			'".$_SESSION["publitionDate"]."', '".$_SESSION["key"]."')";
			$result = $conn->query($sql);
			$sql = "SELECT pid FROM product WHERE pname ='".$_SESSION["pname"]."'";
            $result = $conn -> query($sql);
            $row = $result -> fetch_assoc();
            $_SESSION["pid"] = $row["pid"];

            $filename = $_FILES["file"]["name"];	
				
    		$tempname = $_FILES["file"]["tmp_name"];

			$arr=explode(".",$filename);

    		$folder = "../product-images/" . $_SESSION['pid'].".".$arr[1];
			$sql2 = "UPDATE product SET `fileName`='".$_SESSION['pid'].".".$arr[1]."' WHERE pid=".$_SESSION['pid'].";";
			echo $sql2;
			$result2=$conn->query($sql2);

			if (move_uploaded_file($tempname, $folder)) {
				echo "<h3>  Image uploaded successfully!</h3>";
			} else {
				echo "<h3>  Failed to upload image!</h3>";
			}

			?>
                <script>
                    alert('Product has been added to the inventory.'); 
                    window.location.href= "./sellerlogin.php";
                </script>

            <?php
            $conn->close();
		
		}
		else 
        {
            echo "product already exists! <br>
				<form action=\"./padd.php\">
				<input type=\"submit\" value=\"Add different product\">
                <input type=\"submit\" formaction=\" ".htmlspecialchars("./sellerlogin.php")."\"value=\"Go to home page\">
				</form>";
        }
	}
	else {
		echo "Unauthenticated access";
	}
?>