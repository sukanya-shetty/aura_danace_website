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

if(isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    
    $sql = "DELETE FROM category WHERE cat_id=$cat_id";
    if($conn->query($sql)) {
        header("Location: studentform.php");
        exit;
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

$conn->close();
?>
