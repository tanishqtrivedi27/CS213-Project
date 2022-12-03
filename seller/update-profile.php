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
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Load icon library -->
</head>
<body>
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

        $sql = "UPDATE seller SET spassword='".$_POST['pwd']."', sname='".$_POST['name']."', semail='".$_POST['email']."', street='".$_POST['street']."', city='".$_POST['city']."', state='".$_POST['state']."', postalCode='".$_POST['postalCode']."' WHERE sid='".$_SESSION['sid']."'";

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
    