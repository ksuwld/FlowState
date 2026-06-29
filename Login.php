<?php
session_start();

$host = 'localhost';
$db   = 'flowstate'; 
$user = 'root';
$pass = 'root';      

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $foundUser = $stmt->fetch();
    
    if ($foundUser) {
        $_SESSION['user_id'] = $foundUser['id'];
        
        header("Location: Dashboard.php");
        exit;
    } else {
        $error = "Аккаунт с таким Email не найден. Пожалуйста, зарегистрируйтесь.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход — FlowState</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Manrope:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Login.css">
</head>
<body>

    <div class="split-layout">
        
        <div class="left-panel">
            <a href="Cabinet.php" class="back-link">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                Назад
            </a>
            <img src="img/Регистрация.png" alt="Йога" class="login-img">
        </div>

        <div class="right-panel">
            <div class="login-card">
                <h1 class="login-title">ВХОД</h1>
                
                <div class="login-form-wrapper">
                    <?php if (!empty($error)): ?>
                        <p style="color: #a84242; text-align: center; margin-bottom: 15px; font-family: 'Manrope', sans-serif;"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <form id="loginForm" action="" method="POST" class="login-form">
                        <input type="text" name="name" placeholder="Имя" required>
                        <input type="text" name="surname" placeholder="Фамилия" required>
                        <input type="tel" name="phone" placeholder="+7 (XXX) XXX-XX-XX" 
                            pattern="\+7\s?[\(]{0,1}[0-9]{3}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" 
                            title="Формат: +7 (XXX) XXX-XX-XX" required>
                        <input type="email" name="email" id="loginEmail" placeholder="Email" required>
                        <button type="submit" class="btn-submit">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        const email = document.getElementById('loginEmail').value;
        
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Пожалуйста, введите корректный адрес электронной почты.");
            event.preventDefault();
            return;
        }
    });
    </script>
</body>
</html>