<?php 
session_start(); 
require_once 'db.php';

// Делаем запрос к таблице тарифов
$stmt = $pdo->query("SELECT * FROM tariffs");
$tariffs = $stmt->fetchAll();

// Инструкция для дизайна: какие пункты выводить для каждого тарифа
$tariff_features = [
    'Старт' => [
        '✓ Безлимитный доступ в студию', '✓ Одноразовая бесплатная персональная тренировка', '✓ СПА-зона', '✓ Экскурсия по студии', '✖ Гостевой доступ для друзей и семьи', '✖ Онлайн тренировки', '✖ Посещение других филиалов сети'
    ],
    'Дыхание' => [
        '✓ Безлимитный доступ в студию', '✓ Одноразовая бесплатная персональная тренировка', '✓ СПА-зона', '✓ Экскурсия по студии', '✓ Заморозка абонемента', '✓ Гостевой доступ (до 3 человек в месяц)', '✖ Онлайн тренировки', '✖ Посещение других филиалов сети'
    ],
    'PRO' => [
        '✓ Безлимитный доступ в студию', '✓ Одноразовая бесплатная персональная тренировка', '✓ СПА-зона', '✓ Экскурсия по студии', '✓ Заморозка абонемента', '✓ Гостевой доступ (до 3 человек в месяц)', '✓ Посещение других филиалов сети', '✓ Онлайн-тренировки'
    ]
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Цены — FlowState</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Arial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Prices.css">
</head>
<body>

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
                <li><a href="Teachers.php">Преподаватели</a></li>
                <li><a href="Prices.php" class="active" >Цены</a></li>
                <li><a href="reviews.php">Отзывы</a></li>
                <li><a href="contacts.php">Контакты</a></li>
                <li>
                    <a href="<?php echo isset($_SESSION['user_id']) ? 'Dashboard.php' : 'Cabinet.php'; ?>">Личный кабинет</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="pricing-section">
        <h1 class="pricing-title">ЦЕНЫ</h1>

        <div class="pricing-grid">
    <?php foreach ($tariffs as $tariff): ?>
        <?php 
            $title = trim($tariff['title']);
            $features = $tariff_features[$title] ?? ['✓ Базовый доступ']; // Если тарифа нет в списке, выведет это
        ?>
        <div class="price-card">
            <div class="card-top-row">
                <h2 class="card-title"><?= htmlspecialchars($title) ?></h2>
                <span class="card-price"><?= htmlspecialchars($tariff['price']) ?> ₽/мес.</span>
            </div>
            <ul class="features-list">
                <?php foreach ($features as $feature): ?>
                    <li><?= htmlspecialchars($feature) ?></li>
                <?php endforeach; ?>
            </ul>
            <button class="btn-buy">Купить</button>
        </div>
    <?php endforeach; ?>
</div>

        <div class="price-card-wide">
            <div class="card-top-row">
                <h2 class="card-title">Индивидуальное занятие</h2>
                <span class="card-price">от 2000₽ (в зависимости от выбора тренера)</span>
            </div>
            <div class="wide-content">
                <ul class="features-list">
                    <li>✓ Персональная тренировка «1 на 1» с любым выбранным топ-тренером.</li>
                    <li>✓ Индивидуальный разбор вашей биомеханики, осанки и целей.</li>
                    <li>✓ Разработка персональной программы (Йога, Пилатес или Стретчинг).</li>
                    <li>✓ Полный контроль техники выполнения и адаптация нагрузки в реальном времени.</li>
                    <li>✓ Доступ в СПА-зону и раздевалки после окончания тренировки.</li>
                    <br>
                    <li>✖ Онлайн-формат (занятие проходит строго очно в студии).</li>
                    <li>✖ Перенос или отмена занятия менее чем за 3 часа (тренировка будет списана).</li>
                </ul>
                <div class="wide-controls">
                    <select id="trainer-select" class="control-select">
                        <option value="" disabled selected hidden>Выбрать тренера</option>
                        <option value="1">Анисимова Анна</option>
                        <option value="2">Казакова Ирина</option>
                        <option value="3">Арбамова Елена</option>
                        <option value="4">Лапина Мария</option>
                        <option value="5">Голубева Таисия</option>
                        <option value="6">Авдеев Денис</option>
                        <option value="7">Ефимова Светлана</option>
                        <option value="8">Кудрявцева Анна</option>
                        <option value="9">Михеева Мария</option>
                        <option value="10">Мухин Михаил</option>
                        <option value="11">Журавлёв Алексей</option>
                        <option value="12">Чернышова Алиса</option>
                        <option value="13">Сидоров Сергей</option>
                        <option value="14">Буниатян Алиса</option>
                        <option value="15">Волков Владислав</option>
                        <option value="16">Смирнов Андрей</option>
                        <option value="17">Капорина Татьяна</option>
                    </select>
                    <select id="datetime-select" class="control-select">
                        <option value="" disabled selected hidden>Дата и время</option>
                        <option value="today">Сегодня 9:00 - 10:00</option>
                        <option value="today1">Сегодня 10:00 - 11:00</option>
                        <option value="today2">Сегодня 11:00 - 12:00</option>
                        <option value="today3">Сегодня 12:00 - 13:00</option>
                        <option value="today4">Сегодня 13:00 - 14:00</option>
                        <option value="today5">Сегодня 14:00 - 15:00</option>
                        <option value="today6">Сегодня 15:00 - 16:00</option>
                        <option value="today7">Сегодня 16:00 - 17:00</option>
                        <option value="today8">Сегодня 17:00 - 18:00</option>
                        <option value="today9">Сегодня 18:00 - 19:00</option>
                        <option value="today10">Сегодня 19:00 - 20:00</option>
                        <option value="today11">Сегодня 20:00 - 21:00</option>
                        <option value="today12">Сегодня 21:00 - 22:00</option>
                        <option value="tomorrow">Завтра 9:00 - 10:00</option>
                        <option value="tomorrow1">Завтра 10:00 - 11:00</option>
                        <option value="tomorrow2">Завтра 11:00 - 12:00</option>
                        <option value="tomorrow3">Завтра 12:00 - 13:00</option>
                        <option value="tomorrow4">Завтра 13:00 - 14:00</option>
                        <option value="tomorrow5">Завтра 14:00 - 15:00</option>
                        <option value="tomorrow6">Завтра 15:00 - 16:00</option>
                        <option value="tomorrow7">Завтра 16:00 - 17:00</option>
                        <option value="tomorrow8">Завтра 17:00 - 18:00</option>
                        <option value="tomorrow9">Завтра 18:00 - 19:00</option>
                        <option value="tomorrow10">Завтра 19:00 - 20:00</option>
                        <option value="tomorrow11">Завтра 20:00 - 21:00</option>
                        <option value="tomorrow12">Завтра 21:00 - 22:00</option>
                    </select>

                    <div id="booking-error" style="color: #a84242; font-size: 14px; text-align: center; display: none;">
                        Пожалуйста, выберите тренера и время.
                    </div>

                    <button id="enroll-btn" class="btn-enroll">Записаться</button>
                </div>
            </div>
        </div>

        <div id="buy-modal" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <span class="close-modal" id="close-buy-modal">&times;</span>
                <h2 class="modal-title">Покупка абонемента</h2>
                
                <form id="purchase-form">
                    <div class="form-group">
                        <select id="tariff-select" class="modal-select" required>
                            <option value="" disabled selected hidden>Выбрать тариф</option>
                            <option value="start">Старт</option>
                            <option value="breath">Дыхание</option>
                            <option value="pro">PRO</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <select id="price-select" class="modal-select" disabled>
                            <option value="" disabled selected hidden>Стоимость:</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn-pay">Оплатить</button>
                </form>
            </div>
        </div>

        <div id="success-modal" class="modal-overlay" style="display: none;">
            <div class="modal-content" style="text-align: center; padding: 70px 50px;">
                <span class="close-modal" id="close-success-modal">&times;</span>
                <div style="font-size: 70px; color: #8D977F; margin-bottom: 20px;">✓</div>
                <h2 class="modal-title" style="margin-bottom: 20px;">Оплата прошла успешно!</h2>
                <p style="font-family: 'Arial', sans-serif; font-size: 20px; line-height: 1.5; color: #000000;">
                    Ваш абонемент активирован.<br>Вы будете перенаправлены в Личный кабинет...
                </p>
            </div>
        </div>

        <div id="booking-success-modal" class="modal-overlay" style="display: none;">
            <div class="modal-content" style="text-align: center; padding: 70px 50px;">
                <span class="close-modal" id="close-booking-success">&times;</span>
                <div style="font-size: 70px; color: #8D977F; margin-bottom: 20px;">✓</div>
                <h2 class="modal-title" style="margin-bottom: 20px;">Вы успешно записаны!</h2>
                <p style="font-family: 'Arial', sans-serif; font-size: 20px; line-height: 1.5; color: #000000;">
                    Тренировка добавлена в вашу базу.<br>Вы будете перенаправлены в Личный кабинет...
                </p>
            </div>
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        let isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>; 

        const modal = document.getElementById('buy-modal');
        const closeBtn = document.getElementById('close-buy-modal');
        const buyButtons = document.querySelectorAll('.btn-buy');
        const tariffSelect = document.getElementById('tariff-select');
        const priceSelect = document.getElementById('price-select');
        const purchaseForm = document.getElementById('purchase-form');
        const successModal = document.getElementById('success-modal');
        const closeSuccessBtn = document.getElementById('close-success-modal');

        const enrollBtn = document.getElementById('enroll-btn');
        const trainerSelect = document.getElementById('trainer-select');
        const datetimeSelect = document.getElementById('datetime-select');
        const bookingError = document.getElementById('booking-error');
        const bookingSuccessModal = document.getElementById('booking-success-modal');
        const closeBookingSuccess = document.getElementById('close-booking-success');

        const prices = {
            'start': '3 500 ₽/мес.',
            'breath': '5 000 ₽/мес.',
            'pro': '7 900 ₽/мес.'
        };

        tariffSelect.addEventListener('change', function() {
            const selectedTariff = this.value;
            if (prices[selectedTariff]) {
                priceSelect.innerHTML = `<option value="${selectedTariff}" selected>${prices[selectedTariff]}</option>`;
            }
        });

        function checkAuth() {
            if (!isLoggedIn) {
                alert('Для совершения покупки или записи на тренировку необходимо войти в Личный кабинет.');
                window.location.href = 'Login.php'; 
                return false;
            }
            return true;
        }

        buyButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (!checkAuth()) return;

                modal.style.display = 'flex';
                const card = this.closest('.price-card');
                if (card) {
                    const title = card.querySelector('.card-title').textContent.trim();
                    if (title === 'Старт') tariffSelect.value = 'start';
                    else if (title === 'Дыхание') tariffSelect.value = 'breath';
                    else if (title === 'PRO') tariffSelect.value = 'pro';
                    
                    tariffSelect.dispatchEvent(new Event('change'));
                }
            });
        });

        purchaseForm.addEventListener('submit', (e) => { 
            e.preventDefault(); 
            const tariffName = tariffSelect.options[tariffSelect.selectedIndex].text;

            fetch('update_tariff.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `tariff=${encodeURIComponent(tariffName)}`
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при обновлении базы данных');
            }
            return response.text();
        })
        .then(data => {
            // Показываем окно успеха только если PHP ответил без ошибок
            modal.style.display = 'none'; 
            successModal.style.display = 'flex';
            setTimeout(() => { window.location.href = 'Dashboard.php'; }, 3000);
        })
        .catch(error => {
            alert("Произошла ошибка! Проверь, создана ли колонка tariff_name в БД.");
            console.error(error);
        });
        });

        enrollBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (!checkAuth()) return;
            
            const trainerName = trainerSelect.options[trainerSelect.selectedIndex].text;
            const datetimeText = datetimeSelect.options[datetimeSelect.selectedIndex].text;
            
            if (!trainerSelect.value || !datetimeSelect.value) {
                bookingError.style.display = 'block';
                return;
            }

            fetch('quick_book.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `teacher_name=${encodeURIComponent(trainerName)}&class_name=Индивидуальное занятие&time=${encodeURIComponent(datetimeText)}`
            })
            .then(() => {
                bookingSuccessModal.style.display = 'flex';
                setTimeout(() => { window.location.href = 'Dashboard.php'; }, 3000);
            });
        });

        [closeBtn, closeSuccessBtn, closeBookingSuccess].forEach(btn => {
            btn.addEventListener('click', () => {
                modal.style.display = 'none';
                successModal.style.display = 'none';
                bookingSuccessModal.style.display = 'none';
            });
        });
    });
    </script>
</body>
</html>