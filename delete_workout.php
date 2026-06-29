<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $workout_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    
    $sql = "DELETE FROM workouts WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$workout_id, $user_id]);
}

header("Location: Dashboard.php");
exit;
?>