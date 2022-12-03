<?php
// Start the session
session_start();


if (isset($_POST['11']))
{
    $_SESSION['pid'] = '4';
    header("location: ./product.php");
}

elseif (isset($_POST['12']))
{
    $_SESSION['pid'] = '10';
    header("location: ./product.php");
}
?>