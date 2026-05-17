<?php
require 'config.php';

 if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["cat"])){
    $cat = isset($_POST["categ"]) ? trim($_POST["categ"]) : '';
    $context = isset($_POST["context"]) ? trim($_POST["context"]) : '';
    
    // Validate input
    if(empty($cat) || empty($context)) {
        echo("<script language='javascript'>
        window.alert('Please fill in all fields')
        window.location.href='studentform.php'
        </script>");
        exit();
    }
    
    try {
        // Check if category already exists using prepared statement
        $stmt = $conn->prepare("SELECT cat_id FROM category WHERE cat = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $cat);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        
        if($result->num_rows >= 1) {
            echo("<script language='javascript'>
            window.alert('The Dance category already exists')
            window.location.href='studentform.php'
            </script>");
            exit();
        }
        
        $stmt->close();
        
        // Insert new category using prepared statement
        $stmt = $conn->prepare("INSERT INTO category(cat, context) VALUES(?, ?)");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $cat, $context);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        echo("<script language='javascript'>
        window.alert('Dance category added successfully')
        window.location.href='studentform.php'
        </script>");
        $stmt->close();
        exit();
    } catch (Exception $e) {
        error_log("Category addition error: " . $e->getMessage());
        echo("<script language='javascript'>
        window.alert('An error occurred. Please try again later.')
        window.location.href='studentform.php'
        </script>");
        exit();
    }
 }

 ?>