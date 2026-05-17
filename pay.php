<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if(!isset($_POST['payment_success']) || $_POST['payment_success'] != '1') {
            throw new Exception("Invalid payment request");
        }
        
        // Get enrollment data from session
        if(!isset($_SESSION['enrollment_data'])) {
            throw new Exception("Enrollment data not found in session");
        }
        
        $enrollment_data = $_SESSION['enrollment_data'];
        $student_id = intval($enrollment_data['student_id'] ?? 0);
        $course_id = intval($enrollment_data['course_id'] ?? 0);
        $amount = floatval($enrollment_data['amount'] ?? 0);
        
        if($student_id <= 0 || $course_id <= 0 || $amount <= 0){
            throw new Exception("Invalid enrollment data");
        }
        
        // Insert into enrollments table using prepared statement
        $enrollStmt = $conn->prepare("INSERT INTO enrollments(student_id, course_id, enrollment_date, status) VALUES(?, ?, NOW(), 'active')");
        if(!$enrollStmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $enrollStmt->bind_param("ii", $student_id, $course_id);
        if(!$enrollStmt->execute()){
            throw new Exception("Enrollment failed: " . $enrollStmt->error);
        }
        $enrollStmt->close();
        
        // Insert into payments table using prepared statement
        $paymentStmt = $conn->prepare("INSERT INTO payments(student_id, course_id, amount, payment_date, status) VALUES(?, ?, ?, NOW(), 'success')");
        if(!$paymentStmt){
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $paymentStmt->bind_param("iid", $student_id, $course_id, $amount);
        if(!$paymentStmt->execute()){
            throw new Exception("Payment recording failed: " . $paymentStmt->error);
        }
        $paymentStmt->close();
        
        // Clear session data and redirect
        unset($_SESSION['enrollment_data']);
        header("Location:thankyou.php");
        exit();
        
    } catch (Exception $e) {
        error_log("Payment Error: " . $e->getMessage());
        echo "<div style='color: red; padding: 20px;'>Payment Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</div>";
        exit();
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

