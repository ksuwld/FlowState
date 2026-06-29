<?php
session_start();
require_once 'db.php'; 

$static_reviews = [
    ['name' => 'Мурыкина Анна', 'avatar' => 'ava1.png', 'rating' => 5.0, 'text' => 'Ирина спасла мою шею! После 10 лет сидячей работы я забыла, что такое поворачивать голову без хруста. Очень деликатный подход.'],
    ['name' => 'Иголкин Игорь', 'avatar' => 'ava2.png', 'rating' => 5.0, 'text' => 'Пришел по рекомендации невролога. Тренировки спокойные, но мышцы горят. Спина перестала ныть уже через три недели.'],
    ['name' => 'Котырин Семён', 'avatar' => 'ava3.png', 'rating' => 5.0, 'text' => 'Ирина объясняет анатомию так просто и понятно. Теперь я сама контролирую осанку в течение дня!'],
    ['name' => 'Даванков Максим', 'avatar' => 'ava9.png', 'rating' => 5.0, 'text' => 'Работаю программистом, поясница просто "отваливалась" к концу дня. Ирина буквально научила меня заново сидеть и стоять. Упражнения на коврике кажутся легкими, но эффект колоссальный. Боль ушла полностью всего за месяц!'],
    ['name' => 'Воркович Полина', 'avatar' => 'ava5.png', 'rating' => 5.0, 'text' => 'Пришла к Ирине после родов с постоянными болями в крестце. Очень бережный подход, никаких резких скруток и перегрузок. Через два месяца регулярных занятий спина снова стала сильной, а осанка — ровной.'],
    ['name' => 'Суворов Евгений', 'avatar' => 'ava8.png', 'rating' => 5.0, 'text' => 'У меня легкая асимметрия из-за сколиоза. Ирина подобрала комплекс именно под мои особенности и перекосы. Тренировки очень вдумчивые. Чувствую, как позвоночник вытягивается, появилось невероятное ощущение легкости в грудном отделе.'],
    ['name' => 'Лукревич Маргарита', 'avatar' => 'ava7.png', 'rating' => 5.0, 'text' => 'Ирина — настоящий профессионал с глубоким знанием анатомии. Она не просто говорит "сделай так", она объясняет, какая мышца должна работать и почему. Наконец-то я поняла, что такое "дышать в ребра" и как контролировать свой таз!'],
    ['name' => 'Кутузова Алина', 'avatar' => 'ava10.png', 'rating' => 5.0, 'text' => 'Из-за шейного остеохондроза часто мучали мигрени и бессонница. Занятия "Healthy Spine" стали моим спасением. Ирина снимает напряжение в шее так деликатно и профессионально, что я стала спать всю ночь не просыпаясь.'],
    ['name' => 'Копорина Ксения', 'avatar' => 'ava11.png', 'rating' => 5.0, 'text' => 'Для меня было открытием, что закачивать спину тяжелыми весами в тренажерном зале — это не выход. На пилатесе с Ириной мы включили глубокие мышцы-стабилизаторы, о которых я даже не подозревала. Теперь спина держит себя сама без всяких усилий!'],
    ['name' => 'Понамарюк Виктор', 'avatar' => 'ava12.png', 'rating' => 5.0, 'text' => 'В 50 лет думал, что постоянная скованность по утрам и ноющая спина — это уже возрастное и навсегда. Ирина доказала обратное! Замечательный тренер, который возвращает молодость суставам через умное движение.'],
    ['name' => 'Тушковин Сергей', 'avatar' => 'ava13.png', 'rating' => 5.0, 'text' => 'Для меня тренировки с Ириной были просто спасением! Поменял множенство тренеров и наконец-то нашел по настоящему качественные и действующие программы. Всем советую!']
];

try {
    $stmt_id = $pdo->prepare("SELECT id FROM teachers WHERE full_name = 'Казакова Ирина' LIMIT 1");
    $stmt_id->execute();
    $t_row = $stmt_id->fetch(PDO::FETCH_ASSOC);
    $teacher_id = $t_row ? $t_row['id'] : 10; 

    $stmt = $pdo->prepare("SELECT * FROM reviews WHERE teacher_id = ? ORDER BY id DESC");
    $stmt->execute([$teacher_id]);
    $db_reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $db_reviews = [];
}

