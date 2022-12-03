<?php
    session_start();

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    require 'includes/Exception.php';
    require 'includes/PHPMailer.php';
    require 'includes/SMTP.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "otpform.php"))
    {
        $conn = new mysqli("localhost", "root", "", "booklib");
        $_SESSION["email"]=test_input($_POST["email"]);
        $sql="SELECT * FROM seller where semail='".$_SESSION["email"]."'";
        $result = $conn->query($sql);
        if($result -> num_rows > 0)
        {
            $row = $result -> fetch_assoc();
            $_SESSION["sid"] = $row["sid"];
            $_SESSION["sname"] = $row["sname"];
            $_SESSION["otp"] = rand(100000, 999999);
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.elasticemail.com';
            $mail->Port = 2525;
            $mail->Username = 'cebajel@gmail.com';
            $mail->Password = 'D0F09B41310E10B8C0037AD966F23FD74C7B';
            // D0F09B41310E10B8C0037AD966F23FD74C7B
            $mail->setFrom('cebajel@gmail.com');
            $mail->addAddress($_SESSION["email"]);
            $mail->Subject = 'OTP to change password';
            $mail->Body = 'Your otp is '.$_SESSION["otp"].'';
            if (!$mail->Send()) {
                echo "ERROR: " . $mail->ErrorInfo;
            } else {
                echo "SUCCESS";
            }
            $mail->smtpClose();
            $conn->close();
            header("Location:./verifyform.php");
        }
        else
        {
            header("Location:./otpform.php");
        }
    }
    else {
		echo "Unauthenticated access";
	}
?>