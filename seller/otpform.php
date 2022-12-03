<?php
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/otp.css">
    </head>
    <body>
    <h2>book.lib</h2>
        <form class="container" action="<?php echo htmlspecialchars("./otp.php");?>" method="POST">
            <div class="hello hello1">Forgot Password</div>
            <label class="item-email-label" for="email" ><h5>E-mail</h5></label>
            <input class="item-email-input" id="em" type="email" autofocus name="email"  required>
            <input class="item" type="submit" value="Send OTP" name="otp">
        </form>
    </body>
</html>