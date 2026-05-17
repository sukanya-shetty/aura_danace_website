<?php
require 'config.php';

echo "--- ALL STUDENTS ---\n";
$stmt = $conn->query("SELECT * FROM students");
while ($row = $stmt->fetch_assoc()) {
    print_r($row);
}

echo "\n--- ENROLLMENTS WITH NAMES ---\n";
$query = "SELECT s.first_name, s.last_name, c.name as course_name 
          FROM enrollments e 
          JOIN students s ON e.student_id = s.id 
          JOIN courses c ON e.course_id = c.id";
$stmt = $conn->query($query);
while ($row = $stmt->fetch_assoc()) {
    print_r($row);
}
?>
