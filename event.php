
<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Sanitize form data
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $district = trim($_POST['district'] ?? '');
        $state = trim($_POST['state'] ?? '');
        $preferredDate = trim($_POST['preferredDate'] ?? '');
        $birthdayKidName = trim($_POST['birthdayKidName'] ?? '');
        $ageTurning = intval($_POST['ageTurning'] ?? 0);
        
        // Validation
        if(empty($name) || empty($email) || empty($phone) || empty($district) || empty($state) || empty($preferredDate)){
            throw new Exception('All fields are required');
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid email format');
        }
        
        $amount = 500;
        
        // Check if student exists or create one (prepared statement)
        $studentStmt = $conn->prepare("SELECT student_id FROM students WHERE email = ?");
        if(!$studentStmt){
            throw new Exception("Prepare failed");
        }
        
        $studentStmt->bind_param("s", $email);
        if(!$studentStmt->execute()){
            throw new Exception("Execute failed");
        }
        
        $studentResult = $studentStmt->get_result();
        $student_id = null;
        
        if($studentResult->num_rows > 0) {
            $row = $studentResult->fetch_assoc();
            $student_id = $row['student_id'];
        } else {
            // Create new student record using prepared statement
            $createStmt = $conn->prepare("INSERT INTO students(name, email, phone, address, district, enrollment_date) VALUES(?, ?, ?, ?, ?, NOW())");
            if(!$createStmt){
                throw new Exception("Prepare failed");
            }
            
            $createStmt->bind_param("sssss", $name, $email, $phone, $state, $district);
            if(!$createStmt->execute()){
                throw new Exception("Student creation failed");
            }
            
            $student_id = $conn->insert_id;
            $createStmt->close();
        }
        
        $studentStmt->close();
        
        // Check if event exists for birthday party (using prepared statement)
        $eventStmt = $conn->prepare("SELECT event_id FROM events WHERE event_name LIKE ?");
        if(!$eventStmt){
            throw new Exception("Prepare failed");
        }
        
        $searchTerm = "%birthday%";
        $eventStmt->bind_param("s", $searchTerm);
        if(!$eventStmt->execute()){
            throw new Exception("Execute failed");
        }
        
        $eventResult = $eventStmt->get_result();
        $event_id = null;
        
        if($eventResult->num_rows > 0) {
            $eventRow = $eventResult->fetch_assoc();
            $event_id = $eventRow['event_id'];
        } else {
            // Create birthday event if it doesn't exist (prepared statement)
            $createEventStmt = $conn->prepare("INSERT INTO events(event_name, event_date, location, capacity, price) VALUES(?, ?, ?, ?, ?)");
            if(!$createEventStmt){
                throw new Exception("Prepare failed");
            }
            
            $eventName = "Birthday Party Event";
            $capacity = 100;
            $createEventStmt->bind_param("ssiii", $eventName, $preferredDate, $state, $capacity, $amount);
            if(!$createEventStmt->execute()){
                throw new Exception("Event creation failed");
            }
            
            $event_id = $conn->insert_id;
            $createEventStmt->close();
        }
        
        $eventStmt->close();
        
        // Insert booking using prepared statement
        $bookingStmt = $conn->prepare("INSERT INTO bookings(student_id, event_id, booking_date, status, amount) VALUES(?, ?, NOW(), 'confirmed', ?)");
        if(!$bookingStmt){
            throw new Exception("Prepare failed");
        }
        
        $bookingStmt->bind_param("iii", $student_id, $event_id, $amount);
        if(!$bookingStmt->execute()){
            throw new Exception("Booking creation failed");
        }
        
        $bookingStmt->close();
        
        echo "Congratulations! Your birthday event booking is done. Our team will contact you within 24 hours.";
        header("refresh:5;url=bootstrap1.html");
        
    } catch (Exception $e) {
        error_log("Event Booking Error: " . $e->getMessage());
        echo "<p style='color:red;'>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p><a href='javascript:history.back()'>Go Back</a></p>";
    }
    
    $conn->close();
    
} else {
    echo "Invalid request method.";
}
?>

