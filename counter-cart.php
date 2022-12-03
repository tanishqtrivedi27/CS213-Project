<?php session_start(); ?>

<?php include 'db-conn.php'; ?>

<?php

if (isset($_POST['inc']))
{   

    $new_qty = $_POST['qty'] + 1;
    if ($new_qty > 12)
    {
        echo " You can't purchase more than 12 items of same kind <script>  window.location.href= \"cart.php\"; </script>";
    }
    else
    {
        $sql = "UPDATE `cart` SET `qty` = $new_qty WHERE `cid`= ' " . $_SESSION['cusid'] . " '  AND `pid` = '" . $_POST['tochange'] . "' ;";
        $conn->query($sql);
        header("location: ./cart.php");
    }
}
else if (isset($_POST['dec']))
{
    $new_qty = $_POST['qty'] - 1;
    if ($new_qty < 1)
    {
        echo "<script> alert('Quantity can't be less than 1'); window.location.href= \"cart.php\"; </script>";
    }
    else
    {
        $sql = "UPDATE `cart` SET `qty` = $new_qty WHERE `cid`= ' " . $_SESSION['cusid'] . " '  AND `pid` = '" . $_POST['tochange'] . "' ;";
        $conn->query($sql);
        header("location: ./cart.php");
    }
}

$conn->close();

?>

