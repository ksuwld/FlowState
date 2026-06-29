<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user_id']) && isset($_POST['tariff'])) {
    $new_tariff = trim($_POST['tariff']);
    $user_id = $_SESSION['user_id'];

    // Записываем выбранный тариф в только что созданную колонку
    $sql = "UPDATE users SET tariff_name = ? WHERE id = ?";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$new_tariff, $user_id]);
        
        http_response_code(200);
        echo "OK";
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Ошибка БД: " . $e->getMessage();
    }
} else {
    http_response_code(403);
    echo "Нет доступа";
}
?>