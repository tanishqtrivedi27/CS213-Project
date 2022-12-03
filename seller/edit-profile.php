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
        
    </head>
    <body>
        <div class="p-16">
        <span class="text-xl font-bold"> Enter your credentials: <br> </span>
        <form action ="update-profile.php" method="post">
            <label class="font-bold" for="name">Name:</label><br>
            <input class="border-x border-y border-black my-px" type="text" name="name" id="name" value="<?php echo $_SESSION["name"] ?>" required><br>

            <label class="font-bold" for="email">Email:</label><br>
            <input class="border-x border-y border-black my-px" type="email" name="email" id="email" value="<?php echo $_SESSION["email"] ?>" required><br>

            <label class="font-bold" for="pwd">Password:</label><br>
            <input class="border-x border-y border-black my-px" type="password" name="pwd" id="pwd" value="<?php echo $_SESSION["password"] ?>" required><br>

            <label class="font-bold" for="confpwd">Confirm Password:</label><br>
            <input class="border-x border-y border-black my-px" type="password" name="confpwd" id="confpwd" required><br>

            <label class="font-bold" for="street">Street:</label><br>
            <input class="border-x border-y border-black my-px" type="text" name="street" id="street" value="<?php echo $_SESSION["street"] ?>" required><br>

            <label class="font-bold" for="city">City:</label><br>
            <input class="border-x border-y border-black my-px" type="text" name="city" id="city" value="<?php echo $_SESSION["city"] ?>" required><br>

            <label class="font-bold" for="state">State:</label><br>
            <input class="border-x border-y border-black my-px" type="text" name="state" id="state" value="<?php echo $_SESSION["state"] ?>" required><br>

            <label class="font-bold" for="postalcode">Post Code:</label><br>
            <input class="border-x border-y border-black my-px" type="text" name="postalCode" id="postalcode" value="<?php echo $_SESSION["postalCode"] ?>" required><br>

            <input class="border-x border-y border-black bg-orange-500 px-2" type="submit" value="Submit">
        </form>
        </div>
    </body>
</html>