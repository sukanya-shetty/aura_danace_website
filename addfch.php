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

if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["addform"])){
    $cat=$_POST["cat"];
    $form=$_POST["form"];
    $amt=$_POST["amt"];
    $dur=$_POST["dur"];
    $con=$_POST["con"];
    $img=$_POST["img"];
    $sql="SELECT cat FROM category WHERE cat='$cat'";
    $result=$conn->query($sql);
    if($result->num_rows==1){
        $check = "SHOW TABLES LIKE '$cat'";
        $table_result = $conn->query($check);
        if ($table_result->num_rows > 0) {
            $sqlii="SELECT * FROM $cat WHERE form='$form'";
            $res=$conn->query($sqlii);
            if($res->num_rows==1){
                echo("<script language='javascript'>
                window.alert('Dance Form already exists')
                window.location.href='studentform.php'
                </script>");
                exit();
            }else{
                $sq="INSERT INTO $cat(form,amt,dur,con,img) VALUES('$form','$amt','$dur','$con','$img')";
                if($conn->query($sq)===TRUE){
                    $sqliii = "CREATE TABLE `aura_dance`.`$form` (
                       `id`  INT(30) AUTO_INCREMENT PRIMARY KEY,
                        `name` VARCHAR(20) NOT NULL,
                        `amt` VARCHAR(10),
                        `mno` VARCHAR(100),
                        `addr` VARCHAR(200),
                        `email`  VARCHAR(30),
                         `gender` VARCHAR(10),
                         `age` INT(10),
                         `level` VARCHAR(10),
                        `district` VARCHAR(10),
                    )";
                    $conn->query($sqliii);
                    echo("<script language='javascript'>
                    window.alert('Dance Form is added')
                    window.location.href='studentform.php'
                    </script>");
                    exit();
                }
            }
        } else{
            $sqli = "CREATE TABLE `aura_dance`.`$cat` (
                `form` VARCHAR(20) NOT NULL,
                `amt` VARCHAR(10),
                `dur` VARCHAR(10),
                `con` VARCHAR(100),
                `img` VARCHAR(200)
            )";
            if($conn->query($sqli)===TRUE){
                    $sq="INSERT INTO $cat(form,amt,dur,con,img) VALUES('$form','$amt','$dur','$con','$img')";
                    if($conn->query($sq)===TRUE){
                        $sqliii = "CREATE TABLE `aura_dance`.`$form` (
                            `id`  INT(30) AUTO_INCREMENT PRIMARY KEY,
                            `name` VARCHAR(20) NOT NULL,
                            `amt` VARCHAR(10),
                            `mno` VARCHAR(100),
                            `addr` VARCHAR(200),
                            `email`  VARCHAR(30),
                           `gender` VARCHAR(10),
                           `age` INT(10),
                           `level` VARCHAR(10),
                          `district` VARCHAR(10)
                        )";
                        $conn->query($sqliii);
                        echo("<script language='javascript'>
                        window.alert('Dance Form is added')
                        window.location.href='studentform.php'
                        </script>");
                        exit();
                    }else{
                        echo("Error".$sq."<br>".$conn->error);
                    }
            }else{
                echo("Error creating table<br>".$conn->error);
            }
        }
    }else{
            echo("<script language='javascript'>
            window.alert('Dance category does not exist.Please add the category first.')
            window.location.href='studentform.php'
            </script>");
            exit();
    }
 }
 ?>