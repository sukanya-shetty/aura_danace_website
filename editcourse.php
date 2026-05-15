<?php
$server="localhost";
$uname="root";
$password="";
$db="aura_dance";

$conn=new mysqli($server,$uname,$password,$db);
if($conn->connect_error) {
    die("Connection failed:".$conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : '';
    $course_name = isset($_POST['course_name']) ? $_POST['course_name'] : '';
    $instructor_name = isset($_POST['instructor_name']) ? $_POST['instructor_name'] : '';
    $duration = isset($_POST['duration']) ? $_POST['duration'] : '';
    $fee = isset($_POST['fee']) ? $_POST['fee'] : '';
    
    if($course_id && $course_name && $instructor_name && $duration && $fee) {
        $sql = "UPDATE courses SET course_name='$course_name', instructor_name='$instructor_name', duration='$duration', fee='$fee' WHERE course_id=$course_id";
        if($conn->query($sql)) {
            echo "<script language='javascript'>
            window.alert('Course updated successfully')
            window.location.href='studentform.php'
            </script>";
            exit;
        } else {
            echo "Error updating course: " . $conn->error;
        }
    }
}
$conn->close();
?>
