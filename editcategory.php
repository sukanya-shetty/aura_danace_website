<?php
require 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_id = isset($_POST['cat_id']) ? intval($_POST['cat_id']) : 0;
    $categ = isset($_POST['categ']) ? trim($_POST['categ']) : '';
    $context = isset($_POST['context']) ? trim($_POST['context']) : '';
    
    // Validate input
    if($cat_id <= 0 || empty($categ) || empty($context)) {
        echo "<script language='javascript'>
        window.alert('Invalid input. Please try again.')
        window.location.href='studentform.php'
        </script>";
        exit();
    }
    
    try {
        // Update category using prepared statement
        $stmt = $conn->prepare("UPDATE category SET cat = ?, context = ? WHERE cat_id = ?");
        if(!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssi", $categ, $context, $cat_id);
        if(!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        
        echo "<script language='javascript'>
        window.alert('Category updated successfully')
        window.location.href='studentform.php'
        </script>";
        exit;
    } catch (Exception $e) {
        error_log("Category update error: " . $e->getMessage());
        echo "<script language='javascript'>
        window.alert('Error updating category. Please try again later.')
        window.location.href='studentform.php'
        </script>";
        exit;
    }
}
$conn->close();
?>
