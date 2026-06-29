<?php 
session_start(); 
require_once 'db.php';

// Вытягиваем расписание из базы данных, ИСКЛЮЧАЯ индивидуальные занятия и сортируя строго по ID (по порядку добавления)
$stmt = $pdo->query("SELECT * FROM workouts WHERE workout_name != 'Индивидуальное занятие' ORDER BY id");
$workouts = $stmt->fetchAll();

// Инструкция для дизайна: привязываем картинки, иконки и описания к названию тренировки
$workout_meta = [
    'Morning Flow' => ['type'=>'yoga', 'gender'=>'women', 'img'=>'Morning Flow.png', 'icon'=>'Значок1.png', 'desc'=>'Динамичная утренняя практика для мягкого пробуждения тела, суставной разминки и заряда энергией на весь день.'],
    'Healthy Spine' => ['type'=>'pilates', 'gender'=>'women', 'img'=>'Healthy Spine.png', 'icon'=>'Значок2.png', 'desc'=>'Терапевтический класс пилатеса для улучшения осанки, деликатного вытяжения позвоночника и избавления от болей в пояснице.'],
    'Deep Stretch' => ['type'=>'stretch', 'gender'=>'women', 'img'=>'Deep Stretch.png', 'icon'=>'Значок3.png', 'desc'=>'Классическая плавная растяжка всего тела, направленная на расслабление зажатых мышц, увеличение гибкости и снятие усталости.'],
    'Yin Yoga' => ['type'=>'yoga', 'gender'=>'women', 'img'=>'Yin Yoga.png', 'icon'=>'Значок1.png', 'desc'=>'Глубокая медитативная практика в медленном темпе с длительным удержанием асан для полного расслабления и снятия стресса.'],
    'Pilates Mat' => ['type'=>'pilates', 'gender'=>'women', 'img'=>'Pilates Mat.png', 'icon'=>'Значок2.png', 'desc'=>'Традиционная система упражнений на коврике, направленная на укрепление глубоких мышц «центра силы».'],
    'Split stretching' => ['type'=>'stretch', 'gender'=>'man', 'img'=>'Split Stretch.png', 'icon'=>'Значок3.png', 'desc'=>'Класс с акцентом на мышцы ног и тазобедренные суставы для тех, кто мечтает безопасно сесть на продольный или поперечный шпагат.'],
    'Split Stretch' => ['type'=>'stretch', 'gender'=>'man', 'img'=>'Split Stretch.png', 'icon'=>'Значок3.png', 'desc'=>'Класс с акцентом на мышцы ног и тазобедренные суставы для тех, кто мечтает безопасно сесть на продольный или поперечный шпагат.'],
    'Hatha Yoga' => ['type'=>'yoga', 'gender'=>'women', 'img'=>'Hatha Yoga.png', 'icon'=>'Значок1.png', 'desc'=>'Классическая базовая практика, направленная на освоение правильного дыхания, удержание баланса и укрепление тела.'],
    'Pilates Props' => ['type'=>'pilates', 'gender'=>'man', 'img'=>'Pilates Props.png', 'icon'=>'Значок2.png', 'desc'=>'Тренировка с использованием малого фитнес-оборудования для точечной проработки мышц.'],
    'MFR & Stretch' => ['type'=>'stretch', 'gender'=>'women', 'img'=>'MFR & Stretch.png', 'icon'=>'Значок3.png', 'desc'=>'Эффективная комбинация миофасциального релиза и последующей мягкой растяжки.'],
    'Detox Yoga' => ['type'=>'yoga', 'gender'=>'women', 'img'=>'Detox Yoga.png', 'icon'=>'Значок1.png', 'desc'=>'Комплекс мягких скручиваний и прогибов, стимулирующий пищеварение и обмен веществ.'],
    '3D Pilates' => ['type'=>'pilates', 'gender'=>'women', 'img'=>'3D Pilates.png', 'icon'=>'Значок2.png', 'desc'=>'Функциональная тренировка в трех плоскостях для улучшения координации и мобильности суставов.'],
    'Aero Stretching' => ['type'=>'stretch', 'gender'=>'women', 'img'=>'Aero Stretching.png', 'icon'=>'Значок3.png', 'desc'=>'Мягкая растяжка в специальных подвесных воздушных гамаках, которая позволяет снизить нагрузку на позвоночник и суставы.'],
    'Power Yoga' => ['type'=>'yoga', 'gender'=>'man', 'img'=>'Power Yog.png', 'icon'=>'Значок1.png', 'desc'=>'Интенсивный класс с акцентом на развитие выносливости, силы мышц и сжигание калорий.'],
    'Power Yog' => ['type'=>'yoga', 'gender'=>'man', 'img'=>'Power Yog.png', 'icon'=>'Значок1.png', 'desc'=>'Интенсивный класс с акцентом на развитие выносливости, силы мышц и сжигание калорий.'],
    'Pilates Cardio' => ['type'=>'pilates', 'gender'=>'man', 'img'=>'Pilates Сardio.png', 'icon'=>'Значок2.png', 'desc'=>'Микс пилатеса и легкой кардио-нагрузки для укрепления сердца, сосудов и тонуса всего тела.'],
    'Pilates Сardio' => ['type'=>'pilates', 'gender'=>'man', 'img'=>'Pilates Сardio.png', 'icon'=>'Значок2.png', 'desc'=>'Микс пилатеса и легкой кардио-нагрузки для укрепления сердца, сосудов и тонуса всего тела.'],
    'Functional Stretch' => ['type'=>'stretch', 'gender'=>'women', 'img'=>'Functional Stretch.png', 'icon'=>'Значок3.png', 'desc'=>'Активный комплекс, совмещающий динамические упражнения на силу и одновременное вытяжение мышц для создания красивого рельефа.'],
    'Inside Flow' => ['type'=>'yoga', 'gender'=>'man', 'img'=>'Inside Flow.png', 'icon'=>'Значок1.png', 'desc'=>'Динамичный йога-интенсив, где асаны плавно перетекают одна в другую под ритм музыки.'],
    'Pilates Recovery' => ['type'=>'pilates', 'gender'=>'man', 'img'=>'Pilates Recovery.png', 'icon'=>'Значок2.png', 'desc'=>'Мягкий восстановительный класс, направленный на бережное возвращение тонуса мышцам после травм, перерывов или тяжелых нагрузок.'],
    'Posture Stretch' => ['type'=>'stretch', 'gender'=>'women', 'img'=>'Posture Stretch.png', 'icon'=>'Значок3.png', 'desc'=>'Целевой комплекс упражнений для раскрытия грудного отдела, растяжки плечевого пояса и улучшения гибкости шеи.']
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowState — Йога, пилатес и стретчинг</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="header">
        <div class="logo">
            <a href="index.php"><img src="img/logo.png" alt="FlowState Logo"></a>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php" class="active">Главная</a></li>
                <li><a href="Directions.php">Направления</a></li>
                <li><a href="Teachers.php">Преподаватели</a></li>
                <li><a href="Prices.php">Цены</a></li>
                <li><a href="reviews.php">Отзывы</a></li>
                <li><a href="contacts.php">Контакты</a></li>
                <li>
                    <a href="<?php echo isset($_SESSION['user_id']) ? 'Dashboard.php' : 'Cabinet.php'; ?>">Личный кабинет</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <section class="hero">
            <img src="img/hero-bg.png" alt="Девушка в студии йоги" class="hero-bg-img">
            
            <div class="hero-text-container">
                <h1>Пространство, где твое<br>тело обретает<br>истинную свободу и<br>гибкость.</h1>
                <p class="subtitle">Мягкий подход к вашему телу.<br>Йога, пилатес и стретчинг.</p>
                <button class="btn-schedule" id="scrollToSchedule">Расписание</button>
            </div>
        </section>
    </main>
    
    <section id="schedule-section" class="schedule">
            <div class="schedule-header">
                <h2>Расписание</h2>
                <div class="filters">
                    <select id="filter-type" class="filter-select">
                        <option value="all">Все</option>
                        <option value="yoga">Йога</option>
                        <option value="pilates">Пилатес</option>
                        <option value="stretch">Стретчинг</option>
                    </select>
                    
                    <select id="filter-gender" class="filter-select">
                        <option value="all">Все</option>
                        <option value="women">Женщины</option>
                        <option value="man">Мужчины</option>
                    </select>
                    
                    <input type="date" id="filter-date" class="filter-select date-picker">
                    
                    <select id="filter-time" class="filter-select">
                        <option value="all">Время</option>
                        <option value="8:00-9:00">8:00 - 9:00</option>
                        <option value="9:00-10:00">9:00 - 10:00</option>
                        <option value="9:30-11:00">9:30 - 11:00</option>
                        <option value="10:00-11:00">10:00 - 11:00</option>
                        <option value="11:30-13:00">11:30 - 13:00</option>
                        <option value="12:00-13:30">12:00 - 13:30</option>
                        <option value="13:30-15:00">13:30 - 15:00</option>
                        <option value="14:30-16:00">14:30 - 16:00</option>
                        <option value="15:30-17:00">15:30 - 17:00</option>
                        <option value="16:00-17:30">16:00 - 17:30</option>
                        <option value="17:30-19:30">17:30 - 19:30</option>
                        <option value="18:00-19:30">18:00 - 19:30</option>
                        <option value="20:00-21:30">20:00 - 21:30</option>
                        <option value="20:30-22:00">20:30 - 22:00</option>
                    </select>
                </div>
            </div>

            <div class="cards-grid">
                
                <?php foreach ($workouts as $workout): ?>
                    <?php 
                        $name = trim($workout['workout_name']);
                        // Заглушка, если добавлено новое направление, которого нет в списке
                        $meta = $workout_meta[$name] ?? [
                            'type' => 'yoga', 'gender' => 'all', 'img' => 'default_workout.png', 
                            'icon' => 'Значок1.png', 'desc' => 'Описание появится позже.'
                        ];
                    ?>
                    <div class="card" data-type="<?= htmlspecialchars($meta['type']) ?>" data-time="<?= htmlspecialchars($workout['workout_time']) ?>" data-gender="<?= htmlspecialchars($meta['gender']) ?>">
                        <img src="img/<?= htmlspecialchars($meta['img']) ?>" alt="<?= htmlspecialchars($name) ?>" class="card-img">
                        <div class="card-content">
                            <div class="card-title">
                                <img src="img/<?= htmlspecialchars($meta['icon']) ?>" alt="icon" class="card-icon">
                                <h3><?= htmlspecialchars($name) ?></h3>
                            </div>
                            <p class="card-desc"><?= htmlspecialchars($meta['desc']) ?></p>
                            <p class="card-time"><?= htmlspecialchars($workout['workout_time']) ?></p>
                            <p class="card-teacher">Преподаватель: <?= htmlspecialchars($workout['teacher_name']) ?></p>
                            <button class="btn-book">Записаться</button>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </section>

    <div id="booking-modal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <span class="close-modal" id="close-modal">&times;</span>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 400; margin-bottom: 35px; color: #000000; text-align: left;">Запись на тренировку</h2>
            
            <form id="booking-form">
                <div class="form-group" style="margin-bottom: 25px;">
                    <select id="modal-select-training" class="modal-input select-arrow" style="width: 100%; background-color: #E6E1D6; border: none; border-radius: 12px; padding: 18px 25px; font-size: 18px; color: #333333; outline: none; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'black\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 20px center; background-size: 20px; cursor: pointer;" required>
                        <option value="" disabled selected hidden>Выбрать тренировку...</option>
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom: 25px;">
                    <select id="modal-select-datetime" class="modal-input select-arrow" style="width: 100%; background-color: #E6E1D6; border: none; border-radius: 12px; padding: 18px 25px; font-size: 18px; color: #333333; outline: none; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'black\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 20px center; background-size: 20px; cursor: pointer;" required>
                        <option value="" disabled selected hidden>Ближайшие дата и время:</option>
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom: 25px;">
                    <input type="text" id="modal-input-teacher" class="modal-input" placeholder="Преподаватель:" style="width: 100%; background-color: #E6E1D6; border: none; border-radius: 12px; padding: 18px 25px; font-size: 18px; color: #333333; outline: none; cursor: default;" readonly>
                </div>
                
                <button type="submit" class="btn-submit-booking" style="background-color: #8C9C84; color: #FFFFFF; font-size: 20px; padding: 15px 50px; border: none; border-radius: 30px; cursor: pointer; display: block; margin: 40px auto 0; font-family: 'Arial', sans-serif;">Записаться</button>
            </form>
        </div>
    </div>
        
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            const currentPath = window.location.pathname; 
            const navLinks = document.querySelectorAll('.main-nav a');

            navLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                if (currentPath.includes(linkHref)) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            const scrollBtn = document.getElementById('scrollToSchedule');
            const scheduleSection = document.getElementById('schedule-section');

            if(scrollBtn && scheduleSection) {
                scrollBtn.addEventListener('click', function() {
                    scheduleSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            }

            const filterType = document.getElementById('filter-type');
            const filterGender = document.getElementById('filter-gender');
            const filterTime = document.getElementById('filter-time');
            const cards = document.querySelectorAll('.card');

            function filterCards() {
                const selectedType = filterType.value;
                const selectedGender = filterGender.value;
                const selectedTime = filterTime.value;

                cards.forEach(card => {
                    const cardType = card.getAttribute('data-type') || "";
                    const cardGender = card.getAttribute('data-gender') || "";
                    const cardTime = card.getAttribute('data-time') || "";

                    const typeMatch = (selectedType === 'all' || selectedType === cardType);
                    const genderMatch = (selectedGender === 'all' || selectedGender === cardGender);
                    const timeMatch = (selectedTime === 'all' || selectedTime === cardTime);

                    if (typeMatch && genderMatch && timeMatch) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            if(filterType && filterGender && filterTime) {
                filterType.addEventListener('change', filterCards);
                filterGender.addEventListener('change', filterCards);
                filterTime.addEventListener('change', filterCards);
            }

            let isUserAuthorized = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>; 

            const modal = document.getElementById('booking-modal');
            const closeModal = document.getElementById('close-modal');
            const bookButtons = document.querySelectorAll('.btn-book');
            
            const selectTraining = document.getElementById('modal-select-training');
            const selectDatetime = document.getElementById('modal-select-datetime');
            const inputTeacher = document.getElementById('modal-input-teacher');
            const bookingForm = document.getElementById('booking-form');

            const trainingData = {};
            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.trim();
                const time = card.querySelector('.card-time').textContent.trim();
                let teacher = card.querySelector('.card-teacher').textContent.trim();
                teacher = teacher.replace('Преподаватель:', '').trim(); 

                if(!trainingData[title]) {
                    trainingData[title] = { time: time, teacher: teacher };
                }
            });

            for (let title in trainingData) {
                const option = document.createElement('option');
                option.value = title;
                option.textContent = title;
                selectTraining.appendChild(option);
            }

            function getUpcomingDates(timeStr) {
                const dates = [];
                const today = new Date();
                
                for(let i = 0; i < 3; i++) {
                    const nextDate = new Date(today);
                    nextDate.setDate(today.getDate() + i);
                    
                    const day = String(nextDate.getDate()).padStart(2, '0');
                    const month = String(nextDate.getMonth() + 1).padStart(2, '0');
                    const year = nextDate.getFullYear();
                    
                    let prefix = "";
                    if(i === 0) prefix = "Сегодня, ";
                    if(i === 1) prefix = "Завтра, ";
                    if(i === 2) prefix = "Послезавтра, ";

                    dates.push(`${prefix}${day}.${month}.${year} | ${timeStr}`);
                }
                return dates;
            }

            selectTraining.addEventListener('change', function() {
                const selected = this.value;
                if(trainingData[selected]) {
                    inputTeacher.value = trainingData[selected].teacher;

                    selectDatetime.innerHTML = '<option value="" disabled selected hidden>Ближайшие дата и время:</option>';
                    const dates = getUpcomingDates(trainingData[selected].time);
                    
                    dates.forEach(d => {
                        const opt = document.createElement('option');
                        opt.value = d;
                        opt.textContent = d;
                        selectDatetime.appendChild(opt);
                    });
                }
            });

            bookButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.style.display = 'flex';

                    const card = this.closest('.card');
                    if(card) {
                        const trainingName = card.querySelector('h3').textContent.trim();
                        if(selectTraining.querySelector(`option[value="${trainingName}"]`)) {
                            selectTraining.value = trainingName;
                            selectTraining.dispatchEvent(new Event('change')); 
                        }
                    }
                });
            });

            closeModal.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });

            if(bookingForm) {
                bookingForm.addEventListener('submit', function(e) {
                    e.preventDefault(); 

                    if (!isUserAuthorized) {
                        alert('Для записи на тренировку необходимо зарегистрироваться или войти в Личный кабинет.');
                        window.location.href = 'Login.php'; 
                    } else {
                        const hiddenForm = document.createElement('form');
                        hiddenForm.method = 'POST';
                        hiddenForm.action = 'book_workout.php'; 
                        
                        const fields = {
                            workout_name: selectTraining.value,
                            workout_date: selectDatetime.value.split('|')[0].trim(), 
                            workout_time: selectDatetime.value.split('|')[1].trim(),
                            teacher_name: inputTeacher.value
                        };

                        for (let key in fields) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = key;
                            input.value = fields[key];
                            hiddenForm.appendChild(input);
                        }
                        
                        document.body.appendChild(hiddenForm);
                        hiddenForm.submit(); 
                    }
                });
            }

        });
    </script>
</body>
</html>