<?php
$host = "localhost";
$db   = "aura_dance";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     die("Connection failed: " . $e->getMessage());
}

echo "--- ALL STUDENTS ---\n";
$stmt = $pdo->query("SELECT * FROM students");
while ($row = $stmt->fetch()) {
    print_r($row);
}

echo "\n--- ENROLLMENTS WITH NAMES ---\n";
$query = "SELECT s.first_name, s.last_name, c.name as course_name 
          FROM enrollments e 
          JOIN students s ON e.student_id = s.id 
          JOIN courses c ON e.course_id = c.id";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch()) {
    print_r($row);
}
?>
