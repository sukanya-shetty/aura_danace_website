<?php
require 'config.php';
require 'mailer-config.php'; // Load mailer configuration
require 'vendor/autoload.php'; // Load PHPMailer via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail(string $email, string $token): bool {
    try {
        $mail = new PHPMailer(true);
        
        // Server settings
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = MAIL_PORT;
        
        // Recipients
        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        $mail->addAddress($email);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password reset link from Aura Dance Academy';
        $resetLink = 'http://localhost/p/updatepassword.php?email=' . urlencode($email) . '&reset_token=' . urlencode($token);
        $mail->Body = "Hello,<br>We got a request from you to reset your password<br>
                      Click the link below:<br>
                      <a href='" . htmlspecialchars($resetLink, ENT_QUOTES, 'UTF-8') . "'>Reset Password</a>";
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("Mailer Error: " . $e->getMessage());
        return false;
    }
}

if(isset($_POST["forgotpass"])){
    try {
        // Sanitize input
        $email = trim($_POST['email'] ?? '');
        
        // Input validation
        if(empty($email)){
            throw new Exception('Email is required');
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid email format');
        }
        
        // Query using prepared statement
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        if(!$stmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("s", $email);
        if(!$stmt->execute()){
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        if($result->num_rows == 1){
            // Generate reset token
            $token = bin2hex(random_bytes(16));
            date_default_timezone_set("Asia/Kolkata");
            $resetDate = date("Y-m-d H:i:s");
            
            // Update user with reset token using prepared statement
            $updateStmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_at = ? WHERE email = ?");
            if(!$updateStmt){
                throw new Exception("Prepare failed: " . $conn->error);
            }
            
            $updateStmt->bind_param("sss", $token, $resetDate, $email);
            if(!$updateStmt->execute()){
                throw new Exception("Update failed: " . $updateStmt->error);
            }
            $updateStmt->close();
            
            // Send reset email
            if(sendMail($email, $token)){
                echo("<script language='javascript'>
                window.alert('Password reset link sent to your email')
                window.location.href='forgot.php'
                </script>");
                exit();
            }else{
                throw new Exception('Failed to send reset email. Please try again later.');
            }
        }else{
            throw new Exception('Email not found');
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        error_log("Password Reset Error: " . $e->getMessage());
        echo("<script language='javascript'>
        window.alert('" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "')
        window.location.href='forgot.php'
        </script>");
        exit();
    }
}
?>

