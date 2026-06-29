<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php"); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    
    $name = $_POST['workout_name'];
    $teacher = $_POST['teacher_name'];
    $date = $_POST['workout_date'];
    $time = $_POST['workout_time'];

    try {
        $stmt_teacher = $pdo->prepare("SELECT id FROM teachers WHERE full_name = ? LIMIT 1");
        $stmt_teacher->execute([$teacher]);
        $teacher_row = $stmt_teacher->fetch(PDO::FETCH_ASSOC);
        
        $teacher_id = $teacher_row ? $teacher_row['id'] : 2; 
    } catch (PDOException $e) {
        $teacher_id = 2; 
    }

    $sql = "INSERT INTO workouts (user_id, workout_name, teacher_name, workout_date, workout_time, teacher_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([$user_id, $name, $teacher, $date, $time, $teacher_id]);

    header("Location: Dashboard.php");
    exit;
}
?>