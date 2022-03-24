@extends('layouts.app')
@section('page')
<title>Программное обеспечение для компьютерных клубов LANGAME SOFTWARE</title>
<meta name="keywords" content="Софт, компьютерный клуб, По, программное обеспечение, интернет кафе, киберклуб" />
<meta name="description" content="LANGAME SOFTWARE - программное обеспечение для автоматизации работы компьютерных клубов, разработанное владельцами компьютерных клубов" />
@endsection
@section('content')
<!--SECTION LANGAME SOFTWARE START-->
<section class="langame_software_wrapper">
    <div class="langame_software_info_wrapper">
        <div class="container-fluid">
            <div class="langame_software_info">
                <div class="info_item">
                    <div class="title">
                        Программа для управления вашим
                        компьютерным клубом
                    </div>
                    <a href="#block-langame_software_features" class="learn_more">Узнать больше</a>
                </div>
                <div class="info_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/software.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="langame_software_features_wrapper" id="block-langame_software_features">
        <div class="container">
            <div class="sub_title">почему langame?</div>
            <div class="title">
                От собственников для собственников
            </div>
            <div class="descr">
                LANGAME Software - это 6 лет опыта управления сетью собственных компьютерных клубов, вложенных в разработку нашего решения.
            </div>
            <div class="langame_software_features_list">
                <div class="features_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/calendar.svg')}}" alt="icon">
                    </div>
                    <div class="title_wrapper">
                        <div class="title">Ни одного убыточного месяца</div>
                    <div class="descr">За всю историю существования сети</div>
                    </div>
                </div>
                <div class="features_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/house.svg')}}" alt="icon">
                    </div>
                    <div class="title_wrapper">
                        <div class="title">Ни одного <br> закрытого клуба</div>
                    <div class="descr">Открыли новый клуб во время пандемии</div>
                    </div>
                </div>
                <div class="features_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/cash.svg')}}" alt="icon">
                    </div>
                    <div class="title_wrapper">
                        <div class="title">Без привлечения инвестиций</div>
                    <div class="descr">Используем только свои ресурсы</div>
                    </div>
                </div>
                <div class="features_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/money.svg')}}" alt="icon">
                    </div>
                    <div class="title_wrapper">
                        <div class="title">Не продаём <br> франшизы</div>
                    <div class="descr">Потому что умеем зарабатывать операционно</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="langame_software_description_wrapper">
        <div class="container-fluid">
            <div class="langame_software_description">
                <div class="description_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/software2.png')}}" alt="image">
                    </div>
                </div>
                <div class="description_item">
                    <div class="sub_title">это не просто софт</div>
                    <div class="title">
                        Решаем проблемы
                        и упрощаем работу
                    </div>
                    <ul class="description_list">
                        <li>
                            <div class="title">
                                Минимизируем человеческий фактор
                            </div>
                            <div class="descr">
                                По нашим данным, клубы могут терять до 40% выручки из-за персонала и гостей.
                                Мы снижаем эту зависимость с помощью программных решений.
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                Обеспечиваем безопасность
                            </div>
                            <div class="descr">
                                Предотвращаем несанкционированный доступ к ПК и консолям,
                                установке вредоносного ПО и персональным данным гостей.
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                Даём полный контроль владельцу
                            </div>
                            <div class="descr">
                                Глубокая система аналитики, логирование всех процессов, полные данные о гостях,
                                финансовых потоках и много другое. Всё это в доступе из любой точки Земного шара.
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                Автоматизируем процессы
                            </div>
                            <div class="descr">
                                Упрощаем жизнь с помощью самостоятельного пополнения баланса, бронирования, автопосадки,
                                автоматирзированных планов энергопотребления, дозаказа продукции и другой рутины.
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="#block-langame_software_request" class="learn_more">Запросить демо-доступ</a>
        </div>
    </div>
    <div class="langame_software_tariffs_wrapper">
        <div class="container-fluid">
            <div class="title">
                Простые тарифные планы, которые не зависят от количества клубов и компьютеров
            </div>
            <div class="tariffs_wrapper">
                <div class="langame_software_tariffs">
                    <div class="tariffs_item">
                        <div class="tariffs_title">
                            <p>Стартовый</p>
                            <p class="text_decor">В РАЗРАБОТКЕ</p>
                        </div>
                        <div class="descr">Простое решение для небольшого бизнеса</div>
                        <ul>
                            <li>
                                <span>Интерфейс для клиентов и администраторов</span>
                            </li>
                            <li>
                                <span>Распределение ролей, настройка пакетов</span>
                            </li>
                            <li>
                                <span>Сбор базовых данных о гостях</span>
                            </li>
                        </ul>
                        <button type="button" data-remodal-target="tariffs_modal">Полное описание</button>
                    </div>
                    <div class="tariffs_item">
                        <div class="tariffs_title">
                            <p>Профессиональный</p>
                            <p class="" style="color: #dc0000;
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 16px;
    text-align: center;
    margin: 0 0 5px;">Бесплатная помощь в переходе с другого ПО</p>
                            <p class="text_decor">300 рублей ПК/месяц</p>
                        </div>
                        <div class="descr">Решение для бизнеса с серьёзным подходом</div>
                        <ul class="secondary">
                            <li>
                                <span>Расширенные функции работы с гостями</span>
                            </li>
                            <li>
                                <span>Продвинутые технические модули</span>
                            </li>
                            <li>
                                <span>Модули автоматизации</span>
                            </li>
                            <li>
                                <span>Работа со складом и баром</span>
                            </li>
                            <li>
                                <span>Бонусный и промо-функционал</span>
                            </li>
                        </ul>
                        <button type="button" data-remodal-target="tariffs_modal">Полное описание</button>
                    </div>
                    <div class="tariffs_item">
                        <div class="tariffs_title">
                            <p>Эксклюзивный</p>
                            <p class="text_decor">Индивидуально</p>
                        </div>
                        <div class="descr">Для большой сети клубов или статусной площадки</div>
                        <ul>
                            <li>
                                <span>Дизайн ПО под фирменный стиль клуба</span>
                            </li>
                            <li>
                                <span>Отдельное приложение для App Store и Google Play</span>
                            </li>
                            <li>
                                <span>Приоритетная поддержка</span>
                            </li>
                        </ul>
                        <button type="button" data-remodal-target="tariffs_modal">Полное описание</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="langame_software_offer_wrapper">
        <div class="container">
            <div class="sub_title">Легко установить и начать работу</div>
            <div class="title">Сэкономьте время на чтение - просто попробуйте</div>
            <div class="langame_software_offer">
                <div class="offer_item">
                    <div class="number">01</div>
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/account_add.svg')}}" alt="icon">
                    </div>
                    <div class="title">Оставьте заявку</div>
                    <div class="descr">Заполните форму и мы свяжемся с вами</div>
                </div>
                <div class="offer_item">
                    <div class="number">02</div>
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/check.svg')}}" alt="icon">
                    </div>
                    <div class="title">Установите ПО</div>
                    <div class="descr">Наш специалист поможет вам online</div>
                </div>
                <div class="offer_item">
                    <div class="number">03</div>
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/rocket.svg')}}" alt="icon">
                    </div>
                    <div class="title">Сравните</div>
                    <div class="descr">Всего 300 рублей за 1ПК в месяц</div>
                </div>
            </div>
            <a href="#block-langame_software_request" class="learn_more">Попробовать</a>
        </div>
    </div>
    <div class="langame_software_options_wrapper">
        <div class="container">
            <div class="sub_title">не только программное обеспечение</div>
            <div class="title">Больше возможностей для наших партнёров</div>
            <ul class="langame_software_options">
                <li class="option_item active">
                    <div class="option">
                        <span>Управляющая компания</span>
                        <button type="button" class="options_btn"></button>
                    </div>
                    <div class="description">
                        Занимаемся управлением клубами, владельцы которых хотят выйти из операционки
                        или не могут достичь желаемых финансовых результатов
                    </div>
                </li>
                <li class="option_item">
                    <div class="option">
                        <span>Доверительное управление инвестициями</span>
                        <button type="button" class="options_btn"></button>
                    </div>
                    <div class="description">
                        Обеспечиваем до 30% годовых при инвестировании в группу компаний LANGAME
                    </div>
                </li>
                <li class="option_item">
                    <div class="option">
                        <span>Аренда и дистрибуция</span>
                        <button type="button" class="options_btn"></button>
                    </div>
                    <div class="description">
                        Сдаём оборудование в прокат, помогаем организовывать совместные
                        закупки для большей экономии
                    </div>
                </li>
                <li class="option_item">
                    <div class="option">
                        <span>Сервисы</span>
                        <button type="button" class="options_btn"></button>
                    </div>
                    <div class="description">
                        Выгодная замена системного администратора, контроль качества,
                        trade-in жёстких дисков на бездисковое решение и другие услуги
                    </div>
                </li>
                <li class="option_item">
                    <div class="option">
                        <span>Коммуникации</span>
                        <button type="button" class="options_btn"></button>
                    </div>
                    <div class="description">
                        Обеспечиваем платформы для общения и взаимодействия
                        профессионалов индустрии компьютерных клубов
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="langame_software_present_wrapper">
        <div class="container">
            <div class="langame_software_present">
                <div class="present_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/present1.png')}}" alt="image">
                    </div>
                </div>
                <div class="present_item">
                    <p>
                        Оставьте заявку и получите бесплатную помощь в переходе с другого ПО после официального релиза LANGAME Software!
                    </p>
                    <a href="#block-langame_software_request" class="learn_more">Оформить заявку</a>
                </div>
            </div>
        </div>
    </div>
    <div class="langame_software_content" id="block-langame_software_request">
            <div class="add_club_request_wrapper">
                <div class="title">Оформить заявку</div>
                <script src="https://yastatic.net/s3/frontend/forms/_/embed.js"></script><iframe src="https://forms.yandex.ru/u/623c1ade9390ee24bb684208/?iframe=1" frameborder="0" name="ya-form-623c1ade9390ee24bb684208" width="650"></iframe>
                <?/*
                <form action="{{url('langame/request')}}" method="post" id="add-club-request-form" data-recaptcha-form>
                    {{ csrf_field() }}
                    <div class="forma">
                        <div class="form-group required @error('name')error @enderror">
                            <label for="club-request-user-name-input">Ваше имя</label>
                            <input id="club-request-user-name-input" name="name" value="{{old('name')}}" type="text" placeholder="" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group required @error('club_name') error @enderror">
                            <label for="club-request-name-input">Название клуба</label>
                            <input id="club-request-name-input" name="club_name" value="{{old('club_name')}}" type="text" placeholder="Введите название клуба" required>
                            @error('club_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group required @error('city') error @enderror">
                            <label for="club-request-select-сity">Город</label>
                            <div class="input_wrapper">
                                <div class="select2_wrapper">
                                <?php
                                 $selected_city=old('city');
                                 if($selected_city == ''){
                                    $selected_city = city(true)['id'];
                                 }

                                ?>
                                    <select id="club-request-select-сity" name="city" required data-placeholder="Выберите город">
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('phone') error @enderror">
                            <label for="club-request-phone-input">Контактный телефон</label>
                            <input id="club-request-phone-input" name="phone" value="{{old('phone')}}" type="tel" placeholder="+7 (___) ___-__-__">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group required @error('email') error @enderror">
                            <label for="club-request-email-input">Email</label>
                            <input id="club-request-email-input" name="email" value="{{old('email')}}" type="email" placeholder="" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="checkbox_wrapper">
                            <div class="checkbox_item">
                                <label>
                                    <input type="checkbox" name="add_club_request_user_agree" required>
                                    <span class="activator"><span></span></span>
                                    <span>Согласен <a href="{{url('policy')}}">с условиями обработки</a> персональных данных</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="recaptcha-holder">
                        <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="{{env('RECAPCHA_PUB')}}"></div>
                    </div>
                    <div class="recaptcha-msg">
                        @error('g-recaptcha-response')
                        {{ $message }}
                        @enderror
                    </div>
                    <button type="submit" onclick="gtag('event', 'send', { 'event_category': 'add-club-request-form', 'event_action': 'send' });VK.Goal('lead');">Отправить заявку</button>
                </form>
                */?>
            </div>
    </div>
