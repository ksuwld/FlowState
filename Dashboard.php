<?php
session_start();
require_once 'db.php'; 

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) { header("Location: Login.php"); exit; }

$stmt_user = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt_user->execute([$user_id]);
$user_info = $stmt_user->fetch();

$stmt = $pdo->prepare("SELECT * FROM workouts WHERE user_id = ?");
$stmt->execute([$user_id]);
$workouts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет — FlowState</title>
    <div class="quote-container">
    <h3 class="quote-title">Вдохновение на сегодня:</h3>
    <p id="api-quote" class="quote-text">Загрузка мысли...</p>
    <p id="api-author" class="quote-author"></p>
</div>
    <link rel="stylesheet" href="Dashboard.css">
</head>
<body>
    <a href="Logout.php" class="logout-link">Выйти</a>
    <a href="index.php" class="back-link-top">← Назад</a>

    <div class="dashboard-container">
        <h1 class="dash-title">ЛИЧНЫЙ КАБИНЕТ FlowState</h1>
        
        <div class="top-cards-row">
        <div class="info-card">
            <?php if (!empty(trim($user_info['tariff_name'] ?? ''))): ?>
    <h3>Тариф "<?= htmlspecialchars($user_info['tariff_name']) ?>"</h3>
    <p class="sub-text">следующий платеж через 30 дней</p>
    <p class="price-text">
        <?php 
        if ($user_info['tariff_name'] === 'Старт') echo '3 500 ₽';
        elseif ($user_info['tariff_name'] === 'Дыхание') echo '5 000 ₽';
        elseif ($user_info['tariff_name'] === 'PRO') echo '7 900 ₽';
        else echo htmlspecialchars($user_info['tariff_name']);
        ?>
    </p>
<?php else: ?>
    <h3>Тариф не выбран</h3>
    <p class="sub-text">Активируйте подписку на странице цен</p>
    <p class="price-text">0 ₽</p>
<?php endif; ?>
        </div>
        
        <div class="info-card">
        <h3>Мой баланс</h3>
        <p class="balance-amount"><?= htmlspecialchars($user_info['balance'] ?? 0) ?> ₽</p>
        </div>
        </div>

        <div class="schedule-container">
            <h2 class="schedule-title">Мои записи на тренировки</h2>
            
            <?php if (empty($workouts)): ?>
                <p style="text-align:center; padding: 40px; color: #666;">У вас пока нет записей на тренировки.</p>
            <?php else: ?>
                <div class="workouts-list">
                    <?php foreach ($workouts as $w): ?>
                        <div class="workout-item">
                            <div class="workout-datetime">
                                <p class="w-date"><?= htmlspecialchars($w['workout_date']) ?></p>
                                <p class="w-time"><?= htmlspecialchars($w['workout_time']) ?></p>
                            </div>
                            <div class="workout-info">
                                <p class="w-name"><strong><?= htmlspecialchars($w['workout_name']) ?></strong></p>
                                <p class="w-teacher">Тренер: <?= htmlspecialchars($w['teacher_name']) ?></p>
                            </div>
                            <div class="workout-action">
                                <form method="POST" action="delete_workout.php">
                                    <input type="hidden" name="id" value="<?= $w['id'] ?>">
                                    <button type="submit" class="btn-cancel">Отменить запись</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const apiUrl = "https://zenquotes.io/api/random";
            const proxyUrl = "https://api.allorigins.win/raw?url=";

            fetch(proxyUrl + encodeURIComponent(apiUrl))
                .then(response => {
                    if (!response.ok) throw new Error('Ответ сети не ok');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('api-quote').textContent = "«" + data[0].q + "»";
                    document.getElementById('api-author').textContent = "— " + data[0].a;
                })
                .catch(error => {
                    document.getElementById('api-quote').textContent = "«Вдыхай будущее, выдыхай прошлое»";
                    console.log("Ошибка загрузки API: ", error);
                });
        });
    </script>
</body>
</html>