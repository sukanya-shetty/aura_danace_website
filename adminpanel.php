<?php
require 'config.php';
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
    // Enforce authentication
    if(!isset($_SESSION['uname'])){
        header("Location:ww.html");
        exit;
    }
    $adminName = htmlspecialchars($_SESSION['uname'], ENT_QUOTES, 'UTF-8');
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
                <div class="ad">Welcome , &nbsp;<?php echo "<h4 style='color:#ADA1E6;'>" . $adminName . "</h4>"?></div>
            </div>

            <div class="profile">
                <button name="logout"><a href="ww.html" style="text-decoration: none; color:#fff;">Logout</a></button>
                <img src="admin/uimage.png" alt="uimage">
                
            </div>
        </div>

        <h3 class="i-name">Dashboard</h3>

        <div class="values">
        <?php
        try {
            // Get total statistics using prepared statements
            $studentStmt = $conn->prepare("SELECT COUNT(*) as count FROM students");
            if(!$studentStmt) throw new Exception("Prepare failed");
            $studentStmt->execute();
            $totalStudents = $studentStmt->get_result()->fetch_assoc()['count'];
            $studentStmt->close();
            
            $courseStmt = $conn->prepare("SELECT COUNT(*) as count FROM courses");
            if(!$courseStmt) throw new Exception("Prepare failed");
            $courseStmt->execute();
            $totalCourses = $courseStmt->get_result()->fetch_assoc()['count'];
            $courseStmt->close();
            
            $enrollStmt = $conn->prepare("SELECT COUNT(*) as count FROM enrollments");
            if(!$enrollStmt) throw new Exception("Prepare failed");
            $enrollStmt->execute();
            $totalEnrollments = $enrollStmt->get_result()->fetch_assoc()['count'];
            $enrollStmt->close();
            
            $revenueStmt = $conn->prepare("SELECT COALESCE(SUM(amount), 0) as total FROM payments");
            if(!$revenueStmt) throw new Exception("Prepare failed");
            $revenueStmt->execute();
            $totalRevenue = $revenueStmt->get_result()->fetch_assoc()['total'];
            $revenueStmt->close();
            
            // Display key metrics with proper escaping
            echo "<div class='val-box'>
                <i class='fas fa-users'></i>
                <div>
                    <h3>" . htmlspecialchars($totalStudents, ENT_QUOTES, 'UTF-8') . "</h3>
                    <span>Total Students</span>
                </div>
            </div>";
            
            echo "<div class='val-box'>
                <i class='fas fa-music'></i>
                <div>
                    <h3>" . htmlspecialchars($totalCourses, ENT_QUOTES, 'UTF-8') . "</h3>
                    <span>Total Courses</span>
                </div>
            </div>";
            
            echo "<div class='val-box'>
                <i class='fas fa-book'></i>
                <div>
                    <h3>" . htmlspecialchars($totalEnrollments, ENT_QUOTES, 'UTF-8') . "</h3>
                    <span>Total Enrollments</span>
                </div>
            </div>";
            
            echo "<div class='val-box'>
                <i class='fas fa-rupee-sign'></i>
                <div>
                    <h3>₹" . htmlspecialchars($totalRevenue, ENT_QUOTES, 'UTF-8') . "</h3>
                    <span>Total Revenue</span>
                </div>
            </div>";
        } catch (Exception $e) {
            error_log("Admin Panel Error: " . $e->getMessage());
            echo "<div style='color:red;'>Error loading statistics</div>";
        }
        ?>
        </div>

        <div class="values">
        <h4 style='margin-bottom: 15px;'>Courses by Category</h4>
        <?php
        try {
            // Query courses by dance category using prepared statement
            $categories = ['Bharatanatyam', 'Kathak', 'Hip-Hop', 'Break Dance', 'Ballet', 'Salsa', 'Fusion'];
            
            foreach($categories as $category) {
                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM courses WHERE category = ?");
                if(!$stmt) throw new Exception("Prepare failed");
                
                $stmt->bind_param("s", $category);
                if(!$stmt->execute()) throw new Exception("Execute failed");
                
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $count = htmlspecialchars($row['count'], ENT_QUOTES, 'UTF-8');
                $categoryEscaped = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');
                
                echo "<div class='val-box'>
                   <i class='fas fa-music'></i>
                   <div>
                       <h3>" . $count . "</h3>
                       <span>" . $categoryEscaped . "</span>
                   </div>
               </div>";
               
                $stmt->close();
            }
        } catch (Exception $e) {
            error_log("Category Query Error: " . $e->getMessage());
            echo "<div style='color:red;'>Error loading category data</div>";
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