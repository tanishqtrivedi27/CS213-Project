<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign in</title>
  <link rel="stylesheet" href="./style/login.css">
</head>

<body>

  <h2 style="text-align: center;">book.lib</h2>

  <form action="./login.php" method="post">
    
    <div class="container">
      <h1>Sign-in</h1>
      <label for="Name"><b>Name</b></label>
      <input type="text" name="name" required>
        
      <label for="E-mail"><b>E-mail</b></label>
      <input type="email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" name="psw" required>
    
      <input type="submit" name="signin" class="submit" value="Sign-in">
    </div>
    
    <div class="container-2">
      <p>By Signing-in, you agree to book.lib's conditions of Use and Sale. Pleease see our Privacy Notice, our Cookie Notice And Internet-based ads Notice.</p>

      <input type="submit" name="signup" class="create" value="Create your Amazon Account">
    </div>

  </form>
    
  <?php include 'input-function.php'; ?>
  <?php include 'db-conn.php'; ?>
  <?php
    if (isset($_POST['signin'])) 
    { 
      $_SESSION["name"] = test_input($_POST["name"]);
      $_SESSION["password"] = test_input( $_POST["psw"]);
      $_SESSION["email"] = test_input( $_POST["email"]);

      $sql = "SELECT cid, psw FROM customer WHERE name = '" . $_SESSION["name"] ."' and email = '" . $_SESSION["email"]. "';";
      $result = $conn->query($sql);

      if ($result->num_rows > 0)
      {
        while($row = $result->fetch_assoc()) 
        {
          if ($row["psw"] === $_SESSION["password"]) 
          { 
            $_SESSION["cusid"] = $row["cid"];
            header("location: ./index.php");
          }
          // wrong password
          else
          {
            header("location: ./wrong.php");
          }
        }
      }
      // No such username or email id
      else
      {
        header("location: ./wrong.php");
      }
    } 
    else if (isset($_POST['signup'])) 
    {
      $_SESSION["name"] = test_input($_POST["name"]);
      $_SESSION["password"] = test_input( $_POST["psw"]);
      $_SESSION["email"] = test_input( $_POST["email"]);

      $sql = "INSERT INTO customer (name, email, psw) VALUES ( '" . $_SESSION["name"] . "' ,'". $_SESSION["email"]." ','". $_SESSION["password"]. "');";
      $conn->query($sql);

      $conn->close();
    
    ?>
    
    <script>
    alert('New buyer account has been created'); 
    window.location.href= "login.php";
    </script>
    <?php
    }
    ?>

</body>
</html>