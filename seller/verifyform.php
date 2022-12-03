<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./style/verify.css">
    </head>
    <body>
    <h2>book.lib</h2>
        <form class="container" action="<?php echo htmlspecialchars("./verify.php");?>" method="POST">
            <div class="hello hello1">Forgot Password</div>
            <label class="item-otp-label" for="otp" ><h5>Enter OTP</h5></label>
            <input class="item-otp-input" type="text" autofocus name="otp" required>
            <input class="item" type="submit" value="Enter OTP">
        </form>
    </body>
</html>