<?php
require 'config.php';

if(isset($_GET['course_id'])) {
    $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
    
    if($course_id <= 0) {
        die("Invalid course ID");
    }
    
    try {
        // Delete in order: enrollments -> payments -> course (foreign key constraints)
        
        // Delete all enrollments for this course using prepared statement
        $stmt = $conn->prepare("DELETE FROM enrollments WHERE course_id = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $course_id);
        if(!$stmt->execute()) {
            throw new Exception("Enrollment deletion failed: " . $stmt->error);
        }
        $stmt->close();
        
        // Delete all payments for this course using prepared statement
        $stmt = $conn->prepare("DELETE FROM payments WHERE course_id = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $course_id);
        if(!$stmt->execute()) {
            throw new Exception("Payment deletion failed: " . $stmt->error);
        }
        $stmt->close();
        
        // Delete the course using prepared statement
        $stmt = $conn->prepare("DELETE FROM courses WHERE course_id = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $course_id);
        if(!$stmt->execute()) {
            throw new Exception("Course deletion failed: " . $stmt->error);
        }
        $stmt->close();
        
        echo "<script language='javascript'>
        window.alert('Course deleted successfully')
        window.location.href='studentform.php'
        </script>";
        exit;
    } catch (Exception $e) {
        error_log("Course deletion error: " . $e->getMessage());
        echo "<script language='javascript'>
        window.alert('Error deleting course. Please try again later.')
        window.location.href='studentform.php'
        </script>";
        exit;
    }
}

$conn->close();
?>
