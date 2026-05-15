<?php
if(isset($_POST['logout'])){
    session_start();
    session_destroy();
    header("Locatiom:bootstrap.html");
}
 echo("<script language='javascript'>
if( window.confirm('Are you sure you want to logout')){
    window.location.href = 'bootstrap.html';
}else
 window.location.href='bootstrap1.html'
 </script>");
 exit();
 ?>