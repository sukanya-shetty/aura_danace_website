<?php
session_start();
$servername = "localhost";
$username = "root";
$password = ""; // Your root password or the new user password
$dbname = "aura_dance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $preferredDate = $_POST['preferredDate'];
    $preferredTime = $_POST['preferredTime'];
    $bgName = $_POST['bgName'];
    $address = $_POST['address'];
    $amount = 500; // Assuming a fixed amount for this example
    $cardNumber = $_POST['cardNumber'];

    // First, check if student exists or create one
    $studentQuery = "SELECT student_id FROM students WHERE email='$email'";
    $studentResult = $conn->query($studentQuery);
    
    if($studentResult->num_rows > 0) {
        $row = $studentResult->fetch_assoc();
        $student_id = $row['student_id'];
    } else {
        // Create new student record if doesn't exist
        $createStudent = "INSERT INTO students(name, email, phone, address, district, enrollment_date) 
                         VALUES('$name', '$email', '$phone', '$address', '$district', NOW())";
        if($conn->query($createStudent) === TRUE) {
            $student_id = $conn->insert_id;
        } else {
            echo "Error creating student record: " . $conn->error;
            exit();
        }
    }

    // Check if event exists or get the event_id for Bollywood event
    $eventQuery = "SELECT event_id FROM events WHERE event_name LIKE '%bollywood%' OR event_name LIKE '%bolly%'";
    $eventResult = $conn->query($eventQuery);
    
    if($eventResult->num_rows > 0) {
        $eventRow = $eventResult->fetch_assoc();
        $event_id = $eventRow['event_id'];
    } else {
        // Create Bollywood event if it doesn't exist
        $createEvent = "INSERT INTO events(event_name, event_date, location, capacity, price) 
                       VALUES('Bollywood Dance Event', '$preferredDate', '$state', 100, $amount)";
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
        echo "Congratulations! Your booking is done. Our team will contact you within 24 hours.";
        // Redirect to home page after 5 seconds
        header("refresh:5;url=bootstrap1.html");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
