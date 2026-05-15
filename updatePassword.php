<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
         *{
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}
body {
    background-color: #ff99f5;
    /*background-image:url('pikaso_texttoimage_light-purple-color-themed-background.jpeg');*/
    background-repeat: no-repeat;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10rem 0;
    height: 500px;
}
.card {
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    background-color: rgba(0, 0, 0, 0.75);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.125);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 30px 40px;
    height: 300px;
}
.lock-icon {
    font-size: 3rem;
}
h2 {
    font-size: 1.5rem;
    margin-top: 10px;
    text-transform: uppercase;
}
p {
    font-size: 12px;
}
.passInput {
    margin-top: 15px;
    width: 80%;
    background: transparent;
    border: none;
    border-bottom: 2px solid deepskyblue;
    font-size: 15px;
    color: white;
    outline: none;
}
button {
    margin-top: 15px;
    width: 80%;
    background-color: deepskyblue;
    color: white;
    padding: 10px;
    text-transform: uppercase;
}

input[type="submit"]{
    font-size: 20px;
    border: none;
    outline: none;
    background: deepskyblue;
    padding: 5px;
    margin-top: 40px;
    border-radius: 90px;
    font-weight: 600;
    cursor: pointer;
    width: 350px;
    color: white;
}

input[type="submit"]:active{
    background: linear-gradient(90deg,#45f3ff,#d9138a);
    opacity: 0.8;
}
</style>
</head>
<body>
<img src="tiktok-dance-unscreen-ezgif.com-resize.gif" alt=""  style="margin-left: -15%;">
    <?php
     $server='localhost';
      $uname='root';
     $password='';
     $db='aura_dance';
     $conn=new mysqli($server,$uname,$password,$db);

     if($conn->connect_error){
       die("Connection failed: ".$conn->connect_error);
     }

     if($_GET['email'] && isset($_GET['reset_token'])){
        $email=$_GET['email'];
        $token=$_GET['reset_token'];
        date_default_timezone_set("Asia/Kolkata");
        $date=date("Y-m-d");
        $query="SELECT * FROM users WHERE email='$email' AND reset_token='$token' AND reset_at='$date'";
        $result=$conn->query($query);
        if($result){
            if(mysqli_num_rows($result)==1){
                echo"<div class='card'>
                <p class='lock-icon'><i class='fas fa-lock'></i></p>
                <h1>Create New Password</h1>
                <p>You can reset your Password here</p><br>
                <form method='post' action=''>
                  <h3>Enter email</h3>
                  <input type='password' placeholder='New Password' name='password' required>
                  <button type='submit' name='updatepassword'>Update</button>
                  <input type='hidden' name='email' value='$_GET[email]'>
                </form>
                </div>";

            }else{
                echo("<script language='javascript'>
                window.alert('Invalid or Expired Link')
                window.location.href='forgot.php'
                </script>");
                exit();
            }
        }else{
            echo("<script language='javascript'>
            window.alert('Server down.Try again Later')
            window.location.href='forgot.php'
            </script>");
            exit();
        }
     }
     ?>

     <?php
      if(isset($_POST['updatepassword'])){
        $passw=$_POST['password'];
        // Hash new password for security using BCRYPT
        $hashedPassword = password_hash($passw, PASSWORD_BCRYPT);
        $update="UPDATE users SET password='$hashedPassword' , reset_token=NULL , reset_at=NULL WHERE email='$_POST[email]'";
        if(mysqli_query($conn,$update)){
            echo("<script language='javascript'>
            window.alert('Password reset successful')
            window.location.href='Login.html'
            </script>");
            exit();
        } else{
            echo("<script language='javascript'>
            window.alert('Server down try again later')
            window.location.href='forgot.php'
            </script>");
            exit();
        }
      }
      ?>
</body>
</html>