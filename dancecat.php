<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                          <li><a class="dropdown-item" href="#">Available Dance Courses</a></li>

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
    <br><br><br>
    <center><h1>Dance Categories</h1></center>
    <br>
    <div class="container">
    <div class="row">
        <div class="col-md-6">
        <img src='gojo2-unscreen.gif' style="height: 500px;">
        </div>
        <div class="col-md-6">
     <?php
    try {
        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);
        
        if(!$result){
            throw new Exception("Query failed: " . $conn->error);
        }
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                // Sanitize output to prevent XSS
                $cat = htmlspecialchars($row["cat"], ENT_QUOTES, 'UTF-8');
                $context = htmlspecialchars($row["context"], ENT_QUOTES, 'UTF-8');
                $catUrl = urlencode($row["cat"]);
                
                echo "
                <div class='card text-center mb-3' style='width:900px; margin-left:-250px;'>
                <div class='card-body'>
                  <h5 class='card-title'>" . $cat . "</h5>
                  <p class='card-text' style='color:black;'>" . $context . "</p>
                  <a href='danceform.php?cat=" . $catUrl . "' class='btn btn-primary'>View Dance Forms</a>
                </div>
              </div><br>";
            }
        }else{
            echo "<h3>No Dance Category is added</h3>";
        }
    } catch (Exception $e) {
        error_log("Dance Category Error: " . $e->getMessage());
        echo "<h3 style='color:red;'>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</h3>";
    }
    ?>
            </div>
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
            <script>
                var navlinks=document.getElementById("navLinks");
                function showMenu(){
                    navLinks.style.right="0";
                }
                function hideMenu(){
                    navLinks.style.right="-200px";
                }
            </script>
</body>
</html>