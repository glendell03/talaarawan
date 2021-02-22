<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';

if (isset($_POST["email"])){
        $emailTo = $_POST["email"];
        $code = uniqid(true);
        $query = mysqli_query($link,"INSERT INTO resetpass(code, email) VALUES('$code','$emailTo')");
        if (!$query){
            exit("Error");
        }
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'talaarawan00@gmail.com';                     //SMTP username
            $mail->Password   = 'passqtqt';                               //SMTP password
            $mail->SMTPSecure = `PHPMailer::ENCRYPTION_SMTPS`;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;   
           
            //Recipients
            $mail->setFrom('talaarawan00@gmail.com', 'TalaarawanAdmin');
            $mail->addAddress($emailTo);     //Add a recipient
            $mail->addReplyTo('no-reply@talaarawan.com', 'No reply');

 
            //Content
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetpass.php?code=$code";
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Your password reset link';
            $mail->Body    = "<h1>You requested a password reset</h1>
                            Click <a href='$url'>this link</a> to do so";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Reset password has been sent to your email';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error:', $mail->ErrorInfo;
        }
        exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <h1>forget password</h1>
        <input type="text" name="email" placeholder="Enter Email" autocomplete="on">
        <br>
        <input type="submit" name="submit" value="reset email">
    </form>
</body>
</html>
