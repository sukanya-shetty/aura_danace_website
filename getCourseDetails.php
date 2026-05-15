<?php
$server="localhost";
$uname="root";
$password="";
$db="aura_dance";

$conn=new mysqli($server,$uname,$password,$db);
if($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed']));
}

if(isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $sql = "SELECT course_id, course_name, instructor_name, duration, fee FROM courses WHERE course_id=$course_id";
    $result = $conn->query($sql);
    
    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Course not found']);
    }
} else {
    echo json_encode(['error' => 'Course ID not provided']);
}

$conn->close();
?>
