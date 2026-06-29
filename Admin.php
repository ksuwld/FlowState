<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit;
}

if ($_SESSION['user_id'] != 2) { 
    die("<h2 style='color: #a84242; font-family: Arial, sans-serif; text-align: center; margin-top: 50px;'>
        Доступ запрещен! У вас нет прав администратора.
        <br><br>
        <a href='index.php' style='color: #8D977F; text-decoration: none;'>← Вернуться на главную</a>
    </h2>"); 
    exit;
}

$table = $_GET['table'] ?? 'users';
$action = $_GET['action'] ?? 'list';

$allowed_tables = ['users', 'tariffs', 'workouts', 'teachers', 'reviews'];
$is_table = in_array($table, $allowed_tables);

$allowed_views = [
    'view_active_subscriptions', 
    'view_tariff_revenue', 
    'view_teacher_stats', 
    'view_workout_schedule', 
    'view_user_activity'
];
$is_view = in_array($table, $allowed_views);

if (!$is_table && !$is_view) {
    $table = 'users';
    $is_table = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id']) && $is_table) {
    $delete_id = $_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM `$table` WHERE id = ?");
    $stmt->execute([$delete_id]);
    header("Location: Admin.php?table=$table"); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_record']) && $is_table) {
    unset($_POST['add_record']);
    $fields = [];
    $placeholders = [];
    $values = [];
    
    foreach ($_POST as $key => $val) {
        $clean_val = trim($val);
        
        $fields[] = "`$key`";
        $placeholders[] = "?";
        
        // ГЛАВНОЕ ИСПРАВЛЕНИЕ: превращаем пустые строки (например, пустой teacher_id) в чистый NULL
        $values[] = ($clean_val === '') ? null : $clean_val;
    }
    
    $sql = "INSERT INTO `$table` (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);
    header("Location: Admin.php?table=$table");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_record']) && $is_table) {
    $id = $_POST['record_id'];
    unset($_POST['edit_record'], $_POST['record_id']);
    $sets = [];
    $values = [];
    
    foreach ($_POST as $key => $val) {
        $clean_val = trim($val);
        

        $sets[] = "`$key` = ?";
        
        // ГЛАВНОЕ ИСПРАВЛЕНИЕ: превращаем пустые строки в чистый NULL
        $values[] = ($clean_val === '') ? null : $clean_val;
    }
    $values[] = $id;
    
    $sql = "UPDATE `$table` SET " . implode(',', $sets) . " WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);
    header("Location: Admin.php?table=$table");
    exit;
}

$columns = [];
if ($is_table) {
    $columns = $pdo->query("DESCRIBE `$table`")->fetchAll(PDO::FETCH_ASSOC);
}

$edit_row = null;
if ($action === 'edit' && isset($_GET['id']) && $is_table) {
    $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $edit_row = $stmt->fetch(PDO::FETCH_ASSOC);
}

$stmt = $pdo->query("SELECT * FROM `$table`");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель Администратора</title>
    <link rel="stylesheet" href="Admin.css">
</head>
<body>

<div class="admin-container">
    <a href="index.php" class="back-link">← Вернуться на сайт</a>
    <h1>Панель управления базой данных</h1>

    <div class="nav-links">
        <strong>Таблицы:</strong>
        <?php foreach($allowed_tables as $t): ?>
            <a href="?table=<?= $t ?>" class="<?= $table === $t && $action !== 'add' ? 'active' : '' ?>"><?= ucfirst($t) ?></a>
        <?php endforeach; ?>

        <strong style="margin-left: 25px; border-left: 2px solid #ccc; padding-left: 25px;">Представления:</strong>
        <a href="?table=view_active_subscriptions" class="<?= $table === 'view_active_subscriptions' ? 'active' : '' ?>">Активные подписки</a>
        <a href="?table=view_tariff_revenue" class="<?= $table === 'view_tariff_revenue' ? 'active' : '' ?>">Выручка по тарифам</a>
        <a href="?table=view_teacher_stats" class="<?= $table === 'view_teacher_stats' ? 'active' : '' ?>">Статистика преподавателей</a>
        <a href="?table=view_workout_schedule" class="<?= $table === 'view_workout_schedule' ? 'active' : '' ?>">Общее расписание</a>
        <a href="?table=view_user_activity" class="<?= $table === 'view_user_activity' ? 'active' : '' ?>">Активность клиентов</a>
    </div>

    <?php if ($action === 'add' && $is_table): ?>
        <div class="form-block">
            <h2>Добавить запись в таблицу <?= htmlspecialchars($table) ?></h2>
            <form method="POST">
                <?php foreach ($columns as $col): 
                    if ($col['Extra'] === 'auto_increment' || $col['Field'] === 'id') continue; ?>
                    <div class="form-group">
                        <label><?= htmlspecialchars($col['Field']) ?></label>
                        <input type="text" name="<?= htmlspecialchars($col['Field']) ?>">
                    </div>
                <?php endforeach; ?>
                <button type="submit" name="add_record" class="btn-submit">Сохранить новую запись</button>
                <a href="?table=<?= $table ?>" style="margin-left: 10px; color: #666;">Отмена</a>
            </form>
        </div>

    <?php elseif ($action === 'edit' && $edit_row && $is_table): ?>
        <div class="form-block">
            <h2>Редактировать запись ID <?= htmlspecialchars($_GET['id']) ?> в таблице <?= htmlspecialchars($table) ?></h2>
            <form method="POST">
                <input type="hidden" name="record_id" value="<?= htmlspecialchars($_GET['id']) ?>">
                <?php foreach ($columns as $col): 
                    if ($col['Extra'] === 'auto_increment' || $col['Field'] === 'id') continue; ?>
                    <div class="form-group">
                        <label><?= htmlspecialchars($col['Field']) ?></label>
                        <input type="text" name="<?= htmlspecialchars($col['Field']) ?>" value="<?= htmlspecialchars($edit_row[$col['Field']] ?? '') ?>">
                    </div>
                <?php endforeach; ?>
                <button type="submit" name="edit_record" class="btn-submit">Сохранить изменения</button>
                <a href="?table=<?= $table ?>" style="margin-left: 10px; color: #666;">Отмена</a>
            </form>
        </div>

    <?php else: ?>
        <h2>Просмотр сущности: <?= htmlspecialchars($table) ?></h2>
        
        <?php if ($is_table): ?>
            <a href="?table=<?= $table ?>&action=add" class="btn-add">+ Добавить новую запись</a>
        <?php endif; ?>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <?php if(!empty($data)) foreach(array_keys($data[0]) as $col): ?>
                            <th><?= htmlspecialchars($col) ?></th>
                        <?php endforeach; ?>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data)): ?>
                        <tr><td colspan="100%" style="text-align: center; color: #999;">В этой сущности пока нет данных.</td></tr>
                    <?php else: ?>
                        <?php foreach ($data as $row): ?>
                        <tr>
                            <?php foreach ($row as $cell): ?>
                                <td><?= htmlspecialchars($cell ?? 'NULL') ?></td>
                            <?php endforeach; ?>
                            <td>
                                <?php if ($is_table): ?>
                                    <a href="?table=<?= $table ?>&action=edit&id=<?= $row['id'] ?>" class="btn-edit">Изменить</a>
                                    <form method="POST" style="display:inline;" onsubmit="return confirm('Точно удалить эту запись?');">
                                        <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn-delete">Удалить</button>
                                    </form>
                                <?php else: ?>
                                    <span style="color:#777; font-size:12px;">Только чтение</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
</body>
</html>