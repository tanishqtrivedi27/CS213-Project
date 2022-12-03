<?php
    session_start();
    if (!isset($_SESSION['sid']))
    {
?>   
    <script>
    alert("Please login");
    window.location.href="./slogin.php";
    </script>
<?php
    }
?>
<!DOCTYPE html>
<html>

    <head>
        <title> User profile </title>

        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Load icon library -->
    </head>
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
        $sql = "SELECT sname, spassword, semail, street, city, state, postalCode FROM seller WHERE sid = '" . $_SESSION["sid"] ."';";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $_SESSION['name'] = $row['sname'];
            $_SESSION['password'] = $row['spassword'];
            $_SESSION['email'] = $row['semail'];
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
        <form action="sellerlogin.php" method="post">
            <input class="border-x border-y border-black bg-orange-500 px-2" type="submit" value="Back">
        </form>
    </div>
</html>