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
    $email=$_POST['email'];
    $inputPassword=$_POST['passw'];

    // Query users table instead of students table
    $query="SELECT email, password FROM users WHERE email='$email'";
    $result=$conn->query($query);
    
    if($result->num_rows==1){
        $row=$result->fetch_assoc();
        // Verify hashed password using password_verify
        if(password_verify($inputPassword, $row['password'])){
            $_SESSION["log"]="yes";
            $_SESSION["uname"]=$row['email'];
            echo("<script language='javascript'>
            window.alert('Login Successful')
            window.location.href='bootstrap1.html'
            </script>");
            exit();
        }else{
            echo("<script language='javascript'>
            window.alert('Either the email or password is incorrect please re-enter')
            window.location.href='Login.html'
            </script>");
            exit();
        }
    }else{
        echo("<script language='javascript'>
        window.alert('You do not have an account. Please create one')
        window.location.href='Login.html'
        </script>");
        exit(); 
    }
}
?>