<?php
session_start();
require_once 'db.php';

$stmt = $pdo->prepare("SELECT * FROM teachers");
$stmt->execute();
$teachers = $stmt->fetchAll();

// Теперь мы связываем красивый дизайн с ИМЕНЕМ тренера, а не с его ID.
// Если ты удалишь тренера и добавишь заново, его фото всё равно подтянется!
$teacher_meta = [
    'Анисимова Анна' => ['img' => 'Anisimova.png', 'exp' => '10 лет', 'spec' => 'Morning Flow', 'price' => '4 500', 'rating' => '5', 'reviews' => '7 отзывов', 'link' => 'teacher-anna.php'],
    'Казакова Ирина' => ['img' => 'Kazakova.png', 'exp' => '15 лет', 'spec' => 'Healthy Spine', 'price' => '7 000', 'rating' => '5', 'reviews' => '10 отзывов', 'link' => 'teacher-irina.php'],
    'Абрамова Елена' => ['img' => 'Abramova.png', 'exp' => '8 лет', 'spec' => 'Deep Stretch', 'price' => '5 000', 'rating' => '5', 'reviews' => '6 отзывов', 'link' => 'teacher-elena.php'],
    'Лапина Мария' => ['img' => 'Lapina.png', 'exp' => '11 лет', 'spec' => 'Yin Yoga', 'price' => '7 500', 'rating' => '5', 'reviews' => '11 отзывов', 'link' => 'teacher-maria.php'],
    'Голубева Таисия' => ['img' => 'Golybeva.png', 'exp' => '7 лет', 'spec' => 'Pilates Mat', 'price' => '3 500', 'rating' => '4,5', 'reviews' => '8 отзывов', 'link' => 'teacher-taisia.php'],
    'Авдеев Денис' => ['img' => 'Avdeev.png', 'exp' => '9 лет', 'spec' => 'Split Stretching', 'price' => '5 000', 'rating' => '4', 'reviews' => '8 отзывов', 'link' => 'teacher-denis.php'],
    'Ефимова Светлана' => ['img' => 'Efimova.png', 'exp' => '5 лет', 'spec' => 'Hatha Yoga', 'price' => '3 900', 'rating' => '5', 'reviews' => '6 отзывов', 'link' => 'teacher-svetlana.php'],
    'Кудрявцева Анна' => ['img' => 'Kydravseva.png', 'exp' => '3 года', 'spec' => 'MFR & Stretch', 'price' => '2 500', 'rating' => '5', 'reviews' => '4 отзывов', 'link' => 'teacher-kydravceva.php'],
    'Михеева Мария' => ['img' => 'Miheeva.png', 'exp' => '4 года', 'spec' => 'Detox Yoga', 'price' => '3 500', 'rating' => '5', 'reviews' => '5 отзывов', 'link' => 'teacher-miheeva.php'],
    'Мухин Михаил' => ['img' => 'Myhin.png', 'exp' => '2 года', 'spec' => 'Pilates Props', 'price' => '2 000', 'rating' => '5', 'reviews' => '3 отзыва', 'link' => 'teacher-mihail.php'],
    'Василькова Ангелина' => ['img' => 'Vasilkova.png', 'exp' => '4 года', 'spec' => '3D Pilates', 'price' => '3 700', 'rating' => '4', 'reviews' => '6 отзывов', 'link' => 'teacher-angelina.php'],
    'Журавлёв Алексей' => ['img' => 'Zhuravlev.png', 'exp' => '6 лет', 'spec' => 'Power Yoga', 'price' => '4 000', 'rating' => '5', 'reviews' => '5 отзывов', 'link' => 'teacher-alecsey.php'],
    'Чернышова Алиса' => ['img' => 'Chernchova.png', 'exp' => '9 лет', 'spec' => 'Aero Stretching', 'price' => '5 500', 'rating' => '5', 'reviews' => '9 отзывов', 'link' => 'teacher-alisa.php'],
    'Сидоров Сергей' => ['img' => 'Sidorov.png', 'exp' => '6 лет', 'spec' => 'Pilates Cardio', 'price' => '4 500', 'rating' => '4', 'reviews' => '10 отзывов', 'link' => 'teacher-sergey.php'],
    'Буниатян Алиса' => ['img' => 'Byniatan.png', 'exp' => '2 года', 'spec' => 'Functional Stretch', 'price' => '2 500', 'rating' => '5', 'reviews' => '3 отзыва', 'link' => 'teacher-byniatan.php'],
    'Волков Владислав' => ['img' => 'Volkov.png', 'exp' => '7 лет', 'spec' => 'Insade Flow', 'price' => '6 500', 'rating' => '5', 'reviews' => '8 отзывов', 'link' => 'teacher-vladislav.php'],
    'Смирнов Андрей' => ['img' => 'Cmirnova.png', 'exp' => '5 лет', 'spec' => 'Pilates Recovery', 'price' => '4 400', 'rating' => '4', 'reviews' => '5 отзывов', 'link' => 'teacher-andrey.php'],
    'Смирнов Сергей' => ['img' => 'Cmirnova.png', 'exp' => '5 лет', 'spec' => 'Pilates Recovery', 'price' => '4 400', 'rating' => '4', 'reviews' => '5 отзывов', 'link' => 'teacher-andrey.php'], // На случай если ты оставишь имя Сергей
    'Капорина Татьяна' => ['img' => 'Kaporina.png', 'exp' => '2 года', 'spec' => 'Posture Stretch', 'price' => '2 400', 'rating' => '4', 'reviews' => '3 отзыва', 'link' => 'teacher-tatiana.php']
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Преподаватели — FlowState</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Arial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Teachers.css">
</head>
<body class="page-teachers-new"> 

    <header class="header">
        <div class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="FlowState Logo">
            </a>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="Directions.php">Направления</a></li>
                <li><a href="Teachers.php" class="active" >Преподаватели</a></li>
                <li><a href="Prices.php">Цены</a></li>
                <li><a href="reviews.php">Отзывы</a></li>
                <li><a href="contacts.php">Контакты</a></li>
                <li>
                    <a href="<?php echo isset($_SESSION['user_id']) ? 'Dashboard.php' : 'Cabinet.php'; ?>">Личный кабинет</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="teachers-section">
        <h1 class="teachers-main-title">НАШИ ПРЕПОДАВАТЕЛИ</h1>
        <p class="teachers-main-subtitle">
            Ваши проводники в мир осознанного движения. В нашей команде нет случайных людей — только топовые эксперты, влюбленные в свое дело. Они знают, как заставить мышцы работать эффективно, а ум — полностью расслабиться. Мы не верим в тренировки через силу и боль, мы верим в бережное отношение к себе, баланс и видимый результат с первого занятия.
        </p>

        <div class="teachers-grid">
            
            <?php foreach ($teachers as $teacher): ?>
                <?php 
                $name_key = trim($teacher['full_name']);
                // Заглушка, если добавишь в админке тренера с совсем новым именем
                $meta = $teacher_meta[$name_key] ?? [
                    'img' => 'default.png', 'exp' => 'не указан', 'spec' => 'Новое направление', 
                    'price' => 'от 2 000', 'rating' => '5', 'reviews' => '0 отзывов', 'link' => '#'
                ];
                ?>
                <div class="teacher-card">
                    <div class="teacher-card-img-wrapper">
                        <img src="img/<?= htmlspecialchars($meta['img']) ?>" alt="<?= htmlspecialchars($teacher['full_name']) ?>">
                        <div class="teacher-experience-badge">Стаж: <?= htmlspecialchars($meta['exp']) ?></div>
                    </div>
                    <div class="teacher-card-info">
                        <h3 class="teacher-name"><?= htmlspecialchars($teacher['full_name']) ?></h3>
                        <p class="teacher-specialty">Преподаватель по "<?= htmlspecialchars($meta['spec']) ?>"</p>
                        <p class="teacher-price">от <strong><?= htmlspecialchars($meta['price']) ?> ₽</strong> персональная тренировка</p>
                        <div class="teacher-rating">
                            <span class="teacher-star">⭐</span>
                            <strong><?= htmlspecialchars($meta['rating']) ?></strong>
                            <span class="teacher-reviews"><?= htmlspecialchars($meta['reviews']) ?></span>
                        </div>
                    </div>
                    <a href="<?= htmlspecialchars($meta['link']) ?>" class="btn-more">Подробнее</a>
                </div>
            <?php endforeach; ?>

        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentPath = window.location.pathname; 
            const navLinks = document.querySelectorAll('.main-nav a');

            navLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                if (linkHref === '#') return;
                if (currentPath.includes(linkHref) || (linkHref === 'Teachers.php' && currentPath.includes('teacher-'))) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>