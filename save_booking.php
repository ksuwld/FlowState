<?php
session_start();
require_once 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit("Не авторизован");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $teacher = $_POST['teacher_name'];
    $class = $_POST['class_name'];
    $date = date('Y-m-d'); 
    $time = $_POST['time'];

    $sql = "INSERT INTO bookings (user_id, teacher_name, class_name, booking_date, booking_time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$user_id, $teacher, $class, $date, $time])) {
        echo "Запись успешна";
    } else {
        http_response_code(500);
        echo "Ошибка базы данных";
    }
}
?>