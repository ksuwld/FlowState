<?php
session_start();

require_once 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit('Пожалуйста, авторизуйтесь');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    
    $teacher = $_POST['teacher_name'] ?? 'Неизвестный тренер';
    $class_name = $_POST['class_name'] ?? 'Индивидуальное занятие';
    $dateStr = $_POST['workout_date'] ?? date('d.m.Y'); 
    $timeStr = $_POST['workout_time'] ?? '12:00 - 13:00'; 

    $sql = "INSERT INTO workouts (user_id, workout_date, workout_time, workout_name, teacher_name) VALUES (?, ?, ?, ?, ?)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $dateStr, $timeStr, $class_name, $teacher]);
        echo "Запись успешно добавлена!";
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Ошибка базы данных: " . $e->getMessage();
    }
}
?>