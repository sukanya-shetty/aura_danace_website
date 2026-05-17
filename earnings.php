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
        #menu .items li:nth-child(5){
              border-left: 4px solid #fff;
        }

        #interface .navigation{
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    padding: 3px 30px;
    border-bottom: 3px solid #594ef7;
    position: fixed;
    width: 80%;
        }

        button{
    background: #7B74EC;
    margin-right: 10px;
    padding: 5px 10px 5px 10px;
    border-radius: 12px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
}
   a{
    font-size: 14px;
   }

   @media(max-width:769px) {
    #menu {
        width: 250px;
        position: fixed;
        left: -270px;
        transition: 0.3s ease;
    }

    #menu.active{
        left: 0px;
    }

    #menu-btn{
        display: initial;
    }

    #interface {
        width: 100%;
        margin-left: 0px;
        display: inline-block;
        transition: 0.3s ease;
    }
    
    #menu.active~#interface{
        width:calc(100%-250px);
        margin-left: 270px;
        transition: 0.3s ease;
    }

    #interface .navigation {
        width: 100%;
    }

    .values {
        padding: 30px 30px 0 30px;
        justify-content: flex-start;
    }

    .values .val-box {
        padding: 16px 20px;
        margin: 10px 20px 10px 0;
    }
}

input{
width:400px;
background:white;
border:none;
border-radius:3px;
margin-left: 15px;
}

textarea{
  border-radius:3px;
  margin-left: 15px;
}

.butto{
    font-size: 16px;
    border: none;
    outline: none;
    background: #ADA1E6;
    padding: 5px;
    margin-top: 40px;
    margin-left: 150px;
    border-radius: 90px;
    font-weight: 300;
    cursor: pointer;
    width: 200px;
}

span{
    margin-left: 15px;
    font-weight: bolder;
}

td{
    padding-right: 200px;
}

    </style>
        
    <?php
    session_start();
    ?>
</head>
<body>
<section id=menu>
        <div class="logo">
            <img src="logo-removebg-preview.png" alt="download-removebg-preview">
        </div>

        <div class="items">
            <li><i class="fas fa-th-large"></i>            
            <a href="adminpanel.php">Dashboard</a></li>
            <li><i class="fas fa-solid fa-music"></i><a href="studentform.php">Dance Forms</a></li>
            <li><i class="fas fa-user-graduate"></i><a href="student.php">Students</a></li>
            <li><i class="fas fa-calendar"></i><a href="#">Events</a></li>
            <li><i class="fas fa-hand-holding-usd"></i><a href="#">Earnings</a></li>
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

        <h3 class="i-name">Earnings</h3>
        <div class="values">
        <?php
            echo"<table class='table'>
            <thead>
              <tr>
                <th scope='col'>Form</th>
                <th scope='col'>Amount</th>
            </tr>
            </thead>";
            $sql="SELECT c.course_name, COALESCE(SUM(p.amount), 0) AS total_amount FROM courses c LEFT JOIN payments p ON c.course_id = p.course_id GROUP BY c.course_id, c.course_name ORDER BY c.course_name";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    echo"<tbody>";
                    while($row=$result->fetch_assoc()){
                        $course_name = $row['course_name'];
                        $total_amount = $row['total_amount'];
                        echo"<tr>
                         <td>$course_name</td>
                         <td>₹$total_amount</td>
                        </tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "<tbody><tr><td colspan='2'>No course data available</td></tr></tbody>";
                }
                echo"</table>";
        ?>


<?php
            echo"<div><h3 style='margin-top: 50px;'>Events Earnings</h3>";
            echo "</div></div>";
            echo "<table class='table'>
            <thead>
              <tr>
                <th scope='col'>Event Name</th>
                <th scope='col'>Total Revenue</th>
            </tr>
            </thead>";
            ?>
            <?php
            $sql="SELECT e.event_name, COALESCE(SUM(b.amount), 0) AS total_amount FROM events e LEFT JOIN bookings b ON e.event_id = b.event_id GROUP BY e.event_id, e.event_name ORDER BY e.event_name";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    echo"<tbody>";
                    while($row=$result->fetch_assoc()){
                        $event_name = $row['event_name'];
                        $total_amount = $row['total_amount'];
                        echo"<tr>
                         <td>$event_name</td>
                         <td>₹$total_amount</td>
                        </tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "<tbody><tr><td colspan='2'>No event bookings found</td></tr></tbody>";
                }
                echo"</table>";
            ?>
        ?>

        </div>
    </section>
</body>
</html>