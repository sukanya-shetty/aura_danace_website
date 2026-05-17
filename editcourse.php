<?php
require 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
    $course_name = isset($_POST['course_name']) ? trim($_POST['course_name']) : '';
    $instructor_name = isset($_POST['instructor_name']) ? trim($_POST['instructor_name']) : '';
    $duration = isset($_POST['duration']) ? intval($_POST['duration']) : 0;
    $fee = isset($_POST['fee']) ? intval($_POST['fee']) : 0;
    
    // Validate input
    if($course_id <= 0 || empty($course_name) || empty($instructor_name) || $duration <= 0 || $fee <= 0) {
        echo "<script language='javascript'>
        window.alert('Invalid input. Please fill in all fields correctly.')
        window.location.href='studentform.php'
        </script>";
        exit();
    }
    
    try {
        // Update course using prepared statement
        $stmt = $conn->prepare("UPDATE courses SET course_name = ?, instructor_name = ?, duration = ?, fee = ? WHERE course_id = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssiii", $course_name, $instructor_name, $duration, $fee, $course_id);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        
        echo "<script language='javascript'>
        window.alert('Course updated successfully')
        window.location.href='studentform.php'
        </script>";
        exit;
    } catch (Exception $e) {
        error_log("Course update error: " . $e->getMessage());
        echo "<script language='javascript'>
        window.alert('Error updating course. Please try again later.')
        window.location.href='studentform.php'
        </script>";
        exit;
    }
}
$conn->close();
?>
