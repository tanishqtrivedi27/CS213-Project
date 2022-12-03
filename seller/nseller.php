<?php
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/newseller.css">
    </head>
    <body>
        <h2>book.lib</h2>
        <form class="container" action="<?php echo htmlspecialchars("./newseller.php");?>" method="POST">

            <div class="hello-create hello1">Create account</div>
            <label class="item-name-label" for="name" ><h5>Name</h5></label>
            <input class="item-name-input" type="text" name="name" autofocus required>
            <label class="item-email-label" for="email" ><h5>E-mail</h5></label>
            <input class="item-email-input" id="em" type="email" name="email"  required>
            <label class="item-pass-label" for="password" ><h5>Password</h5></label>
            <input class="item-pass-input" id="pas" type="password" name="password"  required>
            <label class="item-address-label" for="street"><h5>House No. / Street</h5></label>
            <input class="item-address-input" type="text" name="street" required>
            <label class="item-city-label" for="city" ><h5>City</h5></label>
            <input class="item-city-input" type="text" name="city" required>
            <label class="item-state-label" for="state" ><h5>State</h5></label>
            <input class="item-state-input" type="text" name="state" required>
            <label class="item-pin-label" for="pin" ><h5>ZIP code</h5></label>
            <input class="item-pin-input" type="number" pattern="[0-9]{6}" name="pin" required>
            <!-- <input class="item" onclick="addit()" type="submit" value="Sign In" name="signin"> -->
            <input class="item" type="submit" name="signup" value="CREATE NEW ACCOUNT">
            <div class="hello-account hello2" >Already have an account? <a class="customize"
             href="<?php echo htmlspecialchars("./slogin.php"); ?>">Sign In</a></div>
        </form>
        <!-- onclick="removeit()" -->
        <!-- <script>
            function removeit(){
                let a = document.getElementById("em");
                let b = document.getElementById("pas");
                a.removeAttribute('required');
                b.removeAttribute('required');
            }

            function addit() {
                let a = document.getElementById("em");
                let b = document.getElementById("pas");
                a.setAttribute('required', '');
                b.setAttribute('required', '');
            }
            
        </script> -->
    </body>
</html>