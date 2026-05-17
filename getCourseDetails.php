<?php
require 'config.php';

if(isset($_GET['course_id'])) {
    $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
    
    if($course_id <= 0) {
        echo json_encode(['error' => 'Invalid course ID']);
        exit();
    }
    
    try {
        $stmt = $conn->prepare("SELECT course_id, course_name, instructor_name, duration, fee FROM courses WHERE course_id = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $course_id);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        
        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Course not found']);
        }
        $stmt->close();
    } catch (Exception $e) {
        error_log("Course retrieval error: " . $e->getMessage());
        echo json_encode(['error' => 'An error occurred']);
    }
} else {
    echo json_encode(['error' => 'Course ID not provided']);
}

$conn->close();
?>
