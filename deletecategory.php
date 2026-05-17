<?php
require 'config.php';

if(isset($_GET['cat_id'])) {
    $cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
    
    if($cat_id <= 0) {
        die("Invalid category ID");
    }
    
    try {
        // Use prepared statement to delete category
        $stmt = $conn->prepare("DELETE FROM category WHERE cat_id = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $cat_id);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        
        header("Location: studentform.php");
        exit;
    } catch (Exception $e) {
        error_log("Category deletion error: " . $e->getMessage());
        echo("<script language='javascript'>
        window.alert('Error deleting category. Please try again later.')
        window.location.href='studentform.php'
        </script>");
        exit;
    }
}

$conn->close();
?>
