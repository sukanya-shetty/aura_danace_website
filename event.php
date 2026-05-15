
<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aura_dance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $preferredDate = $_POST['preferredDate'];
    $preferredTime = $_POST['preferredTime'];
    $birthdayKidName = $_POST['birthdayKidName'];
    $ageTurning = $_POST['ageTurning'];
    
    $amount = 500;

    // First, check if student exists or create one
    $studentQuery = "SELECT student_id FROM students WHERE email='$email'";
    $studentResult = $conn->query($studentQuery);
    
    if($studentResult->num_rows > 0) {
        $row = $studentResult->fetch_assoc();
        $student_id = $row['student_id'];
    } else {
        // Create new student record if doesn't exist
        $createStudent = "INSERT INTO students(name, email, phone, address, district, enrollment_date) 
                         VALUES('$name', '$email', '$phone', '', '$district', NOW())";
        if($conn->query($createStudent) === TRUE) {
            $student_id = $conn->insert_id;
        } else {
            echo "Error creating student record: " . $conn->error;
            exit();
        }
    }

    // Check if event exists for birthday party
    $eventQuery = "SELECT event_id FROM events WHERE event_name LIKE '%birthday%'";
    $eventResult = $conn->query($eventQuery);
    
    if($eventResult->num_rows > 0) {
        $eventRow = $eventResult->fetch_assoc();
        $event_id = $eventRow['event_id'];
    } else {
        // Create birthday event if it doesn't exist
        $createEvent = "INSERT INTO events(event_name, event_date, location, capacity, price) 
                       VALUES('Birthday Party Event', '$preferredDate', '$state', 100, $amount)";
        if($conn->query($createEvent) === TRUE) {
            $event_id = $conn->insert_id;
        } else {
            echo "Error creating event: " . $conn->error;
            exit();
        }
    }

    // Insert booking into the bookings table
    $bookingSQL = "INSERT INTO bookings(student_id, event_id, booking_date, status, amount) 
                   VALUES($student_id, $event_id, NOW(), 'confirmed', $amount)";

    if ($conn->query($bookingSQL) === TRUE) {
        echo "Congratulations! Your birthday event booking is done. Our team will contact you within 24 hours.";
        // Redirect to home page after 5 seconds
        header("refresh:5;url=bootstrap1.html");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
