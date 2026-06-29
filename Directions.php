<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Направления — FlowState</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Arial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Directions.css">
</head>
<body class="page-directions-fix"> 
    
    <header class="header">
        <div class="logo">
            <a href="index.html">
                <img src="img/logo.png" alt="FlowState Logo">
            </a>
        </div>
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

    <main class="main-content-dirs">
        <section class="coverslide-section">
            <p class="coverslide-subtitle">
                Мы объединили лучшие направления йоги, пилатеса и стретчинга в одном пространстве. Каждое из них — это уникальный путь к сильному телу, здоровой осанке и внутреннему спокойствию. Изучите наши программы и найдите свой идеальный баланс
            </p>

            <div class="carousel-container" id="dirs-carousel-container">
                <div class="carousel-track" id="dirs-carousel-track">
                    
                    <div class="direction-card-box inactive-left">
                        <img src="img/Directions-Morning Flow.png" alt="Morning Flow" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок1.png" alt="icon"></div>
                            <h3 class="dir-card-title">Morning Flow</h3>
                            <p class="dir-card-desc">Тренировка проходит в непрерывном движении. Вы последовательно переходите из одной асаны в другую, синхронизируя каждый шаг с глубоким вдохом и выдохом. Занятие начинается с мягкой суставной разминки и постепенно перерастает в динамичный комплекс.</p>
                        </div>
                    </div>
                    
                    <div class="direction-card-box active">
                        <img src="img/Directions-Hatha Yoga.png" alt="Hatha Yoga" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок1.png" alt="icon"></div>
                            <h3 class="dir-card-title">Hatha Yoga</h3>
                            <p class="dir-card-desc">Классическая практика, состоящая из статической фиксации асан. Вы поочередно принимаете позы на силу, гибкость и баланс, задерживаясь в них на несколько дыхательных циклов под контролем правильной отстройки тела.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Yin Yoga.png" alt="Yin Yoga" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок1.png" alt="icon"></div>
                            <h3 class="dir-card-title">Yin Yoga</h3>
                            <p class="dir-card-desc">Предельно медленный класс, где полностью отсутствует динамика. Вы принимаете пассивные позы на коврике (сидя или лежа), обкладывая тело мягкими валиками и блоками, и остаетесь в полной неподвижности в каждой асане от 3 до 5 минут.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Healthy Spine.png" alt="Healthy Spine" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок2.png" alt="icon"></div>
                            <h3 class="dir-card-title">Healthy Spine</h3>
                            <p class="dir-card-desc">Специализированный терапевтический класс. Вы выполняете мягкие скручивания, вытяжения и бережные упражнения на мобилизацию грудного отдела, крестца и шеи, восстанавливая естественную подвижность каждого позвонка.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Deep Stretch.png" alt="Deep Stretch" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок3.png" alt="icon"></div>
                            <h3 class="dir-card-title">Deep Stretch</h3>
                            <p class="dir-card-desc">Интенсивный класс, направленный на глубокое и долгое вытяжение мышечных волокон и фасций. Вы медленно и плавно задерживаетесь в анатомических положениях дольше обычного, постепенно увеличивая амплитуду под весом собственного тела.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Pilates Mat.png" alt="Pilates Mat" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок2.png" alt="icon"></div>
                            <h3 class="dir-card-title">Pilates Mat</h3>
                            <p class="dir-card-desc">Вы выполняете серию упражнений на коврике, используя только вес собственного тела или малое оборудование (изотонические кольца, резиновые ленты, легкие гантели и мячи). Движения происходят плавно, в спокойном темпе, с полным контролем дыхания и центра корпуса.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Split Stretching.png" alt="Split Stretching" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок3.png" alt="icon"></div>
                            <h3 class="dir-card-title">Split Stretching</h3>
                            <p class="dir-card-desc">Целевой класс, где все упражнения подобраны для безопасного освоения продольного и поперечного шпагатов. Тренировка включает в себя обязательный разогрев и специальную пошаговую растяжку.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Pilates Props.png" alt="Pilates Props" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок2.png" alt="icon"></div>
                            <h3 class="dir-card-title">Pilates Props</h3>
                            <p class="dir-card-desc">Вы тренируетесь на коврике, но каждое движение усложняется или корректируется с помощью специальных фитнес-ассистентов: изотонических колец, роллов для МФР, балансировочных подушек, тяжелых мячей и эластичных лент. Это добавляет тренировке разнообразия и не дает мышцам привыкнуть к нагрузке.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-MFR&Stretch.png" alt="MFR & Stretch" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок3.png" alt="icon"></div>
                            <h3 class="dir-card-title">MFR & Stretch</h3>
                            <p class="dir-card-desc">Программа разделена на две части: сначала вы делаете самомассаж специальными роллами и теннисными мячами (миофасциальный релиз), чтобы расслабить жесткие участки, а затем переходите к мягкой растяжке.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Detox Yoga.png" alt="Detox Yoga" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок1.png" alt="icon"></div>
                            <h3 class="dir-card-title">Detox Yoga</h3>
                            <p class="dir-card-desc">Практика построена на выполнении каскада безопасных скручиваний корпуса, глубоких наклонов вперед и мягких перевернутых положений тела, которые удерживаются в комфортном статичном режиме.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-3D Pilates.png" alt="3D Pilates" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок2.png" alt="icon"></div>
                            <h3 class="dir-card-title">3D Pilates</h3>
                            <p class="dir-card-desc">Тренировка строится на основе современной биомеханики. Вы выполняете упражнения сразу в трех анатомических плоскостях (3D), включая сложные спиральные вращения, скручивания и диагональные выпады. Часто в процессе используются легкие веса или эластичные ленты для создания 3D-сопротивления.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Aero Stretching.png" alt="Aero Stretching" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок3.png" alt="icon"></div>
                            <h3 class="dir-card-title">Aero Stretching</h3>
                            <p class="dir-card-desc">Тренировка проходит в воздухе с использованием специальных прочных шелковых гамаков. Ткань бережно поддерживает тело, позволяя выполнять вытяжения в подвешенном состоянии и мягко переворачиваться вниз головой.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Power Yoga.png" alt="Power Yoga" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок1.png" alt="icon"></div>
                            <h3 class="dir-card-title">Power Yoga</h3>
                            <p class="dir-card-desc">Интенсивный силовой класс с высоким темпом. Вы выполняете сложные динамические связки, подолгу удерживаете силовые статические позы (различные вариации планок, стоек и упоров) и практически не отдыхаете между подходами.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Pilates Cardio.png" alt="Pilates Cardio" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок2.png" alt="icon"></div>
                            <h3 class="dir-card-title">Pilates Cardio</h3>
                            <p class="dir-card-desc">Самый жиросжигающий и динамичный класс в линейке. Здесь мягкие и точные движения из пилатеса соединяются с непрерывным аэробным темпом. Вы выполняете функциональные связки, пульсирующие упражнения и элементы легкого плиометрического (прыжкового) тренинга в безопасной для суставов амплитуде, удерживая дыхательный ритм без пауз.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Functional Stretch.png" alt="Functional Stretch" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок3.png" alt="icon"></div>
                            <h3 class="dir-card-title">Functional Stretch</h3>
                            <p class="dir-card-desc">Динамичный класс, где упражнения на растяжку чередуются с мягкими силовыми движениями на баланс и координацию. Вы двигаетесь активно, постоянно меняя положения тела.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Inside Flow.png" alt="Inside Flow" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок1.png" alt="icon"></div>
                            <h3 class="dir-card-title">Inside Flow</h3>
                            <p class="dir-card-desc">Настоящая хореография на коврике. Вы разучиваете определенную последовательность асан, которая в финале занятия без единой паузы накладывается на ритм конкретного музыкального трека, превращая практику в непрерывный танец.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Pilates Recovery.png" alt="Pilates Recovery" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок2.png" alt="icon"></div>
                            <h3 class="dir-card-title">Pilates Recovery</h3>
                            <p class="dir-card-desc">Интенсивный и самый жиросжигающий класс, где бережные движения пилатеса соединены с непрерывным аэробным темпом. Упражнения выстраиваются в динамичные связки и выполняются без пауз, но в безопасной для суставов амплитуде.</p>
                        </div>
                    </div>

                    <div class="direction-card-box inactive-right">
                        <img src="img/Directions-Posture Stretch.png" alt="Posture Stretch" class="dir-card-img">
                        <div class="dir-card-content">
                            <div class="dir-card-icon"><img src="img/Значок3.png" alt="icon"></div>
                            <h3 class="dir-card-title">Posture Stretch</h3>
                            <p class="dir-card-desc">Специализированный комплекс, сфокусированный на верхней части тела. На занятии вы выполняете бережные упражнения на раскрытие грудного отдела, вытяжение шеи и мягкую проработку плечевых суставов.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>

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

            const track = document.getElementById('dirs-carousel-track');
            const container = document.getElementById('dirs-carousel-container');
            const cardsArr = Array.from(document.querySelectorAll('.direction-card-box'));

            if (track && cardsArr.length > 0) {
                let currentIndex = 1; 

                function updateCarouselEffect() {
                    cardsArr.forEach(card => {
                        card.classList.remove('active', 'inactive-left', 'inactive-right');
                    });
                    
                    cardsArr.forEach((card, index) => {
                        if (index === currentIndex) {
                            card.classList.add('active'); 
                        } else if (index < currentIndex) {
                            card.classList.add('inactive-left'); 
                        } else {
                            card.classList.add('inactive-right'); 
                        }
                    });

                    const activeCard = cardsArr[currentIndex];
                    const containerWidth = container.offsetWidth;
                    const translateX = (containerWidth / 2) - (activeCard.offsetLeft + (activeCard.offsetWidth / 2));

                    track.style.transform = `translateX(${translateX}px)`;
                }

                cardsArr.forEach((card, index) => {
                    card.addEventListener('click', () => {
                        currentIndex = index; 
                        updateCarouselEffect();
                    });
                });

                let startX = 0;
                let isDragging = false;
                
                function handleStart(e) {
                    startX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
                    isDragging = true;
                    track.style.cursor = 'grabbing';
                }

                function handleEnd(e) {
                    if (!isDragging) return;
                    isDragging = false;
                    track.style.cursor = 'grab';
                    
                    let endX = e.type.includes('mouse') ? e.clientX : e.changedTouches[0].clientX;
                    let diff = startX - endX;

                    if (diff > 50 && currentIndex < cardsArr.length - 1) {
                        currentIndex++; 
                        updateCarouselEffect();
                    } else if (diff < -50 && currentIndex > 0) {
                        currentIndex--; 
                        updateCarouselEffect();
                    }
                    startX = 0;
                }

                track.addEventListener('mousedown', handleStart);
                window.addEventListener('mouseup', handleEnd);
                track.addEventListener('touchstart', handleStart, {passive: true});
                track.addEventListener('touchend', handleEnd);

                window.addEventListener('resize', updateCarouselEffect);
                setTimeout(updateCarouselEffect, 100); 
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const currentPath = window.location.pathname;
    
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        
        if (currentPath.includes(linkPath) || (linkPath === 'Teachers.html' && currentPath.includes('TeacherProfile'))) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
});
    </script>
    
</body>
</html>