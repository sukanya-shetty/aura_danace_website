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

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_id = isset($_POST['cat_id']) ? $_POST['cat_id'] : '';
    $categ = isset($_POST['categ']) ? $_POST['categ'] : '';
    $context = isset($_POST['context']) ? $_POST['context'] : '';
    
    if($cat_id && $categ && $context) {
        $sql = "UPDATE category SET cat='$categ', context='$context' WHERE cat_id=$cat_id";
        if($conn->query($sql)) {
            header("Location: studentform.php");
            exit;
        } else {
            echo "Error updating category: " . $conn->error;
        }
    }
}
$conn->close();
?>
