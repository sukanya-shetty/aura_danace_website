<?php
require 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    try {
        // Sanitize input
        $name = trim($_POST['uname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['mno'] ?? '');
        $inputPassword = $_POST['password'] ?? '';
        $cpass = $_POST['cpass'] ?? '';
        
        // Input validation
        if(empty($name) || empty($email) || empty($inputPassword) || empty($cpass)){
            throw new Exception('All fields are required');
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid email format');
        }
        
        if(strlen($inputPassword) < 6){
            throw new Exception('Password must be at least 6 characters');
        }
        
        if($cpass !== $inputPassword){
            throw new Exception('Confirm password and password does not match');
        }

        // Check if user already exists using prepared statement
        $checkStmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        if(!$checkStmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $checkStmt->bind_param("s", $email);
        if(!$checkStmt->execute()){
            throw new Exception("Execute failed: " . $checkStmt->error);
        }
        $result = $checkStmt->get_result();
        
        if($result->num_rows >= 1){
            throw new Exception('The account already exists. Login directly');
        }
        $checkStmt->close();
        
        // Hash password for security using BCRYPT
        $hashedPassword = password_hash($inputPassword, PASSWORD_BCRYPT);
        
        // Create user account using prepared statement
        $createStmt = $conn->prepare("INSERT INTO users(username, email, password, created_date) VALUES(?, ?, ?, NOW())");
        if(!$createStmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $createStmt->bind_param("sss", $name, $email, $hashedPassword);
        
        if(!$createStmt->execute()){
            throw new Exception("Account creation failed. Please try again.");
        }
        
        $createStmt->close();
        
        // Set session
        $_SESSION["log"] = "yes";
        $_SESSION["uname"] = $email;
        
        echo("<script language='javascript'>
        window.alert('Sign-up successful')
        window.location.href='bootstrap1.html'
        </script>");
        exit();
        
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo("<script language='javascript'>
        window.alert('" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "')
        window.location.href='Login.html'
        </script>");
        exit();
    }
}else{
    header("Location:Login.html");
    exit();
}
?>