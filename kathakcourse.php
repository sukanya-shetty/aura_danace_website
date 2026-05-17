<?php
require 'config.php';
session_start();
if(!isset($_SESSION["log"])){
    header(("Location:Login.html"));
    exit();
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
    <link rel="stylesheet" href="costyle.css">
</head>
<body>
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
                    $sql="SELECT * FROM classical WHERE form='Kathak'";
                    $result=$conn->query($sql);
                       if($result->num_rows==1){
                           $row=$result->fetch_assoc();
                            $form=$row['form'];
                            $amt=$row['amt'];
                               echo"<div class='user'>
                               <label>Dance Category</label>
                               <input type='text' name='cat' id='form' value='Classical' disabled style='color: white;' required>
                           </div>
                               
                               <div class='user'>
                               <label>Dance Form</label>
                               <input type='text' name='form' id='form' value='$form' disabled style='color: white;' required>
                               <input type='hidden' name='form' value='$form' required>
                           </div>

                               <div class='user'>
                               <label>Amount</label>
                               <input type='text' name='amt' id='amt' value='$amt' style='color: white;'disabled required>
                               <input type='hidden' name='amt' value='$amt' required>
                           </div>";
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