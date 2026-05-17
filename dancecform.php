<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Optional: Adjust card width for larger screens */
        @media (min-width: 768px) {
            .card {
                width: calc(50% - 20px); /* Adjust according to your design */
                margin: 10px; /* Adjust according to your design */
            }
        }
    </style>
</head>
<body style="background:lavenderblush;">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container">
                    <a href="index.html"><img src="aura.jpg" alt=""></a>
                  <a class="navbar-brand" href="#">Aura</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="bootstrap.html">Home</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Events
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="bookevnt.html">Book Events</a></li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Course
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="dancecat.php">Available Dance Courses</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="Login.html">Login</a>
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </nav>
              
    <?php
            $cat=$_GET["cat"];
  echo"<center><h1 style='padding-top:75px'>$cat Dance Forms</h1></center>";
  ?>
        <div class="container">
        <div class="row">
    <?php
        $cat=$_GET["cat"];
        // Check if category exists
        $sql="SELECT cat FROM category where cat='$cat'";
        $result=$conn->query($sql);
        if($result->num_rows==1){
            // Query courses table for courses in this category
            $sqli="SELECT course_name, course_name as form, instructor_name as con FROM courses WHERE category='$cat'";
            $res=$conn->query($sqli);
            if($res->num_rows>0){
                while($row=$res->fetch_assoc()){
                    $courseName=$row["form"];
                    $instructor=$row["con"];
                    echo"
                    <div class='col-12 col-md-6'>
                    <div class='card' style='width: 18rem; margin-top:40px'>
                    <div class='card-img-top' style='background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); height: 200px; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; text-align: center; padding: 20px;'>
                    <i class='fa fa-music' style='font-size: 40px;'></i>
                    </div>
                    <div class='card-body'>
                      <h5 class='card-title'>$courseName</h5>
                      <p class='card-text' style='color:black;'><strong>Instructor:</strong> $instructor</p>
                      <a href='course.php?course_name=" . urlencode($courseName) . "' class='btn btn-primary'>Enroll Now</a>
                    </div>
                  </div> 

                  </div>";
                }
            }else{
                echo "No dance courses added yet in this category";
            }
        }else{
            echo "No Dance category found";
        }
    ?>
        </div>
        </div>
        <br><br><br><br><br><br><br><br>
        <section class="footer">
            <h3>Connect with us</h3>
            <div class="icons">
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-instagram"></i></a>
                <a href=""><i class="fa fa-linkedin"></i></a>
            </div>
            <div class="footernav">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">News</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact us</a></li>
                    <li><a href="">Our team</a></li>
                </ul>
            </div>
        </section>
</body>
</html>