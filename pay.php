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
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['payment_success']) && $_POST['payment_success'] == '1') {
        // Get enrollment data from session
        if(isset($_SESSION['enrollment_data'])) {
            $enrollment_data = $_SESSION['enrollment_data'];
            $student_id = $enrollment_data['student_id'];
            $course_id = $enrollment_data['course_id'];
            $amount = $enrollment_data['amount'];
            
            // Insert into enrollments table
            $enrollSQL = "INSERT INTO enrollments(student_id, course_id, enrollment_date, status)
                         VALUES($student_id, $course_id, NOW(), 'active')";
            
            if($conn->query($enrollSQL) === TRUE) {
                // Insert into payments table
                $paymentSQL = "INSERT INTO payments(student_id, course_id, amount, payment_date, status)
                             VALUES($student_id, $course_id, $amount, NOW(), 'success')";
                
                if($conn->query($paymentSQL) === TRUE) {
                    // Clear session data
                    unset($_SESSION['enrollment_data']);
                    header("Location:thankyou.php");
                } else {
                    echo "Payment Error: ".$conn->error;
                }
            } else {
                echo "Enrollment Error: ".$conn->error;
            }
        } else {
            echo "Error: Enrollment data not found in session.";
        }
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Credit Card Form</title>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="paystyle.css" />
    <style>
        button{
            margin-top: 40px;
            background: #6666ff;
            color: white;
            width: 400px;
            height: 30px;
        }

        button:hover{
            background: #1919ff;
        }
        </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="credit-card" id="card">
        <div class="card-front">
          <div class="branding">
            <img src="chipp-removebg-preview.png" class="chip-img" />
            <img src="visa-removebg-preview.png" class="visa-logo" />
          </div>
          <div class="card-number">
            <div>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
            </div>
            <div>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
            </div>
            <div>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
            </div>
            <div>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
              <span class="card-number-display">_</span>
            </div>
          </div>
          <div class="details">
            <div>
              <span>Card Holder</span>
              <span id="card-holder-name">Your Name Here</span>
            </div>
            <div>
              <span>Expires</span>
              <span id="validity">06/28</span>
            </div>
          </div>
        </div>
        <div class="card-back">
          <div class="black-strip"></div>
          <div class="white-strip">
            <span>CVV</span>
            <div id="cvv-display"></div>
          </div>
          <img src="visa-removebg-preview.png" class="visa-logo" />
        </div>
      </div>
      <form action="" method="post" id="payment-form">
        <label for="card-number">Card Number</label>
        <input type="number" id="card-number" placeholder="1234123412341234" required />

        <label for="card-holder">Card Holder:</label>
        <input type="text" id="card-name-input" placeholder="Your Name" required />

        <div class="date-cvv">
          <div>
            <label for="validity">Expires On:</label>
            <input type="date" id="validity-input" min="yyyy-mm-dd" required />
          </div>
          <div>
            <label for="cvv">CVV:</label>
            <input type="number" id="cvv" placeholder="***" required />
          </div>
        </div>
        <input type="hidden" name="payment_success" value="1" />
        <button type="submit">Register</button>
      </form>
    </div>
    <!-- Script -->
    <script src="payscript.js"></script>
  </body>
</html>

