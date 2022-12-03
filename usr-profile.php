<?php
    session_start();
    if (!isset($_SESSION['cusid']))
    {
?>   
    <script>
    alert("Please login");
    window.location.href="./login.php";
    </script>
<?php
    }
?>
<!DOCTYPE html>
<html>

    <head>
        <title> User profile </title>

        <link rel="stylesheet" href="./style/navbar.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <?php include 'navbar.php';?>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "booklib";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT name, psw, email, street, city, state, postalCode FROM customer WHERE cid = '" . $_SESSION["cusid"] ."';";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['password'] = $row['psw'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['street'] =$row['street'];
            $_SESSION['city'] = $row['city'];
            $_SESSION['state'] = $row['state'];
            $_SESSION['postalCode'] = $row['postalCode'];
        }
        } else {
        echo " Sign in ";
        }
        $conn->close();
    ?>
    <div class="p-16">
        <b>Name:</b> <?php echo $_SESSION['name']?> <br>
        <b>Email:</b> <?php echo $_SESSION['email']?> <br>
        <b>Password:</b> <?php echo $_SESSION['password']?> <br>
        <b>Address:</b> <?php echo $_SESSION['street'] . ",<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " . $_SESSION['city'] . ",<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_SESSION['state'] . ",<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .  $_SESSION['postalCode'] ?>
        <form action="edit-profile.php" method="post">
            <input class="border-x border-y border-black bg-orange-500 px-2" type="submit" value="Edit Profile">
        </form>
        <form action="index.php" method="post">
            <input class="border-x border-y border-black bg-orange-500 px-2" type="submit" value="Back">
        </form>
    </div>
</html>