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
    die("Ошибка подключения к БД. Проверь настройки: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // Считываем введенный пароль

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        $error = "Пользователь с таким Email уже зарегистрирован!";
    } else {
        // Хэшируем пароль для безопасного хранения в БД
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // tariff_name убран из запроса, так как в БД для него задан по умолчанию NULL
        $sql = "INSERT INTO users (name, surname, phone, email, balance, password) VALUES (?, ?, ?, ?, 0, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $surname, $phone, $email, $hashed_password]);
        
        $_SESSION['user_id'] = $pdo->lastInsertId();
        
        header("Location: Dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация — FlowState</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Manrope:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Registration.css">
</head>
<body>

    <div class="split-layout">
        
        <div class="left-panel">
            <a href="Cabinet.php" class="back-link">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                Назад
            </a>
            <img src="img/Регистрация.png" alt="Йога" class="reg-img">
        </div>

        <div class="right-panel">
            <div class="reg-card">
                <h1 class="reg-title">РЕГИСТРАЦИЯ</h1>
                
                <div class="reg-form-wrapper">
                    
                    <?php if (!empty($error)): ?>
                        <p style="color: #a84242; text-align: center; margin-bottom: 15px; font-family: 'Manrope', sans-serif;"><?php echo $error; ?></p>
                    <?php endif; ?>

                    <form id="regForm" action="" method="POST" class="reg-form">
                        <input type="text" id="name" name="name" placeholder="Имя" required>
                        <input type="text" id="surname" name="surname" placeholder="Фамилия" required>
                        <input type="tel" id="phone" name="phone" placeholder="+7 (XXX) XXX-XX-XX" 
                            pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" 
                            title="Формат: +7 (XXX) XXX-XX-XX" required>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        
                        <input type="password" id="password" name="password" placeholder="Придумайте пароль" required minlength="6">
                        
                        <button type="submit" class="btn-submit">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
    document.getElementById('regForm').addEventListener('submit', function(event) {
        const email = document.getElementById('email').value;
        
        if (!email.includes('.') || email.indexOf('@') === -1) {
            alert('Пожалуйста, введите корректный email (например, name@mail.ru)');
            event.preventDefault();
            return;
        }
        
        console.log("Форма прошла валидацию!");
    });
    </script>
</body>
</html>