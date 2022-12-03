<?php
    if (isset($_SESSION)) {
        session_destroy();
    }
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/seller.css">
    </head>
    <body>
        <h2>book.lib</h2>
        <form class="container" action="<?php echo htmlspecialchars("./sellerlogin.php");?>" method="POST">

            <div class="hello hello1">Sign-In</div>
            <label class="item-email-label" for="email" ><h5>E-mail</h5></label>
            <input class="item-email-input" id="em" type="email" autofocus name="email"  required>
            <label class="item-pass-label" for="password" ><h5>Password</h5></label>
            <input class="item-pass-input" id="pas" type="password" name="password"  required>
            <input class="item" onclick="addit()" type="submit" value="Sign In" name="signin">
            <input class="item" type="submit" onclick="removeit()" name="signup" value="CREATE NEW ACCOUNT"
             formaction="<?php echo htmlspecialchars("./nseller.php");?> ">
             <div class="hello-account hello2" >
                <a class="customize" href="<?php echo htmlspecialchars("./otpform.php"); ?>">Forgot Password?</a></div>
        </form>
        <script>
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
            
        </script>
    </body>
</html>