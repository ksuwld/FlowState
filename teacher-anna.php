<?php
session_start();
require_once 'db.php'; 

$static_reviews = [
    ['name' => 'Соколова Дарья', 'avatar' => 'ava1.png', 'rating' => 5.0, 'text' => 'Долго искала тренера по пилатесу, с которым не будет скучно. Анна — просто находка! Очень подробно объясняет биомеханику каждого движения, следит за каждым вдохом. Спустя месяц персональных занятий спина сказала огромное спасибо, утренняя скованность полностью прошла.'],
    ['name' => 'Орлов Константин', 'avatar' => 'ava2.png', 'rating' => 5.0, 'text' => 'Пришел к Анне на реабилитацию после спортивной травмы колена. Прорабатывали суставы в 3D плоскостях, как раз то, что нужно для восстановления. Нагрузку дозирует идеально, прогресс чувствую после каждой тренировки. Настоящий профессионал.'],
    ['name' => 'Одинцов Владислав', 'avatar' => 'ava3.png', 'rating' => 5.0, 'text' => 'Отличный специалист. Гоняет на Pilates Cardio на совесть, спуску не дает. Результат в зеркале вижу, выносливость выросла. Единственный нюанс — Анна очень строго следит за техникой и таймингом, иногда хочется чуть больше пауз для отдыха во время интенсивных связок, но тренер непреклонна.'],
    ['name' => 'Ковалюк Ольга', 'avatar' => 'ava4.png', 'rating' => 5.0, 'text' => 'Сами тренировки у Анны великолепные, индивидуальный комплекс под мою осанку подобрали идеальный. Записываться нужно заранее, но это того стоит — все слоты забиты на две недели вперед. Приходится подстраивать свой рабочий график, но результат потрясающий!'],
    ['name' => 'Кошкина София', 'avatar' => 'ava5.png', 'rating' => 5.0, 'text' => 'Была на вводном персональном занятии по йоге и сразу же взяла блок тренировок. Анна невероятно бережно относится к возможностям тела, с ней не страшно пробовать новые асаны. Настоящий мастер своего дела, который влюбляет в практику с первой секунды!'],
    ['name' => 'Шестакова Мария', 'avatar' => 'ava6.png', 'rating' => 5.0, 'text' => 'Для меня Анна стала идеальным наставником. Мне очень важен индивидуальный, системный подход и четкая анатомическая отстройка положений, без лишней воды. Если вам нужен максимальный контроль над техникой и реальный результат — однозначно рекомендую.'],
    ['name' => 'Белоусова Татьяна', 'avatar' => 'ava7.png', 'rating' => 5.0, 'text' => 'Самый душевный и профессиональный тренер, у которого я была. Анна подобрала персональный комплекс под мои цели, совместила мягкую йогу и МФР. Каждая минута тренировки отработана на 100%. Да, к ней сложно записаться из-за плотного графика, но это лишь подтверждает ее уровень!']
];

try {
    $stmt_id = $pdo->prepare("SELECT id FROM teachers WHERE full_name = 'Анисимова Анна' LIMIT 1");
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
    <title>Анна Анисимова — FlowState</title>
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
                <img src="img/Anisimova anna - trener.png" alt="Анна Фото 1" class="tp-hero-img">
                <img src="img/Anisimova anna - trener-certificat6.png" alt="Анна Фото 2" class="tp-hero-img"> 
                <img src="img/Anisimova anna - trener-certificat10.png" alt="Анна Фото 3" class="tp-hero-img">
                <img src="img/Anisimova anna - trener-certificat2.png" alt="Анна Фото 4" class="tp-hero-img">
                <img src="img/Anisimova anna - trener-certificat3.png" alt="Анна Фото 5" class="tp-hero-img">
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
        <div class="tp-badge">Стаж: 10 лет</div>
        <h1 class="tp-name">Анисимова Анна</h1>
        <p class="tp-subtitle">Преподаватель по "Morning Flow" / Персональный тренер</p>
        <div class="tp-rating">
            <span class="tp-star">⭐</span> <strong><?= htmlspecialchars($avg_rating) ?></strong>
        </div>
    </section>

    <section class="tp-bio-section">
        <div class="tp-bio-card">
            <p>Привет! Меня зовут Анна Анисимова, и я верю, что йога и осознанное движение — это не про сложные трюки ради красивой картинки, а про глубокое возвращение к себе, к своему комфорту и здоровью.</p>
            <p>В практику я пришла более 8 лет назад. Личный опыт и работа со своим телом помогли мне понять главное: шаблонные комплексы из групповых программ подходят далеко не всем. Именно поэтому я ушла в персональный тренинг, где во главу угла могу поставить именно ваши цели, особенности анатомии и текущее самочувствие.</p>
            
            <p><strong>Как проходят наши индивидуальные занятия:</strong></p>
            <ul>
                <li><strong>Индивидуальный чек-ап:</strong> Каждую совместную работу мы начинаем с мягкого тестирования — смотрим на осанку, подвижность суставов, выявляем мышечные зажимы и триггерные точки.</li>
                <li><strong>Синтез методик:</strong> В своих занятиях я не ограничиваюсь одной классической хатха-йогой. Я бережно совмещаю плавные асаны (Flow Yoga) с современными принципами биомеханики, элементами 3D-пилатеса и техниками миофасциального релиза (МФР).</li>
                <li><strong>Адаптивность нагрузки:</strong> Если сегодня вы полны сил — мы сделаем упор на укрепление кора, балансы и развитие выносливости. Если вы пришли после тяжелого рабочего дня без энергии — практика трансформируется в мягкое терапевтическое восстановление, декомпрессию позвоночника и глубокий ментальный релакс.</li>
            </ul>

            <p><strong>Мой манифест:</strong></p>
            <p>«На моих тренировках вы не услышите фраз "терпи через силу" или "делай как я". Мы будем двигаться в ритме вашего дыхания, учиться заново чувствовать каждую мышцу и бережно расширять возможности вашего тела. Моя цель — чтобы после нашей встречи вы уходили с ощущением невероятной легкости, ясности в голове и с прямой, королевской осанкой.»</p>
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
        <button class="tp-btn-book" id="book-btn" data-teacher="Анисимова Анна" data-class="Morning Flow" data-time="8:00 - 9:00">Записаться на тренировку</button>
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