</section>

<?php
$tariffs = [
    'Тарифные планы' => [
        'Оболочки для клиента и администратора,<br> серверная часть' => [true, true, true],
        'Облачный доступ для управляющего и владельца' => [true, true, true],
        'Отдельное приложение' => [false, false, true],
        'Оформление и цветовая схема ПО<br> согласно фирменному стилю клуба' => [false, false, true],
    ],
    'Работа с гостями' => [
        'Сбор и редактирование данных гостей' => [true, true, true],
        'Ведение лога гостя<br> (пополнения, списания, какие компьютеры занимал)' => [true, true, true],
        'Лог комментариев от администраторов' => [true, true, true],
        'Черный список гостей (по телефону)' => [true, true, true],
        'Модерирование анкет<br> (проверка за администраторами их действий)' => [true, true, true],
        'Расширенная статистика по гостю<br> (во что гость чаще всего играет)' => [false, true, true],
    ],
    'Технические модули' => [
        'Настройки пакетов в зависимости от времени и дня недели' => [true, true, true],
        'Запрет на запуск выбранных процессов' => [true, true, true],
        'Интеграция с онлайн кассами и банковским терминалом' => [false, true, true],
        'Распределение доступов для учетных записей' => [false, true, true],
        'Контроль за обновлением версий ПО' => [false, true, true],
        'Контроль за конфигурацией ПК' => [false, true, true],
        'Распределение лицензий на игры' => [false, true, true],
        'Учет работы консолей' => [false, true, true],
        'Панель управления слайдами на главной странице' => [false, true, true],
        'Управление рекламным модулем' => [false, true, true],
    ],
    'Контроль качества' => [
        'Контроль за отвеченными/пропущенными звонками' => [false, true, true],
        'Контроль температуры в зале (до 10 точек в зале)<br> (требует дополнительного оборудования)' => [false, true, true],
        'Контроль загрузки и стабильности интернет соединения<br> (требует дополнительного оборудования)' => [false, true, true],
        'Формирование и учет информации<br> о различных проблемах и задачах внутри клуба (Тикеты)' => [false, true, true],
        'Статистика информированности администраторов об изменениях' => [false, true, true],
    ],
    'Дополнительный заработок' => [
        'Панель управления майнингом' => [false, true, true],
        'Гостевые аккаунты LANGAME (по модели revenue share)' => [false, true, true],
        'Контроль использования принтеров<br> (контроль счетчика печати с сопоставлением<br> данных счетчика с данными кассы)' => [false, true, true],
    ],
    'Автоматизация' => [
        'Модуль бронирования мест' => [false, true, true],
        'Автоматический расчет ЗП на основе<br> зарегистрированных смен администраторов' => [false, true, true],
        'Автоматическая схема экономии электричества' => [false, true, true],
        'Рассылки<br><br>• Настройка e-mail рассылок по событиям,<br><br>• Настройка рассылок в телеграмм по событиям' => [false, true, true],
        'Функционал распределения лицензий игр<br><br>• Лог нехватки тех или иных игр на гостевых аккаунтах для посетителей<br><br>• Статистика запроса гостевых аккаунтов с играми' => [false, true, true],
    ],
    'Склад и бар' => [
        'Учет товара на складе клуба' => [false, true, true],
        'Формирование поставок' => [false, true, true],
        'Оприходование поставок' => [false, true, true],
        'Контроль себестоимости поставок' => [false, true, true],
        'Выставление номенклатуры товаров' => [false, true, true],
        'Выставление номенклатуры прочих услуг' => [false, true, true],
        'Проведение инвентаризаций' => [false, true, true],
        'Лог продаж и списания товара' => [false, true, true],
        'Контроль остатков' => [false, true, true],
        'Возможность формирования поставок на основе данных<br> о потреблении продукции' => [false, true, true],
        'Возможность разбития товаров по категориям и поставщикам' => [false, true, true],
        'Учет товаров бара' => [false, true, true]
    ],
    'Дополнительный управленческий функционал' => [
        'Возможность составить отчет по смене с текстом, фото с описанием смены' => [false, true, true],
        'Возможность отправки сменного отчета в телеграмм и/или<br> на почту управляющему' => [false, true, true],
        'Аналитика <br><br>• Формирование лога отчетов за любые даты <br><br>• Формирование отчетов по категориям товаров или услуг <br><br>• Выручка по категориям <br><br>• Расходы по категориям <br><br>• Инкассация <br><br>• Количество уникальных авторизаций за ПК <br><br>• Загрузка зала в процентах <br><br>• Эффективная стоимость часа <br><br>• Анализ загрузки зала в процентах от общего числа пк
   каждые 10 минут и расчет интегрального показателя <br><br>• Мониторинг запускаемых процессов с построением графиков' => [false, true, true],
        'Бонусная программа: <br><br> • Разделение гостей на группы (бонусная программа) <br><br>• Начисления гостям баллов <br><br>• Выставление % бонусов в зависимости от групп пользователя <br><br>• Сколько баллов потратили гости за смену <br><br>• Сколько бонусов было начислено' => [false, true, true],
        'Промо-функционал: <br><br> • Формирование и учет подарочных сертификатов <br><br>• Формирование и учет промокодов <br><br>• Формирование и учет опросов среди любых групп пользователей <br><br>• Формирование и учет уведомлений среди любых групп пользователей' => [false, true, true],
    ]
];
?>

