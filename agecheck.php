<?php
require 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try {
        // Sanitize all inputs
        $name = trim($_POST["name"] ?? '');
        $mno = trim($_POST["mno"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $addr = trim($_POST["addr"] ?? '');
        $dis = trim($_POST["dis"] ?? '');
        $age = intval($_POST["age"] ?? 0);
        $courseName = trim($_POST["form"] ?? '');
        $amt = floatval($_POST["amt"] ?? 0);
        $level = trim($_POST["level"] ?? '');
        $gender = trim($_POST["gender"] ?? '');
        
        // Validate inputs
        if(empty($name) || empty($email) || empty($mno) || empty($addr) || empty($dis) || $age <= 0 || empty($courseName) || empty($level) || empty($gender)){
            throw new Exception('All fields are required');
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid email format');
        }
        
        if(strlen($mno) != 10 || !is_numeric($mno)){
            throw new Exception('Mobile number must be 10 digits');
        }
        
        // Age validation
        if($age < 15){
            throw new Exception('You must be at least 15 years old to register for this course');
        }
        
        // District validation
        if(strtolower($dis) != "udupi"){
            throw new Exception('We are really sorry our academy is situated at Udupi. We regret to tell you that you cannot register with us');
        }
        
        // Check if student already exists using prepared statement
        $checkStmt = $conn->prepare("SELECT student_id FROM students WHERE email = ?");
        if(!$checkStmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $checkStmt->bind_param("s", $email);
        if(!$checkStmt->execute()){
            throw new Exception("Execute failed: " . $checkStmt->error);
        }
        
        $result = $checkStmt->get_result();
        $student_id = null;
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $student_id = $row['student_id'];
        } else {
            // Create new student record using prepared statement
            $createStmt = $conn->prepare("INSERT INTO students(name, email, phone, address, district, age, gender, enrollment_date) VALUES(?, ?, ?, ?, ?, ?, ?, NOW())");
            if(!$createStmt){
                throw new Exception("Prepare failed: " . $conn->error);
            }
            
            $createStmt->bind_param("sssssss", $name, $email, $mno, $addr, $dis, $age, $gender);
            if(!$createStmt->execute()){
                throw new Exception("Student creation failed: " . $createStmt->error);
            }
            
            $student_id = $conn->insert_id;
            $createStmt->close();
        }
        
        $checkStmt->close();
        
        // Get course_id from courses table using course name (prepared statement)
        $courseStmt = $conn->prepare("SELECT course_id FROM courses WHERE course_name = ?");
        if(!$courseStmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $courseStmt->bind_param("s", $courseName);
        if(!$courseStmt->execute()){
            throw new Exception("Execute failed: " . $courseStmt->error);
        }
        
        $courseResult = $courseStmt->get_result();
        
        if($courseResult->num_rows > 0) {
            $courseRow = $courseResult->fetch_assoc();
            $course_id = $courseRow['course_id'];
        } else {
            throw new Exception('Course not found. Please try again.');
        }
        
        $courseStmt->close();
        
        // Store enrollment data in session for use by pay.php
        $_SESSION['enrollment_data'] = array(
            'student_id' => intval($student_id),
            'course_id' => intval($course_id),
            'amount' => floatval($amt),
            'level' => $level
        );
        
        // Redirect to payment page
        header("Location: pay.php");
        exit();
        
    } catch (Exception $e) {
        error_log("Age Check Error: " . $e->getMessage());
        echo("<script language='javascript'>
        window.alert('" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "')
        window.location.href='dancecat.php'
        </script>");
        exit();
    }
}
?>