$all_reviews = array_merge($static_reviews, $db_reviews);
$avg_rating = '5.0';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ирина Казакова — FlowState</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Arial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="TeacherProfile.css">
</head>
<body class="teacher-profile-page">

    <section class="tp-hero">
        <a href="Teachers.php" class="tp-back-btn">&#10094;</a>
        <div class="tp-slider-container" id="hero-slider">
            <div class="tp-slider-track" id="hero-track">
                <img src="img/Ирина.png" alt="Ирина Фото 1" class="tp-hero-img">
                <img src="img/Ирина1.png" alt="Ирина Фото 2" class="tp-hero-img"> 
                <img src="img/Ирина2.png" alt="Ирина Фото 3" class="tp-hero-img">
                <img src="img/Ирина3.png" alt="Ирина Фото 4" class="tp-hero-img">
                <img src="img/Ирина4.png" alt="Ирина Фото 5" class="tp-hero-img">
            </div>
        </div>
        <div class="tp-slider-dots" id="hero-dots">
            <span class="tp-dot active"></span>
            <span class="tp-dot"></span>
            <span class="tp-dot"></span>
            <span class="tp-dot"></span>
            <span class="tp-dot"></span>
        </div>
    </section>

    <section class="tp-header-info">
        <div class="tp-badge">Стаж: 15 лет</div>
        <h1 class="tp-name">Казакова Ирина</h1>
        <p class="tp-subtitle">Преподаватель по "Healthy Spine" / Персональный тренер</p>
        <div class="tp-rating">
            <span class="tp-star">⭐</span> <strong><?= htmlspecialchars($avg_rating) ?></strong>
        </div>
    </section>

    <section class="tp-bio-section">
        <div class="tp-bio-card">
            <p>Привет! Я Ирина Казакова. Мой путь в пилатес начался с собственной травмы спины, которую я смогла вылечить только через умное движение.</p>
            <p>Я убеждена, что здоровая спина — это фундамент молодости всего тела. В своей практике я опираюсь на медицинские знания анатомии и биомеханики. Моя миссия — показать, что жизнь без боли в пояснице и шее возможна, независимо от того, сколько часов вы проводите за компьютером.</p>
            
            <p><strong>Как проходят наши индивидуальные занятия:</strong></p>
            <ul>
                <li><strong>Диагностика осанки:</strong> Начинаем с визуального анализа паттернов шага и статики, чтобы выявить перекосы и гипертонус.</li>
                <li><strong>Изолированная работа:</strong> Мягко «включаем» глубокие мышцы-стабилизаторы позвоночника, которые в обычной жизни часто «спят».</li>
                <li><strong>Декомпрессия:</strong> Завершаем практику вытяжением и снятием осевой нагрузки, чтобы между позвонками появилось пространство.</li>
            </ul>

            <p><strong>Мой манифест:</strong></p>
            <p>«Движение лечит, если оно осознанное. Я не буду требовать от вас олимпийских рекордов. Мы будем работать ювелирно и точечно, возвращая вашему позвоночнику природную гибкость и силу. Боль — это не норма, и мы с ней распрощаемся.»</p>
        </div>
    </section>

    <section class="tp-reviews-wrapper">
        <div class="tp-reviews-container">
            <h2 class="tp-reviews-title">ОТЗЫВЫ</h2>
            <div class="tp-reviews-grid" id="reviews-grid">
                <?php foreach ($all_reviews as $rev): ?>
                    <div class="tp-review-item">
                        <img src="img/<?= htmlspecialchars($rev['avatar'] ?? 'аватарка.png') ?>" alt="Аватар" class="tp-avatar">
                        <div class="tp-review-content">
                            <div class="tp-review-header">
                                <span class="tp-reviewer-name"><?= htmlspecialchars($rev['name'] ?? 'Администратор') ?></span>
                                <span class="tp-review-rating">⭐ <?= htmlspecialchars($rev['rating'] ?? '5.0') ?></span>
                            </div>
                            <div class="tp-review-text">
                                <?= htmlspecialchars($rev['text'] ?? $rev['review_text'] ?? '') ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="tp-review-input-box">
                <div class="tp-stars-wrapper" id="tp-star-rating">
                    <span class="tp-star" data-value="1">★</span>
                    <span class="tp-star" data-value="2">★</span>
                    <span class="tp-star" data-value="3">★</span>
                    <span class="tp-star" data-value="4">★</span>
                    <span class="tp-star" data-value="5">★</span>
                </div>
                <input type="text" id="review-input" placeholder="Написать отзыв... (Нажмите Enter для отправки)" class="tp-input">
                <div id="auth-error-msg" class="tp-error-msg" style="display: none;">
                    Пожалуйста, зарегистрируйтесь или войдите в личный кабинет, чтобы оставить отзыв.
                </div>
            </div>
        </div>
    </section>

    <section class="tp-booking-section">
        <button class="tp-btn-book" id="book-btn" data-teacher="Казакова Ирина" data-class="Healthy Spine" data-time="10:00 - 11:00">Записаться на тренировку</button>
        <div id="booking-error-msg" class="tp-error-msg" style="display: none; justify-content: center; margin-top: 15px;">
            Пожалуйста, зарегистрируйтесь или войдите в личный кабинет для записи на тренировку.
        </div>
    </section>

    <div class="tp-modal-overlay" id="success-modal" style="display: none;">
        <div class="tp-modal-content">
            <h2 class="tp-modal-title">Вы успешно записаны!</h2>
            <p class="tp-modal-text">Ждем вас на тренировке. Вы будете автоматически возвращены к списку преподавателей через <strong id="countdown-timer">3</strong> сек...</p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let isUserLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

            const track = document.getElementById('hero-track');
            const dots = document.querySelectorAll('.tp-dot');
            let currentSlide = 0;
            const totalSlides = dots.length;

            function updateSlider() {
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateSlider();
                });
            });

            let startX = 0;
            track.addEventListener('touchstart', e => startX = e.touches[0].clientX, {passive: true});
            track.addEventListener('touchend', e => {
                let diff = startX - e.changedTouches[0].clientX;
                if (diff > 50 && currentSlide < totalSlides - 1) {
                    currentSlide++; 
                    updateSlider();
                } else if (diff < -50 && currentSlide > 0) {
                    currentSlide--; 
                    updateSlider();
                }
            });

            const reviewInput = document.getElementById('review-input');
            const errorMsg = document.getElementById('auth-error-msg');
            const reviewsGrid = document.getElementById('reviews-grid');
            const tpStars = document.querySelectorAll('.tp-star');
            let tpCurrentRating = 0;

            tpStars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const value = this.getAttribute('data-value');
                    tpStars.forEach(s => {
                        s.style.color = s.getAttribute('data-value') <= value ? '#d4af37' : '#ccc';
                    });
                });

                star.addEventListener('mouseout', function() {
                    tpStars.forEach(s => {
                        s.style.color = s.getAttribute('data-value') <= tpCurrentRating ? '#d4af37' : '#ccc';
                    });
                });

                star.addEventListener('click', function() {
                    tpCurrentRating = this.getAttribute('data-value');
                    tpStars.forEach(s => {
                        s.style.color = s.getAttribute('data-value') <= tpCurrentRating ? '#d4af37' : '#ccc';
                    });
                });
            });

           reviewInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const text = reviewInput.value.trim();
                    if (text === '') return;

                    if (!isUserLoggedIn) {
                        errorMsg.style.display = 'block';
                        return;
                    }

                    if (tpCurrentRating === 0 || tpCurrentRating === "0") {
                        alert("Пожалуйста, поставьте оценку звездами перед отправкой отзыва.");
                        return;
                    }

                    errorMsg.style.display = 'none';

                    const newReview = document.createElement('div');
                    newReview.className = 'tp-review-item';
                    newReview.innerHTML = `
                        <img src="img/аватарка.png" alt="Вы" class="tp-avatar">
                        <div class="tp-review-content">
                            <div class="tp-review-header">
                                <span class="tp-reviewer-name">Вы</span>
                                <span class="tp-review-rating">⭐ ${tpCurrentRating}</span>
                            </div>
                            <div class="tp-review-text">${text}</div>
                        </div>
                    `;

                    reviewsGrid.prepend(newReview);
                    
                    reviewInput.value = ''; 
                    tpCurrentRating = 0;
                    tpStars.forEach(s => s.style.color = '#ccc');
                }
            });


            const bookBtn = document.getElementById('book-btn');
            const bookingErrorMsg = document.getElementById('booking-error-msg');
            const modal = document.getElementById('success-modal');
            const countdownEl = document.getElementById('countdown-timer');

            bookBtn.addEventListener('click', function() {
                if (!isUserLoggedIn) {
                    bookingErrorMsg.style.display = 'flex';
                    return;
                }

                bookingErrorMsg.style.display = 'none';
                
                const teacher = this.getAttribute('data-teacher');
                const course = this.getAttribute('data-class');
                const time = this.getAttribute('data-time');
                const today = new Date().toISOString().slice(0, 10); 

                fetch('book_workout.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `workout_name=${encodeURIComponent(course)}&teacher_name=${encodeURIComponent(teacher)}&workout_date=${encodeURIComponent(today)}&workout_time=${encodeURIComponent(time)}`
                })
                .then(response => {
                    if (response.ok || response.redirected) {
                        modal.style.display = 'flex';
                        let secondsLeft = 3;
                        countdownEl.textContent = secondsLeft;

                        const timerInterval = setInterval(() => {
                            secondsLeft--;
                            countdownEl.textContent = secondsLeft;

                            if (secondsLeft <= 0) {
                                clearInterval(timerInterval);
                                window.location.href = 'Dashboard.php';
                            }
                        }, 1000);
                    } else {
                        alert("Ошибка сервера при записи.");
                    }
                })
                .catch(error => {
                    console.error('Ошибка записи:', error);
                    alert("Произошла ошибка при записи. Попробуйте еще раз.");
                });
            });
        });
    </script>
</body>
</html>