<div class="tariffs_modal_wrapper"></div>

<div class="tariffs_modal" data-remodal-id="tariffs_modal">
    <button data-remodal-action="close" class="remodal-close">Закрыть</button>
    <div class="remodal-content">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <div class="head_wrapper">
                            <p class="text_decor">В РАЗРАБОТКЕ</p>
                            <p>Стартовый</p>
                        </div>
                    </th>
                    <th>
                        <div class="head_wrapper">
                            <!-- <p class="text_decor">1% от выручки</p> -->
                            <p class="" style="color: #dc0000;
                            font-style: normal;
                            font-weight: 400;
                            font-size: 16px;
                            line-height: 16px;
                            text-align: center;
                            margin: 0 0 5px;">Бесплатная помощь в переходе с другого ПО</p>
                            <p class="text_decor">300 рублей ПК/месяц</p>
                            <p>Профессиональный</p>
                        </div>
                    </th>
                    <th>
                        <div class="head_wrapper">
                            <p class="text_decor">Индивидуально</p>
                            <p>Эксклюзивный</p>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tariffs as $group => $items)
                    <tr>
                        <td colspan="4"><div class="group-title"><?= $group; ?></div></td>
                    </tr>
                    @foreach($items as $item => $checkboxes)
                        <tr>
                            <td>
                                <div class="group-item"><?= $item; ?></div>
                            </td>
                            <td>
                                <?php if ($checkboxes[0]): ?>
                                <div class="checkbox"><img src="{{ asset('/img/check.svg')}}" alt="image"></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($checkboxes[1]): ?>
                                <div class="checkbox"> <img src="{{ asset('/img/check.svg')}}" alt="image"> </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($checkboxes[2]): ?>
                                <div class="checkbox"> <img src="{{ asset('/img/check.svg')}}" alt="image"> </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--SECTION LANGAME SOFTWARE END-->
@endsection
@section('scripts')

@if(session('success'))
<script>
    $( document ).ready(function(){
        jQuery('[data-remodal-id="success_modal"]').remodal().open();
    });
</script>
@endif
<script>
 $('#club-request-select-сity').select2({
        ajax: {
            url: $('meta[name="site"]').attr('content') +'/searchCities',
            dataType: 'json'
        },
        cache: true
    });

</script>
@endsection
