<?php
$server="localhost";
$uname="root";
$password="";
$db='aura_dance';

$conn=new mysqli($server,$uname,$password,$db);
if($conn->connect_error)
{
    die("Connection failed:".$conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="adminstyle.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        #menu .items li:nth-child(1){
              border-left: 4px solid #fff;
        }

    </style>
    
    <?php
    session_start();
    //if(!isset($_SESSION['uname'])){
     //   header("Location:ww.html");
    //}
    //exit;
    //$name=$_SESSION['uname'];
    ?>
</head>
<body>
    <section id=menu>
        <div class="logo">
            <img src="logo-removebg-preview.png" alt="download-removebg-preview">
        </div>

        <div class="items">
            <li><i class="fas fa-th-large"></i>            
            <a href="#">Dashboard</a></li>
            <li><i class="fas fa-solid fa-music"></i><a href="studentform.php">Dance Forms</a></li>
            <li><i class="fas fa-user-graduate"></i><a href="student.php">Students</a></li>
            <li><i class="fas fa-calendar"></i><a href="eventss.php">Events</a></li>
            <li><i class="fas fa-hand-holding-usd"></i><a href="earnings.php">Earnings</a></li>
        </div>
    </section>

    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div>
                    <i id="menu-btn" class="fas fa-bars"></i>
                </div>
                <div class="ad">Welcome , &nbsp;<?php echo "<h4 style='color:#ADA1E6;'>$_SESSION[uname]</h3>"?></div>
            </div>

            <div class="profile">
                <button name="logout"><a href="ww.html" style="text-decoration: none; color:#fff;">Logout</a></button>
                <img src="admin/uimage.png" alt="uimage">
                
            </div>
        </div>

        <h3 class="i-name">Dashboard</h3>

        <div class="values">
        <?php
             // Get total statistics
             $totalStudents = $conn->query("SELECT COUNT(*) as count FROM students")->fetch_assoc()['count'];
             $totalCourses = $conn->query("SELECT COUNT(*) as count FROM courses")->fetch_assoc()['count'];
             $totalEnrollments = $conn->query("SELECT COUNT(*) as count FROM enrollments")->fetch_assoc()['count'];
             $totalRevenue = $conn->query("SELECT COALESCE(SUM(amount), 0) as total FROM payments")->fetch_assoc()['total'];
             
             // Display key metrics
             echo "<div class='val-box'>
                <i class='fas fa-users'></i>
                <div>
                    <h3>$totalStudents</h3>
                    <span>Total Students</span>
                </div>
            </div>";
            
            echo "<div class='val-box'>
                <i class='fas fa-music'></i>
                <div>
                    <h3>$totalCourses</h3>
                    <span>Total Courses</span>
                </div>
            </div>";
            
            echo "<div class='val-box'>
                <i class='fas fa-book'></i>
                <div>
                    <h3>$totalEnrollments</h3>
                    <span>Total Enrollments</span>
                </div>
            </div>";
            
            echo "<div class='val-box'>
                <i class='fas fa-rupee-sign'></i>
                <div>
                    <h3>₹$totalRevenue</h3>
                    <span>Total Revenue</span>
                </div>
            </div>";
        ?>
        </div>

        <div class="values">
        <h4 style='margin-bottom: 15px;'>Courses by Category</h4>
        <?php
             // Query courses by dance category
             $categories = ['Bharatanatyam', 'Kathak', 'Hip-Hop', 'Break Dance', 'Ballet', 'Salsa', 'Fusion'];
             
             foreach($categories as $category) {
                 $sql = "SELECT COUNT(*) as count FROM courses WHERE category = '$category'";
                 $result = $conn->query($sql);
                 $row = $result->fetch_assoc();
                 $count = $row['count'];
                 
                 echo "<div class='val-box'>
                    <i class='fas fa-music'></i>
                    <div>
                        <h3>$count</h3>
                        <span>$category</span>
                    </div>
                </div>";
             }
        ?>
        </div>
    </section>

    <script>
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
        })
    </script>
</body>
</html>