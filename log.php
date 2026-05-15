<?php
session_start();
$server='localhost';
$uname='root';
$password='';
$db='aura_dance';
$conn=new mysqli($server,$uname,$password,$db);

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $name=$_POST['uname'];
    $email=$_POST['email'];
    $phone=$_POST['mno'];
    $inputPassword=$_POST['password'];
    $cpass=$_POST['cpass'];
    
    if($cpass!==$inputPassword){
        echo("<script language='javascript'>
        window.alert('Confirm password and password does not match')
        window.location.href='Login.html'
        </script>");
        exit();
    }

    // Check if user already exists in users table
    $checkUser="SELECT user_id FROM users WHERE email='$email'";
    $result=$conn->query($checkUser);
    if($result->num_rows==1){
        echo("<script language='javascript'>
        window.alert('The account already exists. Login directly')
        window.location.href='Login.html'
        </script>");
        exit();
    }else{
        // Hash password for security using BCRYPT
        $hashedPassword = password_hash($inputPassword, PASSWORD_BCRYPT);
        
        // Create user account in users table with hashed password
        $createUser="INSERT INTO users(username, email, password, created_date) VALUES('$name', '$email', '$hashedPassword', NOW())";
        if($conn->query($createUser)===TRUE){
            $_SESSION["log"]="yes";
            $_SESSION["uname"]=$email;
            echo("<script language='javascript'>
            window.alert('Sign-up successful')
            window.location.href='bootstrap1.html'
            </script>");
            exit(); 
        }else{
            echo "Error: ".$conn->error;
        }
    }
}else{
    header("Location:Login.html");
    exit();
}
?>