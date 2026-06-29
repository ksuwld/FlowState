<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет — FlowState</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Manrope:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Cabinet.css">
</head>
<body>

    <div class="split-layout">
        
        <div class="left-panel">
            <a href="index.php" class="back-link">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                Назад
            </a>
            
            <div class="auth-content">
                <h1 class="cabinet-title">ЛИЧНЫЙ КАБИНЕТ FlowState</h1>
                
                <div class="auth-buttons">
                    <a href="Registration.php" class="btn-auth">РЕГИСТРАЦИЯ</a>
                    <a href="Login.php" class="btn-auth">ВХОД</a>
                </div>
                
                <div class="auth-footer-text">
                    <p>Впервые у нас?</p>
                    <p>Присоединяйтесь к сообществу студии FlowState!</p>
                    <p>Регистрация займет меньше минуты, и вы сразу</p>
                    <p>сможете начать планировать свои занятия</p>
                </div>
            </div>
        </div>

        <div class="right-panel">
            <img src="img/Yoga-cabinet.png" alt="Йога" class="cabinet-img">
        </div>

    </div>

</body>
</html>