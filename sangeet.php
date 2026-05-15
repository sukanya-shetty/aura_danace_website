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
    // Collect form data and sanitize it
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $district = htmlspecialchars($_POST['district']);
    $sangeetDate = htmlspecialchars($_POST['sangeetDate']);
    $time = htmlspecialchars($_POST['time']);
    $peopleCount = htmlspecialchars($_POST['peopleCount']);
    $address = htmlspecialchars($_POST['address']);
    
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
                         VALUES('$name', '$email', '$phone', '$address', '$district', NOW())";
        if($conn->query($createStudent) === TRUE) {
            $student_id = $conn->insert_id;
        } else {
            echo "Error creating student record: " . $conn->error;
            exit();
        }
    }

    // Check if event exists or get the event_id for Sangeet event
    $eventQuery = "SELECT event_id FROM events WHERE event_name LIKE '%sangeet%'";
    $eventResult = $conn->query($eventQuery);
    
    if($eventResult->num_rows > 0) {
        $eventRow = $eventResult->fetch_assoc();
        $event_id = $eventRow['event_id'];
    } else {
        // Create Sangeet event if it doesn't exist
        $createEvent = "INSERT INTO events(event_name, event_date, location, capacity, price) 
                       VALUES('Sangeet Event', '$sangeetDate', '$district', 100, $amount)";
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
} else {
    echo "Invalid request method.";
}

$conn->close();
?>