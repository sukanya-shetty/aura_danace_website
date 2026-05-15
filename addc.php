<?php
 $server="localhost";
 $uname="root";
 $password="";
 $db="aura_dance";
 
 $conn=new mysqli($server,$uname,$password,$db);
 if($conn->connect_error)
 {
     die("Connection failed:".$conn->connect_error);
 }

 if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["cat"])){
    $cat=$_POST["categ"];
    $context=$_POST["context"];
    $sql="SELECT * FROM category WHERE cat='$cat'";
    $result=$conn->query($sql);
    if($result->num_rows==1){
        echo("<script language='javascript'>
        window.alert('The Dance category already exists')
        window.location.href='studentform.php'
        </script>");
        exit();
    }else{
        $sqli="INSERT INTO category(cat,context)VALUES('$cat','$context')";
        if($conn->query($sqli)===TRUE){
            echo("<script language='javascript'>
            window.alert('Dance added successfully')
            window.location.href='studentform.php'
            </script>");
            exit();
        }
    }
 }

 ?>