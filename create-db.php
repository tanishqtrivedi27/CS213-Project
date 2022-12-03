<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error)
{
  die("Connection failed: " . $conn->connect_error);
}
else
{
  echo "connected sucessfully<br><br>";
}

$sql = file_get_contents('tables.sql');

if ($conn->multi_query($sql) === TRUE) 
{
  echo "New xyz created successfully <br><br>";
} 
else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>