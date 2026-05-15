<?php

$server='localhost';
 $uname='root';
 $password='';
 $db='aura_dance';
 $conn=new mysqli($server,$uname,$password,$db);

 if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
 }

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

 function sendMail(string $email, string $token){
   require('vendor/PHPMailer\phpmailer/src/PHPMailer.php');
   require('vendor/PHPMailer\phpmailer/src/SMTP.php');
   require('vendor/PHPMailer\phpmailer/src/Exception.php');

   $mail = new PHPMailer(true);
   try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sukanyadshetty879@gmail.com';                     //SMTP username
    $mail->Password   = 'hdvb kvme uhkv jvxm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('sandhyakotian2003@gmail.com', 'Aura academy');
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password reset link from Aura Dance Academy';
    $mail->Body    = "Hello,<br>We got a request from you to rest your password<br>
          Click the link below:<br>
          <a href='http://localhost/p/updatepassword.php?email=$email&reset_token=$token'>Reset Password</a>";

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
 }

 if(isset($_POST["forgotpass"])){
  $email=$_POST['email'];
  $query="SELECT * FROM users WHERE email='$email'";
  $result=mysqli_query($conn,$query);
  if($result){
    if(mysqli_num_rows($result)==1){
      $token=bin2hex(random_bytes(16));
      date_default_timezone_set("Asia/Kolkata");
      $ex=date("Y-m-d");
      $que="UPDATE users SET reset_token='$token' , reset_at='$ex' WHERE email='$email'";
      if(mysqli_query($conn,$que) && sendMail($email,$token)){
        echo("<script language='javascript'>
        window.alert('Password reset link sent to mail')
        window.location.href='forgot.php'
        </script>");
        exit();
      }else{
        echo("<script language='javascript'>
        window.alert('Server down.Try again Later')
        window.location.href='forgot.php'
        </script>");
        exit();
      }
    }
    else{
      echo("<script language='javascript'>
      window.alert('Email not found')
      window.location.href='forgot.php'
      </script>");
      exit();
    }
  }
  else{
    echo("<script language='javascript'>
    window.alert('Cannot run query')
    window.location.href='forgot.php'
    </script>");
    exit();
  }
 }

