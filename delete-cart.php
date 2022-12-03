<?php
session_start();
?>

<?php include 'db-conn.php'; ?>

<?php
$sql = "DELETE FROM `cart` WHERE `cid`= ' " . $_SESSION['cusid'] . " '  AND `pid` = '" . $_POST['todelete'] . "' ;";
if ($conn->query($sql) === TRUE)
{
    header("location: ./cart.php");
}
else
{
    echo "cart item not deleted";
}

$conn->close();

?>