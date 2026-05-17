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
        #menu .items li:nth-child(3){
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

        <h3 class="i-name">Student List</h3>
        <div class="values">
        <div class="section">
        <h4>Students by Dance Category</h4>
        <table style="margin-bottom: 20px;">
            <tr>
             <?php
                $sql="SELECT * FROM category ORDER BY cat";
                $re=$conn->query($sql);
                if($re->num_rows>0){
                    while($ro=$re->fetch_assoc()){
                       $category = $ro['cat'];
                       echo"<td> <div class='dropdown'>
                        <button class='btn btn-primary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        $category
                         </button>";
                         echo"<ul class='dropdown-menu'>";
                        $sqli="SELECT course_id, course_name FROM courses WHERE category='$category' ORDER BY course_name";
                        $r=$conn->query($sqli);
                        if($r->num_rows>0){
                            while($rowss=$r->fetch_assoc()){
                               $courseName = $rowss['course_name'];
                               echo"<li><a class='dropdown-item' href='num.php?category=$category&form=" . urlencode($courseName) . "'>$courseName</a></li>";
                            }
                        } else {
                            echo"<li><span class='dropdown-item' style='color: gray;'>No courses</span></li>";
                        }
                        echo "</ul></div></td>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No categories found</td></tr>";
                }
                ?>
            </tr>
        </table>
        </div>
    </div>
</body>
</html>