<?php
require 'config.php';
session_start();
if(!isset($_SESSION["log"])){
    header("Location:Login.html");
    exit();
}

// Get and sanitize course name parameter
$courseName = isset($_GET['course_name']) ? trim($_GET['course_name']) : '';
if(empty($courseName)){
    die("Invalid course selection");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
    <link rel="stylesheet" href="costyle.css">
    <?php
    ?>
</head>
<body>
    <?php
     ?>
    <div class="container">
        <h1 class="form-title">Register</h1>
        <form action="agecheck.php" method="post">
            <div class="main">
                <div class="user">
                    <label>Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your Full Name" required>
                </div>

                <div class="user">
                    <label>Mobile Number</label>
                    <input type="text" name="mno" id="mno" maxlength="10" minlength="10" pattern="[0-9]+" title="Please enter only numbers"placeholder="Enter your Mobile Number" required>
                </div>

                <div class="user">
                    <label>Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your Email" required>
                </div>

                <div class="user">
                    <label>Address</label>
                    <input type="text" name="addr" id="addr" placeholder="Enter your Address"   required>
                </div>

                <div class="user">
                    <label>District</label>
                    <input type="text" name="dis" id="dis" placeholder="Enter your District" required>
                </div>

                <div class="user">
                    <label>Age</label>
                    <input type="text" name="age" id="age" placeholder="Enter your Age" required>
                </div>

                <?php
                    try {
                        $courseName = isset($_GET['course_name']) ? trim($_GET['course_name']) : '';
                        
                        if(empty($courseName)){
                            throw new Exception("Invalid course selection");
                        }
                        
                        // Use prepared statement to prevent SQL injection
                        $stmt = $conn->prepare("SELECT course_name, category, fee, instructor_name FROM courses WHERE course_name = ?");
                        if(!$stmt){
                            throw new Exception("Prepare failed: " . $conn->error);
                        }
                        
                        $stmt->bind_param("s", $courseName);
                        if(!$stmt->execute()){
                            throw new Exception("Execute failed: " . $stmt->error);
                        }
                        
                        $result = $stmt->get_result();
                        
                        if($result->num_rows == 1){
                            $row = $result->fetch_assoc();
                            
                            // Sanitize output to prevent XSS
                            $form = htmlspecialchars($row['course_name'], ENT_QUOTES, 'UTF-8');
                            $category = htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8');
                            $amt = htmlspecialchars($row['fee'], ENT_QUOTES, 'UTF-8');
                            $instructor = htmlspecialchars($row['instructor_name'], ENT_QUOTES, 'UTF-8');
                            
                            echo "<div class='user'>
                                <label>Dance Category</label>
                                <input type='text' name='cat' id='form' value='" . $category . "' disabled style='color: white;' required>
                            </div>
                            
                            <div class='user'>
                                <label>Dance Form</label>
                                <input type='text' name='form' id='form' value='" . $form . "' disabled style='color: white;' required>
                                <input type='hidden' name='form' value='" . $form . "' required>
                            </div>
                            
                            <div class='user'>
                                <label>Instructor</label>
                                <input type='text' name='instructor' id='instructor' value='" . $instructor . "' disabled style='color: white;' required>
                            </div>
                            
                            <div class='user'>
                                <label>Amount</label>
                                <input type='text' name='amt' id='amt' value='₹" . $amt . "' style='color: white;' disabled required>
                                <input type='hidden' name='amt' value='" . $amt . "' required>
                            </div>";
                        }else{
                            throw new Exception("Course not found. Please select a valid course.");
                        }
                        
                        $stmt->close();
                        
                    } catch (Exception $e) {
                        error_log($e->getMessage());
                        echo "<div style='color: red; padding: 10px;'>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</div>";
                    }
                ?>

                <div class="user">
                    <label>Level</label>
                    <select name="level" required>
                        <option value="" disabled selected>Select your Level</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>


            </div>

            <div class="gender-details">
                <span class="gender-title">Gender</span>
                <div class="gender-cat">
                    <input type="radio" name="gender" value="male" required>
                    <label>Male</label>
                    <input type="radio" name="gender" value="female" required>
                    <label>Female</label>
                </div>
            </div>
            
            <div class="form-submit">
                <input type="submit" name="pay" value="Pay">
            </div>
        </form>
    </div>
</body>
</html>