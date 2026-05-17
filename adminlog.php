<?php
session_start();
require 'config.php';
 
if($_SERVER["REQUEST_METHOD"]==="POST"){
    try {
        // Sanitize input
        $name = trim($_POST['uname'] ?? '');
        $inputPassword = $_POST['password'] ?? '';
        
        // Input validation
        if(empty($name) || empty($inputPassword)){
            throw new Exception('Username and password are required');
        }

        // Query using prepared statement
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
        if(!$stmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("s", $name);
        if(!$stmt->execute()){
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        $adresult = $stmt->get_result();
        
        if($adresult->num_rows == 1){
            $row = $adresult->fetch_assoc();
            // Verify hashed password using password_verify
            if(password_verify($inputPassword, $row['password'])){
                $_SESSION['uname'] = $name;
                
                echo("<script language='javascript'>
                window.alert('Login Successful')
                window.location.href='adminpanel.php'
                </script>");
                exit();
            }else{
                throw new Exception('Either the username or password is incorrect');
            }
        }else{
            throw new Exception('Admin account not found');
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo("<script language='javascript'>
        window.alert('" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "')
        window.location.href='ww.html'
        </script>");
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 300px;
        }
        .login-container h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }
        button {
            width: 100%;
            padding: 10px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="uname" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>