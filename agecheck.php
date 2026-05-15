<?php
session_start();
$server='localhost';
$uname='root';
$password='';
$db='aura_dance';
$conn=new mysqli($server,$uname,$password,$db);
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"]==TRUE)
{
    $name=$_POST["name"];
    $mno=$_POST["mno"];
    $email=$_POST["email"];
    $addr=$_POST["addr"];
    $dis=$_POST["dis"];
    $age=$_POST["age"];
    $courseName=$_POST["form"]; // Course name from form
    $amt=$_POST["amt"];
    $level=$_POST["level"];
    $gender=$_POST["gender"];

    // Age validation
    if($age<15){
        echo("<script language='javascript'>
        window.alert('You must be at least 15 years old to register for this course.');
        window.location.href='dancecat.php';
        </script>");
        exit();
    }
    
    // District validation
    if($dis!="Udupi"&&$dis!="udupi"){
        echo("<script language='javascript'>
        window.alert('We are really sorry our academy is situated at Udupi. So we regret to tell you that you cannot register with us')
        window.location.href='bootstrap1.html'
        </script>");
        exit();
    }
    else{
        // Check if student already exists
        $checkStudent = "SELECT student_id FROM students WHERE email='$email'";
        $result = $conn->query($checkStudent);
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $student_id = $row['student_id'];
        } else {
            // Create new student record
            $createStudent = "INSERT INTO students(name, email, phone, address, district, age, gender, enrollment_date)
                            VALUES('$name', '$email', '$mno', '$addr', '$dis', $age, '$gender', NOW())";
            if($conn->query($createStudent) === TRUE) {
                $student_id = $conn->insert_id;
            } else {
                echo "Error: " . $conn->error;
                exit();
            }
        }
        
        // Get course_id from courses table using course name
        $getCourse = "SELECT course_id FROM courses WHERE course_name='$courseName' OR course_name LIKE '%$courseName%'";
        $courseResult = $conn->query($getCourse);
        
        if($courseResult->num_rows > 0) {
            $courseRow = $courseResult->fetch_assoc();
            $course_id = $courseRow['course_id'];
        } else {
            echo "<script language='javascript'>
            window.alert('Course not found. Please try again.')
            window.location.href='bootstrap1.html'
            </script>";
            exit();
        }
        
        // Store enrollment data in session for use by pay.php
        $_SESSION['enrollment_data'] = array(
            'student_id' => $student_id,
            'course_id' => $course_id,
            'amount' => $amt,
            'level' => $level
        );
        
        // Redirect to payment page
        header("Location: pay.php");
    }
}
?>