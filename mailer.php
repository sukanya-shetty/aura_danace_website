<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__."/vendor/autoload.php";
$mail=new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth=true;

$mail->Host="smtp.gmail.com";
$mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port=587;
$mail->Username="sandhyadk2003@gmail.com";
$mail->Password="your-password";
$mail->isHTML(true);
return $mail;