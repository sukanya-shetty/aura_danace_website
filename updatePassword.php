<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
         *{
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}
body {
    background-color: #ff99f5;
    /*background-image:url('pikaso_texttoimage_light-purple-color-themed-background.jpeg');*/
    background-repeat: no-repeat;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10rem 0;
    height: 500px;
}
.card {
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    background-color: rgba(0, 0, 0, 0.75);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.125);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 30px 40px;
    height: 300px;
}
.lock-icon {
    font-size: 3rem;
}
h2 {
    font-size: 1.5rem;
    margin-top: 10px;
    text-transform: uppercase;
}
p {
    font-size: 12px;
}
.passInput {
    margin-top: 15px;
    width: 80%;
    background: transparent;
    border: none;
    border-bottom: 2px solid deepskyblue;
    font-size: 15px;
    color: white;
    outline: none;
}
button {
    margin-top: 15px;
    width: 80%;
    background-color: deepskyblue;
    color: white;
    padding: 10px;
    text-transform: uppercase;
}

input[type="submit"]{
    font-size: 20px;
    border: none;
    outline: none;
    background: deepskyblue;
    padding: 5px;
    margin-top: 40px;
    border-radius: 90px;
    font-weight: 600;
    cursor: pointer;
    width: 350px;
    color: white;
}

input[type="submit"]:active{
    background: linear-gradient(90deg,#45f3ff,#d9138a);
    opacity: 0.8;
}
</style>
</head>
<body>
<img src="tiktok-dance-unscreen-ezgif.com-resize.gif" alt=""  style="margin-left: -15%;">
<?php
require 'config.php';

try {
     if($_GET['email'] && isset($_GET['reset_token'])){
        $email=$_GET['email'];
        $token=$_GET['reset_token'];
        date_default_timezone_set("Asia/Kolkata");
        
        // Sanitize inputs
        $email = isset($_GET['email']) ? trim($_GET['email']) : '';
        $token = isset($_GET['reset_token']) ? trim($_GET['reset_token']) : '';
        
        // Validate inputs
        if(empty($email) || empty($token) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid reset link');
        }
        
        $date = date("Y-m-d");
        
        // Query using prepared statement
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? AND reset_token = ? AND reset_at >= DATE_SUB(NOW(), INTERVAL 1 DAY)");
        if(!$stmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("ss", $email, $token);
        if(!$stmt->execute()){
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        if($result->num_rows == 1){
            // Display form
            $emailEscaped = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            
            echo "<div class='card'>
            <p class='lock-icon'><i class='fas fa-lock'></i></p>
            <h1>Create New Password</h1>
            <p>You can reset your Password here</p><br>
            <form method='post' action=''>
              <h3>Enter New Password</h3>
              <input type='password' placeholder='New Password' name='password' required minlength='6'>
              <button type='submit' name='updatepassword'>Update</button>
              <input type='hidden' name='email' value='" . $emailEscaped . "'>
              <input type='hidden' name='token' value='" . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . "'>
            </form>
            </div>";
        }else{
            throw new Exception('Invalid or Expired Link');
        }
        
        $stmt->close();
    }
} catch (Exception $e) {
     error_log("Password Reset Error: " . $e->getMessage());
     echo("<script language='javascript'>
     window.alert('" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "')
     window.location.href='forgot.php'
     </script>");
     exit();
}
     ?>

     <?php
     if(isset($_POST['updatepassword'])){
        try {
            // Sanitize input
            $newPassword = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';
            $token = $_POST['token'] ?? '';
            
            // Validation
            if(empty($newPassword) || empty($email) || empty($token)){
                throw new Exception('All fields are required');
            }
            
            if(strlen($newPassword) < 6){
                throw new Exception('Password must be at least 6 characters');
            }
            
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                throw new Exception('Invalid email');
            }
            
            // Verify token and email match before updating
            $verifyStmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? AND reset_token = ?");
            if(!$verifyStmt){
                throw new Exception("Prepare failed");
            }
            
            $verifyStmt->bind_param("ss", $email, $token);
            if(!$verifyStmt->execute()){
                throw new Exception("Verification failed");
            }
            
            $verifyResult = $verifyStmt->get_result();
            if($verifyResult->num_rows != 1){
                throw new Exception('Invalid reset link');
            }
            $verifyStmt->close();
            
            // Hash new password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            
            // Update password using prepared statement
            $updateStmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_at = NULL WHERE email = ?");
            if(!$updateStmt){
                throw new Exception("Prepare failed");
            }
            
            $updateStmt->bind_param("ss", $hashedPassword, $email);
            if(!$updateStmt->execute()){
                throw new Exception("Update failed");
            }
            $updateStmt->close();
            
            echo("<script language='javascript'>
            window.alert('Password reset successful. Please login with your new password.')
            window.location.href='Login.html'
            </script>");
            exit();
            
        } catch (Exception $e) {
            error_log("Password Update Error: " . $e->getMessage());
            echo("<script language='javascript'>
            window.alert('" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "')
            window.location.href='forgot.php'
            </script>");
            exit();
        }
     }
     ?>
</body>
</html>