<?php
require 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    try {
        // Sanitize input
        $email = trim($_POST['email'] ?? '');
        $inputPassword = $_POST['passw'] ?? '';
        
        // Input validation
        if(empty($email) || empty($inputPassword)){
            throw new Exception('Email and password are required');
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid email format');
        }

        // Query users table using prepared statement
        $stmt = $conn->prepare("SELECT email, password FROM users WHERE email = ?");
        if(!$stmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("s", $email);
        if(!$stmt->execute()){
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            // Verify hashed password using password_verify
            if(password_verify($inputPassword, $row['password'])){
                $_SESSION["log"] = "yes";
                $_SESSION["uname"] = $row['email'];
                
                echo("<script language='javascript'>
                window.alert('Login Successful')
                window.location.href='bootstrap1.html'
                </script>");
                exit();
            }else{
                throw new Exception('Either the email or password is incorrect');
            }
        }else{
            throw new Exception('You do not have an account. Please create one');
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo("<script language='javascript'>
        window.alert('" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "')
        window.location.href='Login.html'
        </script>");
        exit();
    }
}
?>