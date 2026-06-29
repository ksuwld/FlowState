<?php
session_start();
require_once 'db.php';

if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name = ?, surname = ?, phone = ?, email = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $surname, $phone, $email, $id]);

    header("Location: admin.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    die("Пользователь не найден.");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #F6F1E4; padding: 40px; color: #333; }
        .edit-container { max-width: 500px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        h1 { color: #8D977F; font-size: 24px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;
        }
        .btn-save { background-color: #8D977F; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .btn-save:hover { background-color: #7A8A73; }
        .btn-back { display: inline-block; margin-top: 15px; color: #666; text-decoration: none; }
    </style>
</head>
<body>

    <div class="edit-container">
        <h1>Редактировать пользователя</h1>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Имя</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Фамилия</label>
                <input type="text" name="surname" value="<?= htmlspecialchars($user['surname']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Телефон</label>
                <input type="tel" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            
            <button type="submit" class="btn-save">Сохранить изменения</button>
        </form>
        
        <a href="admin.php" class="btn-back">← Назад в админку</a>
    </div>

</body>
</html>