<?php

/**
 * Template name: тепловые насосы
 *
 */

get_header();

$heating_shop_url = function_exists('computex_cond_get_shop_filter_url_for_profile')
	? computex_cond_get_shop_filter_url_for_profile('heat_pump_air_water')
	: home_url('/shop/');
?>
<div class="computex-if-page">
    <main>
        <section class="computex-if-hero">
            <div class="computex-if-container computex-if-hero-grid">
                <div>
                    <div class="computex-if-eyebrow"><span class="computex-if-pulse"></span> Тепловые насосы воздух-вода</div>
                    <h1>Отопление, охлаждение и горячая вода <span class="computex-if-highlight">от одной системы.</span></h1>
                    <p class="computex-if-hero-copy">Тепловой насос воздух-вода помогает снизить расходы на отопление и поддерживать комфортный климат в доме круглый год.</p>
                    <p class="computex-if-hero-copy">Это удобная альтернатива для домов, где нет газа или подключение газа слишком дорогое. Подберем модель под площадь, теплопотери, бюджет и задачи.</p>
                    <div class="computex-if-actions">
                        <a class="computex-if-btn" href="#heating-request">Получить смету бесплатно</a>
                        <a class="computex-if-btn computex-if-btn-secondary" href="#steps">Как это работает</a>
                    </div>
                    <div class="computex-if-proof-row">
                        <span>Класс энергоэффективности A+++</span>
                        <span>Работа до -25°C</span>
                        <span>Для домов без газа</span>
                        <span>Wi‑Fi управление</span>
                    </div>
                </div>
                <div class="computex-if-hero-product">
                    <img src="https://klimat.computex.by/wp-content/uploads/2026/05/vetero.png" alt="Тепловой насос Vetero">
                </div>
            </div>
        </section>

        <section id="steps" class="computex-if-section computex-if-section-alt">
            <div class="computex-if-container">
                <div class="computex-if-section-header">
                    <div class="computex-if-kicker">Как это работает</div>
                    <h2>Как тепловой насос воздух-вода работает в доме.</h2>
                </div>
                <div class="computex-if-process-grid">
                    <div class="computex-if-step-card computex-if-process-card">
                        <div class="computex-if-step-num">1</div>
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 11H18.5C20.433 11 22 9.433 22 7.5C22 5.567 20.433 4 18.5 4C17.285 4 16.214 4.619 15.586 5.559" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M5 16H25.5C27.433 16 29 14.433 29 12.5C29 10.567 27.433 9 25.5 9C24.285 9 23.214 9.619 22.586 10.559" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M8 21H19.5C21.433 21 23 22.567 23 24.5C23 26.433 21.433 28 19.5 28C18.285 28 17.214 27.381 16.586 26.441" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <h3>Забор тепла из воздуха</h3>
                        <p>Наружный блок забирает низкопотенциальное тепло из воздуха даже в холодную погоду.</p>
                    </div>
                    <div class="computex-if-step-card computex-if-process-card">
                        <div class="computex-if-step-num">2</div>
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 13L16 6L24 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 13V25H24V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7 25H26" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M14 16H22M14 20H22" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M10 17H6M10 21H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <h3>Сжатие и повышение температуры</h3>
                        <p>Компрессор повышает температуру хладагента и готовит энергию для передачи в систему.</p>
                    </div>
                    <div class="computex-if-step-card computex-if-process-card">
                        <div class="computex-if-step-num">3</div>
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 15L16 6L27 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.5 14.5V26H23.5V14.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13 26V19H19V26" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <h3>Передача тепла в дом</h3>
                        <p>Тепло уходит в водяной контур: радиаторы, теплый пол, фанкойлы или бойлер ГВС.</p>
                    </div>
                    <div class="computex-if-step-card computex-if-process-card">
                        <div class="computex-if-step-num">4</div>
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M25.5 6.5C17.5 6.5 9 11 9 20C9 24.418 11.91 27 16 27C24 27 28 18 25.5 6.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7 27C11 20 15.5 15 23 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <h3>Экономия энергии</h3>
                        <p>Автоматика поддерживает температуру, помогает экономить и контролировать работу системы.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="computex-if-section">
            <div class="computex-if-container">
                <div class="computex-if-section-header">
                    <div class="computex-if-kicker">Преимущества</div>
                    <h2>Почему выбирают тепловые насосы воздух-вода.</h2>
                </div>
                <div class="computex-if-offer-grid">
                    <div class="computex-if-price-card">
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 10.5C6 7.46243 10.4772 5 16 5C21.5228 5 26 7.46243 26 10.5V21.5C26 24.5376 21.5228 27 16 27C10.4772 27 6 24.5376 6 21.5V10.5Z" stroke="currentColor" stroke-width="2" />
                                <path d="M26 10.5C26 13.5376 21.5228 16 16 16C10.4772 16 6 13.5376 6 10.5" stroke="currentColor" stroke-width="2" />
                                <path d="M26 16C26 19.0376 21.5228 21.5 16 21.5C10.4772 21.5 6 19.0376 6 16" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </span>
                        <h3>Альтернатива газу</h3>
                        <p>Подходит для домов без газовой магистрали или когда подключение газа получается слишком дорогим.</p>
                    </div>
                    <div class="computex-if-price-card">
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.5 5.5C17 5.5 9 10.5 9 19.5C9 24 12 27 16.5 27C25.5 27 29 17.5 26.5 5.5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                <path d="M6 26C10.5 18 16 13 24 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <h3>Экологичные хладагенты</h3>
                        <p>В зависимости от модели используются современные решения на R290 или R32.</p>
                    </div>
                    <div class="computex-if-price-card">
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16" cy="16" r="5" stroke="currentColor" stroke-width="2" />
                                <path d="M16 3V7M16 25V29M3 16H7M25 16H29M6.80761 6.80761L9.63604 9.63604M22.364 22.364L25.1924 25.1924M25.1924 6.80761L22.364 9.63604M9.63604 22.364L6.80761 25.1924" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <h3>Климат круглый год</h3>
                        <p>Одна система может работать на отопление, охлаждение и горячее водоснабжение.</p>
                    </div>
                    <div class="computex-if-price-card">
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 13L16 6L27 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8 13V25M14 13V25M20 13V25M26 13V25" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M5 25H27" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <h3>Умное управление</h3>
                        <p>Температура, таймеры, режимы и контроль энергопотребления доступны через Wi‑Fi.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="computex-if-section computex-if-section-alt">
            <div class="computex-if-container">
                <div class="computex-if-section-header">
                    <div class="computex-if-kicker">Сравнение</div>
                    <h2>Тепловой насос или традиционное отопление?</h2>
                </div>
                <div class="computex-if-comparison-grid computex-if-comparison-grid--vs">
                    <div class="computex-if-compare-box computex-if-compare-featured">
                        <h3>Тепловой насос</h3>
                        <div class="computex-if-compare-img">
                            <img src="https://klimat.computex.by/wp-content/uploads/2026/05/vetero.png" alt="Тепловой насос Vetero">
                        </div>
                        <ul class="computex-if-list">
                            <li><span class="computex-if-check">✓</span> Отопление, охлаждение и горячая вода от одной системы.</li>
                            <li><span class="computex-if-check">✓</span> Высокая сезонная эффективность и класс A+++.</li>
                            <li><span class="computex-if-check">✓</span> Работа при наружной температуре до -25°C.</li>
                            <li><span class="computex-if-check">✓</span> Удаленный мониторинг и управление через Wi‑Fi.</li>
                            <li><span class="computex-if-check">✓</span> Нет сжигания топлива внутри дома.</li>
                        </ul>
                    </div>
                    <div class="computex-if-vs" aria-hidden="true">VS</div>
                    <div class="computex-if-compare-box">
                        <h3>Газовый котел</h3>
                        <div class="computex-if-compare-img">
                            <img src="https://klimat.computex.by/wp-content/uploads/2026/05/gaz.png" alt="Газовый котел">
                        </div>
                        <ul class="computex-if-list">
                            <li><span class="computex-if-cross">×</span> Зависимость от топлива, тарифов и доступности подключения.</li>
                            <li><span class="computex-if-cross">×</span> Для газового котла нужны дымоход и требования к котельной.</li>
                            <li><span class="computex-if-cross">×</span> Электрокотел сильнее нагружает сеть при отоплении.</li>
                            <li><span class="computex-if-cross">×</span> Обычно нет полноценного режима охлаждения.</li>
                            <li><span class="computex-if-cross">×</span> Эксплуатационные расходы сложнее контролировать.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="computex-if-section">
            <div class="computex-if-container">
                <div class="computex-if-comparison-grid">
                    <div class="computex-if-warranty computex-if-warranty--compact">
                        <div class="computex-if-warranty__icon" aria-hidden="true">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 5L33 10V19C33 27 28.1 34 21 37C13.9 34 9 27 9 19V10L21 5Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round" />
                                <path d="M15 21L19 25L27.5 16.5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="computex-if-warranty__content">
                            <div class="computex-if-eyebrow computex-if-warranty__badge"><span class="computex-if-pulse"></span> Гарантия 5 лет</div>
                            <h2>Гарантия на оборудование и монтаж</h2>
                            <p>Используем проверенное оборудование, выполняем аккуратный монтаж, запускаем систему и объясняем управление. После установки вы получаете гарантию на оборудование и выполненные работы.</p>
                        </div>
                        <div class="computex-if-warranty__meta">
                            <span>Оборудование</span>
                            <strong>+</strong>
                            <span>Монтаж</span>
                        </div>
                    </div>
                    <div class="computex-if-compare-box">
                        <h3>Характеристики</h3>
                        <ul class="computex-if-rules">
                            <li><span>Тип системы</span><strong>воздух-вода</strong></li>
                            <li><span>Класс эффективности</span><strong>A+++</strong></li>
                            <li><span>Режимы работы</span><strong>тепло / холод / ГВС</strong></li>
                            <li><span>Работа на обогрев</span><strong>до -25°C</strong></li>
                            <li><span>Работа на охлаждение</span><strong>до +43°C</strong></li>
                            <li><span>Макс. температура воды</span><strong>до 75°C</strong></li>
                            <li><span>Хладагент</span><strong>R290 / R32</strong></li>
                            <li><span>Питание</span><strong>220В или 380В</strong></li>
                            <li><span>Уровень шума</span><strong>от 41 дБ</strong></li>
                            <li><span>Компрессор</span><strong>инверторный</strong></li>
                            <li><span>Системы отопления</span><strong>полы, радиаторы, фанкойлы</strong></li>
                            <li><span>Управление</span><strong>Wi‑Fi</strong></li>
                        </ul>
                        <a class="computex-if-btn computex-if-btn-full" href="<?php echo esc_url($heating_shop_url); ?>">Каталог</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="prices" class="computex-if-section computex-if-section-alt">
            <div class="computex-if-container">
                <div class="computex-if-section-header">
                    <div class="computex-if-kicker">Опыт компании</div>
                    <h2>Подберем систему под дом, сеть и бюджет.</h2>
                </div>
                <div class="computex-if-offer-grid">
                    <div class="computex-if-trust-card">
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 4L25 8V15C25 21 21.2 26.2 16 28C10.8 26.2 7 21 7 15V8L16 4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                <path d="M11.5 15.5L14.5 18.5L21 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <h3>Выезд по Гомелю</h3>
                        <p>Оценим объект, существующее отопление, электрическую мощность и место установки наружного блока.</p>
                    </div>
                    <div class="computex-if-trust-card">
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 4V8M16 24V28M4 16H8M24 16H28M7.5 7.5L10.3 10.3M21.7 21.7L24.5 24.5M24.5 7.5L21.7 10.3M10.3 21.7L7.5 24.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <circle cx="16" cy="16" r="6" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </span>
                        <h3>Расчет под параметры</h3>
                        <p>Подберем мощность теплового насоса с учетом площади, утепления и нужного режима работы.</p>
                    </div>
                    <div class="computex-if-trust-card">
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 28C16 28 25 20.5 25 12.5C25 7.52944 20.9706 4 16 4C11.0294 4 7 7.52944 7 12.5C7 20.5 16 28 16 28Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                                <circle cx="16" cy="12.5" r="3.5" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </span>
                        <h3>Понятная смета</h3>
                        <p>Сразу покажем, что входит в оборудование, монтаж, подключение и запуск системы.</p>
                    </div>
                    <div class="computex-if-trust-card">
                        <span class="computex-if-card-icon" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16" cy="12" r="7" stroke="currentColor" stroke-width="2" />
                                <path d="M12 18L10 28L16 24L22 28L20 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13 12L15 14L19.5 9.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <h3>Запуск и настройка</h3>
                        <p>Проверим работу системы, настроим режимы и покажем, как управлять климатом.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="computex-if-section">
            <div class="computex-if-container">
                <div class="computex-if-installment">
                    <div class="computex-if-installment__content">
                        <div class="computex-if-eyebrow computex-if-installment__badge"><span class="computex-if-pulse"></span> Рассрочка 0%</div>
                        <h2>Рассрочка на оборудование и монтаж</h2>
                        <p>Можно установить тепловой насос без полной оплаты сразу. Подскажем доступные варианты рассрочки на оборудование, монтажные работы и запуск системы.</p>
                        <div class="computex-if-installment__chips">
                            <span>Оборудование</span>
                            <span>Монтаж</span>
                        </div>
                    </div>
                    <div class="computex-if-installment__image">
                        <img src="https://klimat.computex.by/wp-content/uploads/2024/10/card-1.png" alt="Карты рассрочки">
                    </div>
                </div>
            </div>
        </section>

        <section class="computex-if-section computex-if-section-alt">
            <div class="computex-if-container">
                <div class="computex-if-price-offer">
                    <div>
                        <div class="computex-if-eyebrow computex-if-price-offer__badge"><span class="computex-if-pulse"></span> Под ключ</div>
                        <h2>Тепловые насосы воздух-вода <span class="computex-if-price-accent">от 15000 руб</span></h2>
                        <p>Подберем решение под площадь дома, теплопотери, систему отопления и доступную электрическую мощность.</p>
                        <small>Стоимость указана ориентировочно. Итоговая цена зависит от модели оборудования, комплектации, сложности монтажа и параметров объекта.</small>
                    </div>
                    <a class="computex-if-btn" href="#heating-request">Рассчитать стоимость</a>
                </div>
            </div>
        </section>

        <section id="faq" class="computex-if-section computex-if-section-alt">
            <div class="computex-if-container">
                <div class="computex-if-section-header">
                    <h2>Частые вопросы</h2>
                </div>
                <div class="computex-if-faq-stack accordion-wrapp">
                    <div class="accordion computex-if-faq">
                        <div class="accordion__title show-accordion">
                            <h3>Что такое тепловой насос воздух-вода?</h3>
                        </div>
                        <div class="accordion__body computex-if-faq-content" style="display: block;">
                            <p>Это система отопления, которая забирает тепло из наружного воздуха и передает его в дом через теплые полы, радиаторы или систему горячей воды.</p>
                        </div>
                    </div>
                    <div class="accordion computex-if-faq">
                        <div class="accordion__title">
                            <h3>Кому выгодна установка теплового насоса?</h3>
                        </div>
                        <div class="accordion__body computex-if-faq-content">
                            <p>В первую очередь владельцам домов без газа, с дорогим электрическим или твердотопливным отоплением, а также тем, кто хочет современное отопление под ключ без постоянной загрузки топлива.</p>
                        </div>
                    </div>
                    <div class="accordion computex-if-faq">
                        <div class="accordion__title">
                            <h3>Работает ли тепловой насос зимой?</h3>
                        </div>
                        <div class="accordion__body computex-if-faq-content">
                            <p>Да, современные тепловые насосы работают зимой. При сильных морозах эффективность может снижаться, поэтому важно правильно подобрать мощность и систему отопления.</p>
                        </div>
                    </div>
                    <div class="accordion computex-if-faq">
                        <div class="accordion__title">
                            <h3>Как долго служит тепловой насос и как часто его обслуживать?</h3>
                        </div>
                        <div class="accordion__body computex-if-faq-content">
                            <p>В среднем тепловой насос служит 15-20 лет. Обслуживание обычно проводят 1 раз в год, желательно перед отопительным сезоном.</p>
                        </div>
                    </div>
                    <div class="accordion computex-if-faq">
                        <div class="accordion__title">
                            <h3>Можно ли установить тепловой насос в уже построенный дом?</h3>
                        </div>
                        <div class="accordion__body computex-if-faq-content">
                            <p>Да, можно. Перед установкой нужно проверить утепление дома, существующие радиаторы или теплые полы, электрическую мощность и место для наружного блока.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="heating-request" class="computex-if-section">
            <div class="computex-if-container">
                <div class="computex-if-cta-box">
                    <h2><span>Получите бесплатную консультацию</span> от нашего специалиста</h2>
                    <p>Оставьте свои контактные данные, специалист свяжется с вами и подскажет, какой тепловой насос подойдет вашему дому.</p>
                    <a class="computex-if-btn open-contact-modal" href="https://t.me/computex_gomel">Получить консультацию</a>
                </div>
            </div>
        </section>
        <?php
        if (function_exists('computex_cond_render_landing_page_hits_slider')) {
            computex_cond_render_landing_page_hits_slider();
        }
        ?>
    </main>
</div>

<?php
get_footer();
