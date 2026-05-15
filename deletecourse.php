<?php
$server="localhost";
$uname="root";
$password="";
$db="aura_dance";

$conn=new mysqli($server,$uname,$password,$db);
if($conn->connect_error) {
    die("Connection failed:".$conn->connect_error);
}

if(isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    
    // First, delete all enrollments for this course
    $deleteEnrollments = "DELETE FROM enrollments WHERE course_id=$course_id";
    $conn->query($deleteEnrollments);
    
    // Then delete all payments for this course
    $deletePayments = "DELETE FROM payments WHERE course_id=$course_id";
    $conn->query($deletePayments);
    
    // Finally, delete the course
    $sql = "DELETE FROM courses WHERE course_id=$course_id";
    if($conn->query($sql)) {
        echo "<script language='javascript'>
        window.alert('Course deleted successfully')
        window.location.href='studentform.php'
        </script>";
        exit;
    } else {
        echo "Error deleting course: " . $conn->error;
    }
}

$conn->close();
?>
