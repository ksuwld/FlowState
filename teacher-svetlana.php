<?php
session_start();
require_once 'db.php'; 

$static_reviews = [
    ['name' => 'Даванков Максим', 'avatar' => 'ava9.png', 'rating' => 5.0, 'text' => 'Практикую йогу уже несколько лет, и занятия Светланы — это высший пилотаж. У неё очень глубокий, классический подход к Хатха йоге. Внимание уделяется не только позам, но и дыханию, и внутренней работе.'],
    ['name' => 'Лукревич Маргарита', 'avatar' => 'ava7.png', 'rating' => 5.0, 'text' => 'Пришла к Светлане совсем новичком. Светлана так мягко и доступно все объясняет, поправляет асаны, следит за каждым движением.'],
    ['name' => 'Кутузова Алина', 'avatar' => 'ava10.png', 'rating' => 5.0, 'text' => 'Светлана невероятно внимательна к ученикам с травмами или ограничениями. На первом же занятии дала мне кучу модификаций асан. Это настоящее исцеление!'],
    ['name' => 'Копорина Ксения', 'avatar' => 'ava11.png', 'rating' => 5.0, 'text' => 'Занятия со Светланой — это мой способ "перезагрузки" после тяжелой рабочей недели. У неё волшебный голос и очень спокойная, уравновешенная энергетика.'],
    ['name' => 'Понамарюк Виктор', 'avatar' => 'ava12.png', 'rating' => 5.0, 'text' => 'Светлана — профессионал, влюбленный в своё дело, и эта любовь передается ученикам. Спасибо!'],
    ['name' => 'Тушковин Сергей', 'avatar' => 'ava13.png', 'rating' => 5.0, 'text' => 'Классическая Хатха йога в самом лучшем исполнении! Все асаны отстраиваются до мелочей, Светлана всегда помогает, если что-то не получается.']
];

try {
    $stmt_id = $pdo->prepare("SELECT id FROM teachers WHERE full_name = 'Ефимова Светлана' LIMIT 1");
    $stmt_id->execute();
    $t_row = $stmt_id->fetch(PDO::FETCH_ASSOC);
    $teacher_id = $t_row ? $t_row['id'] : 6; 

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
    <title>Ефимова Светлана — FlowState</title>
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
                <img src="img/Светлана.png" alt="Светлана Фото 1" class="tp-hero-img">
                <img src="img/Светлана1.png" alt="Светлана Фото 2" class="tp-hero-img"> 
                <img src="img/Светлана2.png" alt="Светлана Фото 3" class="tp-hero-img">
                <img src="img/Светлана3.png" alt="Светлана Фото 4" class="tp-hero-img">
                <img src="img/Светлана4.png" alt="Светлана Фото 5" class="tp-hero-img">
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
        <div class="tp-badge">Стаж: 5 лет</div>
        <h1 class="tp-name">Ефимова Светлана</h1>
        <p class="tp-subtitle">Преподаватель по "Hatha Yoga" / Персональный тренер</p>
        <div class="tp-rating">
            <span class="tp-star">⭐</span> <strong><?= htmlspecialchars($avg_rating) ?></strong>
        </div>
    </section>

    <section class="tp-bio-section">
        <div class="tp-bio-card">
            <p>Намасте! Я Светлана Ефимова. Я приверженец классической Хатха-йоги — древней и проверенной временем системы.</p>
            <p>В мире трендов я сохраняю верность традиции. На моих занятиях нет спешки. Мы детально отстраиваем каждую асану, от кончиков пальцев ног до макушки, добиваясь идеальной геометрии тела. Это фундамент, без которого невозможна дальнейшая практика.</p>
            
            <p><strong>Как проходят наши индивидуальные занятия:</strong></p>
            <ul>
                <li><strong>Статическая отстройка:</strong> Детально разбираем биомеханику каждой позы, используя блоки и ремни для правильного вектора.</li>
                <li><strong>Пранаяма:</strong> Осваиваем классические техники дыхания (Уджайи, Нади Шодхана) для успокоения ума.</li>
                <li><strong>Шавасана:</strong> Глубокое расслабление в конце практики под мой голос (Йога-нидра).</li>
            </ul>

            <p><strong>Мой манифест:</strong></p>
            <p>В классике скрыта невероятная глубина. Хатха-йога учит нас дисциплине, терпению и честности с самим собой. Построив крепкий фундамент на коврике, вы обретете нерушимую внутреннюю опору в жизни.</p>
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
        <button class="tp-btn-book" id="book-btn" data-teacher="Ефимова Светлана" data-class="Hatha Yoga" data-time="12:00 - 13:30">Записаться на тренировку</button>
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