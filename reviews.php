<?php
session_start();
require_once 'db.php';

// Вытягиваем общие отзывы студии (где teacher_id = NULL или 0)
$sql = "SELECT r.rating, r.review_text, r.created_at, 
               COALESCE(u.name, 'Клиент') as name, 
               COALESCE(u.surname, 'студии') as surname 
        FROM reviews r 
        LEFT JOIN users u ON r.user_id = u.id 
        WHERE r.teacher_id IS NULL OR r.teacher_id = 0 
        ORDER BY r.created_at DESC";
        
$reviews = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы — FlowState</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Arial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Reviews.css">
</head>
<body>

    <header class="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" alt="FlowState Logo"></a></div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="Directions.php">Направления</a></li>
                <li><a href="Teachers.php">Преподаватели</a></li>
                <li><a href="Prices.php">Цены</a></li>
                <li><a href="reviews.php" class="active">Отзывы</a></li>
                <li><a href="contacts.php">Контакты</a></li>
                <li>
                    <a href="<?php echo isset($_SESSION['user_id']) ? 'Dashboard.php' : 'Cabinet.php'; ?>">Личный кабинет</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="reviews-section">
        <h1 class="reviews-main-title">ЧТО О НАС ГОВОРЯТ НАШИ КЛИЕНТЫ ?</h1>
        <p class="reviews-subtitle">Ваше мнение — главный ориентир для нашей работы. Мы внимательно читаем каждый отзыв, гордимся вашими успехами и оперативно исправляем ошибки, если что-то пошло не так. Спасибо, что помогаете нам становиться лучше!</p>

        <div class="reviews-carousel">
            <button class="nav-btn prev-btn" id="prev-btn">&#10094;</button>
            
            <div class="reviews-track" id="reviews-track">
                <?php foreach ($reviews as $index => $review): ?>
                    <?php
                        $name = trim($review['name']);
                        $surname = trim($review['surname']);

                        // Безопасно берем последнюю букву имени и фамилии (работает с кириллицей)
                        $last_letter_surname = mb_strtolower(mb_substr($surname, -1, 1, 'UTF-8'), 'UTF-8');
                        $last_letter_name = mb_strtolower(mb_substr($name, -1, 1, 'UTF-8'), 'UTF-8');

                        // Автоопределение: если фамилия или имя оканчивается на "а"/"я" — это девушка
                        $is_female = (in_array($last_letter_surname, ['а', 'я']) || in_array($last_letter_name, ['а', 'я']));

                        // Разделяем твои аватарки по гендерному признаку из верстки
                        $female_avas = [1, 4, 6, 7, 10]; // Женские аватарки (Дарья, Наталья, Елена...)
                        $male_avas = [2, 3, 5, 8, 9];    // Мужские аватарки (Алексей, Михаил, Денис...)

                        if ($is_female) {
                            // Выбираем по кругу из женских аватарок
                            $avatarNum = $female_avas[$index % count($female_avas)];
                        } else {
                            // Выбираем по кругу из мужских аватарок
                            $avatarNum = $male_avas[$index % count($male_avas)];
                        }
                        
                        $displayRating = htmlspecialchars($review['rating']);
                    ?>
                    <div class="review-card <?= $index === 0 ? 'active' : 'inactive' ?>">
                        <img src="img/ava<?= $avatarNum ?>.png" alt="Аватар клиента" class="reviewer-ava">
                        <div class="review-info">
                            <h3 class="reviewer-name">
                                <?= htmlspecialchars($name . ' ' . $surname) ?> 
                                <span class="rating">★ <?= $displayRating ?></span>
                            </h3>
                            <p class="review-text"><?= htmlspecialchars($review['review_text']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button class="nav-btn next-btn" id="next-btn">&#10095;</button>
        </div>

        <div class="btn-wrapper">
            <button class="btn-add-review">Хотите оставить отзыв?</button>
        </div>
    
<div id="add-review-modal" class="modal-overlay">
    <div class="modal-content review-modal-content">
        <span class="close-modal" id="close-review-modal">&times;</span>
        <h2 class="review-modal-title">Оставьте ваш отзыв</h2>
        
        <form id="review-form">
            <div class="stars-wrapper">
                <div class="stars-container" id="star-rating">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
            </div>
            
            <div class="textarea-wrapper">
                <textarea id="review-text" class="lined-textarea" placeholder="Написать отзыв..." required></textarea>
            </div>
            
            <button type="submit" class="btn-submit-review">Отправить</button>
        </form>
    </div>
</div>

<div id="review-success-modal" class="modal-overlay">
    <div class="modal-content" style="text-align: center; padding: 70px 50px;">
        <span class="close-modal" id="close-review-success">&times;</span>
        <div style="font-size: 70px; color: #8D977F; margin-bottom: 20px;">✓</div>
        <h2 class="modal-title" style="margin-bottom: 20px;">Спасибо за ваш отзыв!</h2>
        <p style="font-family: 'Arial', sans-serif; font-size: 20px; line-height: 1.5; color: #000000;">
            Ваш отзыв успешно отправлен и скоро появится на сайте.
        </p>
    </div>
</div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.getElementById('reviews-track');
            const cards = Array.from(document.querySelectorAll('.review-card'));
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            
            if(cards.length === 0) return; 

            let currentIndex = 0; 

            function updateCarousel() {
                cards.forEach((card, i) => {
                    card.classList.remove('active', 'inactive');
                    if (i === currentIndex) {
                        card.classList.add('active');
                    } else {
                        card.classList.add('inactive');
                    }
                });

                const cardWidth = cards[0].offsetWidth;
                const gap = 40; 
                const containerWidth = document.querySelector('.reviews-carousel').offsetWidth;
                
                const offset = (containerWidth - cardWidth) / 2;
                const shift = -(currentIndex * (cardWidth + gap)) + offset;

                track.style.transform = `translateX(${shift}px)`;
            }

            nextBtn.addEventListener('click', () => {
                if (currentIndex < cards.length - 1) {
                    currentIndex++;
                    updateCarousel();
                }
            });

            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel();
                }
            });

            updateCarousel();
            window.addEventListener('resize', updateCarousel);
        });
    </script>
    <script>
        const btnAddReview = document.querySelector('.btn-add-review');
        const reviewModal = document.getElementById('add-review-modal');
        const closeReviewModal = document.getElementById('close-review-modal');
        const reviewForm = document.getElementById('review-form');
        
        const reviewSuccessModal = document.getElementById('review-success-modal');
        const closeReviewSuccess = document.getElementById('close-review-success');

        const stars = document.querySelectorAll('.star');
        let currentRating = 0; 

        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const value = this.getAttribute('data-value');
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('hover');
                    } else {
                        s.classList.remove('hover');
                    }
                });
            });

            star.addEventListener('mouseout', function() {
                stars.forEach(s => s.classList.remove('hover'));
            });

            star.addEventListener('click', function() {
                currentRating = this.getAttribute('data-value');
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= currentRating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });

        let isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

        btnAddReview.addEventListener('click', () => {
            if (!isLoggedIn) {
                alert('Для того чтобы оставить отзыв, необходимо зарегистрироваться или войти в Личный кабинет.');
                return;
            }
            reviewModal.style.display = 'flex';
        });

        closeReviewModal.addEventListener('click', () => {
            reviewModal.style.display = 'none';
        });

        reviewForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            if (currentRating === 0) {
                alert("Пожалуйста, поставьте оценку от 1 до 5 звезд.");
                return;
            }

            currentRating = 5;

            reviewModal.style.display = 'none';
            reviewSuccessModal.style.display = 'flex';
            
            document.getElementById('review-text').value = '';
            currentRating = 0;
            stars.forEach(s => s.classList.remove('active'));
        });

        closeReviewSuccess.addEventListener('click', () => {
            reviewSuccessModal.style.display = 'none';
            window.location.reload(); 
        });

        window.addEventListener('click', (e) => {
            if (e.target === reviewModal) reviewModal.style.display = 'none';
            if (e.target === reviewSuccessModal) {
                reviewSuccessModal.style.display = 'none';
                window.location.reload();
            }
        });
    </script>
</body>
</html>