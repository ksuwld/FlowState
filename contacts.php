<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты — FlowState</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Arial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="contacts.css">
</head>
<body>

    <header class="header">
        <div class="logo"><a href="index.html"><img src="img/logo.png" alt="FlowState Logo"></a></div>
        <nav class="main-nav">
             <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="Directions.php">Направления</a></li>
                <li><a href="Teachers.php">Преподаватели</a></li>
                <li><a href="Prices.php">Цены</a></li>
                <li><a href="reviews.php">Отзывы</a></li>
                <li><a href="contacts.php" class="active">Контакты</a></li>
                <li>
                    <a href="<?php echo isset($_SESSION['user_id']) ? 'Dashboard.php' : 'Cabinet.php'; ?>">Личный кабинет</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
<section class="contacts-hero">
    
    <div class="contacts-hero-text">
        <h1>СВЯЖИТЕСЬ С НАМИ ЛЮБЫМ УДОБНЫМ СПОСОБОМ</h1>
        <p>Мы готовы ответить на любые ваши вопросы и помочь вам сделать первый шаг к внутренней гармонии, здоровью тела и спокойствию ума.</p>
    </div>

    <div class="contacts-hero-img">
        <img src="img/контакты.png" alt="Йога">
    </div>

</section>

        <section class="contacts-info-section">
            <div class="contacts-container">
                
                <div class="map-container">
                    <iframe src="https://yandex.ru/map-widget/v1/?text=Москва,+Рочдельская+улица,+15с1&z=16" width="100%" height="100%" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe>
                </div>

                <div class="info-container">
    <h2>Контакты</h2>
    
    <div class="contact-top-row">
        <div class="info-block">
            <span class="info-label">Телефон:</span>
            <a href="tel:+79163427867" class="info-value">+7(916)342-78-67</a>
            <a href="tel:+79257627124" class="info-value">+7(925)762-71-24</a>
        </div>
        
        <div class="info-block">
            <span class="info-label">Почта:</span>
            <a href="mailto:FlowState@gmail.ru" class="info-value">FlowState@gmail.ru</a>
        </div>
        
        <div class="info-block">
    <span class="info-label">Мессенджеры:</span>
    <div class="messengers-icons">
            <a href="https://t.me/@solferino51" target="_blank"><img src="img/tg.png" alt="Telegram"></a>
            
            <a href="https://vk.com/buketnaya_spb" target="_blank"><img src="img/vk.png" alt="VKontakte"></a>
            
            <a href="https://wa.me/+79161234567" target="_blank"><img src="img/whatsapp.png" alt="WhatsApp"></a>
        </div>
</div>
    </div>

    <div class="info-block schedule-block">
        <span class="info-label">Часы работы:</span>
        <span class="info-value">ПН-ПТ: 7:00 - 23:00</span>
        <span class="info-value">СБ-ВС: 8:00 - 23:00</span>
    </div>
    
    <div class="info-block address-block">
        <span class="info-label">Адрес:</span>
        <span class="info-value">Рочдельская ул., 15, стр. 1, Москва</span>
    </div>
</div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-col">
                <h3>Company</h3>
                <ul>
                    <li>About Us</li>
                    <li>Careers</li>
                    <li>Prees</li>
                    <li>News</li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Services</h3>
                <ul>
                    <li>Book a class</li>
                    <li>Memberships</li>
                    <li>Personal traning</li>
                    <li>Gift cards</li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Resources</h3>
                <ul>
                    <li>Blog</li>
                    <li>Schedule</li>
                    <li>Studio rules</li>
                    <li>FAQ</li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Legal</h3>
                <ul>
                    <li>Privacy Policy</li>
                    <li>Terms of Service</li>
                    <li>Cookie Policy</li>
                    <li>Public Offer</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>FlowState<br>2026</p>
        </div>
    </footer>

</body>
</html>