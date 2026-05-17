<?php
require 'config.php';

if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["addform"])){
    $cat = isset($_POST["cat"]) ? trim($_POST["cat"]) : '';
    $form = isset($_POST["form"]) ? trim($_POST["form"]) : '';
    $amt = isset($_POST["amt"]) ? trim($_POST["amt"]) : '';
    $dur = isset($_POST["dur"]) ? trim($_POST["dur"]) : '';
    $con = isset($_POST["con"]) ? trim($_POST["con"]) : '';
    $img = isset($_POST["img"]) ? trim($_POST["img"]) : '';
    
    // Validate input
    if(empty($cat) || empty($form) || empty($amt) || empty($dur)) {
        echo("<script language='javascript'>
        window.alert('Please fill in all required fields')
        window.location.href='studentform.php'
        </script>");
        exit();
    }
    
    // Validate numeric fields
    if(!is_numeric($amt) || !is_numeric($dur)) {
        echo("<script language='javascript'>
        window.alert('Amount and Duration must be numeric')
        window.location.href='studentform.php'
        </script>");
        exit();
    }
    
    try {
        // Check if category exists using prepared statement
        $stmt = $conn->prepare("SELECT cat_id FROM category WHERE cat = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $cat);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        
        if($result->num_rows == 0) {
            echo("<script language='javascript'>
            window.alert('Dance category does not exist. Please add the category first.')
            window.location.href='studentform.php'
            </script>");
            exit();
        }
        $stmt->close();
        
        // Check if course already exists using prepared statement
        $stmt = $conn->prepare("SELECT course_id FROM courses WHERE course_name = ? AND category = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $form, $cat);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $check_result = $stmt->get_result();
        
        if($check_result->num_rows > 0) {
            echo("<script language='javascript'>
            window.alert('This dance form already exists in this category')
            window.location.href='studentform.php'
            </script>");
            $stmt->close();
            exit();
        }
        $stmt->close();
        
        // Insert course using prepared statement
        // NOTE: This replaces the old dynamic table creation method
        // All course data is now centralized in the 'courses' table
        $stmt = $conn->prepare("INSERT INTO courses(course_name, category, instructor_name, duration, fee) VALUES(?, ?, ?, ?, ?)");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("sssii", $form, $cat, $form, $dur, $amt);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        echo("<script language='javascript'>
        window.alert('Dance form added successfully')
        window.location.href='studentform.php'
        </script>");
        $stmt->close();
        exit();
    } catch (Exception $e) {
        error_log("Course addition error: " . $e->getMessage());
        echo("<script language='javascript'>
        window.alert('An error occurred. Please try again later.')
        window.location.href='studentform.php'
        </script>");
        exit();
    }
 }

 ?>
