<?php
 $server="localhost";
 $uname="root";
 $password="";
$db='aura_dance';
 
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
    $sql="SELECT cat_id FROM category WHERE cat='$cat'";
    $result=$conn->query($sql);
    if($result->num_rows==1){
        // Check if course already exists
        $check = "SELECT course_id FROM courses WHERE course_name='$form' AND category='$cat'";
        $table_result = $conn->query($check);
        if ($table_result->num_rows > 0) {
            echo("<script language='javascript'>
            window.alert('Dance Form already exists')
            window.location.href='studentform.php'
            </script>");
            exit();
            }else{
                // Insert course into courses table
                $sq="INSERT INTO courses(course_name, category, instructor_name, duration, fee) VALUES('$form','$cat','$form','$dur','$amt')";
                if($conn->query($sq)===TRUE){
                    echo("<script language='javascript'>
                    window.alert('Dance Form is added successfully')
                    window.location.href='studentform.php'
                    </script>");
                    exit();
                }else{
                    echo("Error: ".$sq."<br>".$conn->error);
                    exit();
                }
            }
        }
    }else{
            echo("<script language='javascript'>
            window.alert('Dance category does not exist.Please add the category first.')
            window.location.href='studentform.php'
            </script>");
            exit();
    }
 
 ?>