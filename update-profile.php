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
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/slider.css">
    <link rel="stylesheet" href="./style/navbar.css">
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include 'navbar.php';?>
    <?php
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['confpwd']) && $_POST['pwd']==$_POST['confpwd'] && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['postalCode']))
    {  
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "booklib";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE customer SET psw='".$_POST['pwd']."', name='".$_POST['name']."', email='".$_POST['email']."', street='".$_POST['street']."', city='".$_POST['city']."', state='".$_POST['state']."', postalCode='".$_POST['postalCode']."' WHERE cid='".$_SESSION['cusid']."'";

        if ($conn->query($sql) === TRUE) {
        // echo 'Profile updated successfully';
            ?>
                <script>
                    window.location.href="./usr-profile.php";
                </script>
            <?php
        } else {
        echo "Error updating profile: " . $conn->error;
        }

        $conn->close();
        echo '<form action="usr-profile.php">
                <input class="border-x border-y border-black bg-orange-500 px-2" type="submit" value="Back to Profile">
            </form>';
    }
    else if($_POST['pwd'] != $_POST['confpwd']) 
    {
        echo "The data entered in the Password and Confirm Password text fields aren't the same.<br>";
        echo '<form action="edit-profile.php">
                 <input type="submit" value="Back">
              </form>';
    }
    else
    {
        echo "Unauthorised access";
    }
    ?>
</body>
    