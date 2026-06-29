<?php
session_start();
require_once 'db.php'; 

$static_reviews = [
    ['name' => 'Иголкин Игорь', 'avatar' => 'ava2.png', 'rating' => 5.0, 'text' => 'Пришел по рекомендации знакомых. Тренировки спокойные, но мышцы горят. Ощущения просто невероятные! Алиса, вы мне помогли почувствовать себя в невесомости.'],
    ['name' => 'Котырин Семён', 'avatar' => 'ava3.png', 'rating' => 5.0, 'text' => 'Я полностью согласен с Игорем! Жена позвала вместе сходить на тренировку к Алисе. Теперь ходим чуть ли не каждый вечер вдвоем.'],
    ['name' => 'Даванков Максим', 'avatar' => 'ava9.png', 'rating' => 5.0, 'text' => 'Иногда хочется почувствовать себя парящим в воздухе как птица и забыть о собственных проблемах и забот. Алиса, вы мне помогли почувствовать все это! Спасибо вам'],
    ['name' => 'Воркович Полина', 'avatar' => 'ava5.png', 'rating' => 5.0, 'text' => 'Гамаки с Алисой — это любовь! Перевернутые позы спасают мою спину. Алиса очень надежно страхует.'],
    ['name' => 'Суворов Евгений', 'avatar' => 'ava8.png', 'rating' => 5.0, 'text' => 'Очень боюсь высоты. Как только не чувствую землю под ногами, так сразу начинается паника. Но с Алисой и ее поддержкой я переборол этот страх!'],
    ['name' => 'Лукревич Маргарита', 'avatar' => 'ava7.png', 'rating' => 5.0, 'text' => 'Также как и Евгений раньше боялась высоты, но Алиса внушает такое спокойствие. Растяжка в воздухе идет намного легче.'],
    ['name' => 'Кутузова Алина', 'avatar' => 'ava10.png', 'rating' => 5.0, 'text' => 'Это похоже на магию! В гамаке я сажусь в шпагат почти без усилий. Алиса прекрасный тренер.'],
    ['name' => 'Копорина Ксения', 'avatar' => 'ava11.png', 'rating' => 5.0, 'text' => 'Это не передать словами! Каждый хотя бы раз в жизни должен попробовать Aero Stretching!'],
    ['name' => 'Понамарюк Виктор', 'avatar' => 'ava12.png', 'rating' => 5.0, 'text' => 'Сначала думал записываться или нет, так как у меня нет никакой растяжки и как выяснилось ни одного страха высоты в таком возрасте. Но решил попробовать и просто влюбился в это направление Стретча! Алиса, спасибо вам за такие прекрасные тренировки!'],
    ['name' => 'Тушковин Сергей', 'avatar' => 'ava13.png', 'rating' => 5.0, 'text' => 'Алиса вы невероятная! Спасибо за такие прекрасные занятия!']
];

try {
    $stmt_id = $pdo->prepare("SELECT id FROM teachers WHERE full_name = 'Чернышова Алиса' LIMIT 1");
    $stmt_id->execute();
    $t_row = $stmt_id->fetch(PDO::FETCH_ASSOC);
    $teacher_id = $t_row ? $t_row['id'] : 4; 

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
    <title>Чернышова Алиса — FlowState</title>
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
                <img src="img/алиса.png" alt="Алиса Фото 1" class="tp-hero-img">
                <img src="img/алиса1.png" alt="Алиса Фото 2" class="tp-hero-img"> 
                <img src="img/алиса3.png" alt="Алиса Фото 3" class="tp-hero-img">
                <img src="img/алиса4.png" alt="Алиса Фото 4" class="tp-hero-img">
                <img src="img/алисаw2png.png" alt="Алиса Фото 5" class="tp-hero-img">
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
        <div class="tp-badge">Стаж: 9 лет</div>
        <h1 class="tp-name">Чернышова Алиса</h1>
        <p class="tp-subtitle">Преподаватель по "Aero Stretching" / Персональный тренер</p>
        <div class="tp-rating">
            <span class="tp-star">⭐</span> <strong><?= htmlspecialchars($avg_rating) ?></strong>
        </div>
    </section>

    <section class="tp-bio-section">
        <div class="tp-bio-card">
            <p>Привет! Я Алиса, и я научу вас летать! Aero Stretching (растяжка в гамаках) — это не просто красиво, это невероятно полезно.</p>
            <p>Гамак забирает на себя часть веса вашего тела, позволяя мягко вытянуть позвоночник без осевой нагрузки. Я обожаю наблюдать, как мои ученики преодолевают страх перевернутых поз и находят в гамаке чувство абсолютной невесомости и детской радости.</p>
            
            <p><strong>Как проходят наши индивидуальные занятия:</strong></p>
            <ul>
                <li><strong>Адаптация:</strong> Начинаем с привыкания к гамаку, поиска баланса и доверия к оборудованию.</li>
                <li><strong>Декомпрессионные перевороты:</strong> Выполняем безопасные висы вниз головой — лучшее средство от компрессии межпозвоночных дисков.</li>
                <li><strong>Вытяжение в воздухе:</strong> Тянем шпагаты и спину с поддержкой ткани, что позволяет расслабиться глубже, чем на полу.</li>
            </ul>

            <p><strong>Мой манифест:</strong></p>
            <p>«Отпустите контроль и доверьтесь гамаку. Я покажу вам, как гравитация может стать вашим лучшим другом, а не врагом. Вытяжение в воздухе подарит вам свободу, о которой на земле можно только мечтать.»</p>
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
        <button class="tp-btn-book" id="book-btn" data-teacher="Чернышова Алиса" data-class="Aero Stretching" data-time="15:30 - 17:00">Записаться на тренировку</button>
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