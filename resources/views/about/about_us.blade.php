@extends('layouts.app')
@section('page')
    <title>О нас - LanGame</title>
@endsection
@section('content')
    <!--SECTION ABOUT SERVICE START-->
    <section class="about_service_wrapper">
        <div class="choose_club_info_wrapper">
            <div class="container_service">
                <div class="choose_club_info service">
                    <div class="choose_club_info_title service">
                        <h1><span>LAN</span><span class="text_decor">GAME -</span></h1>
                        <h2>
                            продукты и решения для владельцев, сотрудников и
                            посетителей компьютерных клубов.
                        </h2>
                        <a href="{{url('register')}}" class="learn_more">Узнать нас за 1 минуту</a>
                    </div>
                    <div class="choose_club_info_img service">
                        <img src="{{ asset('/img/service/aboutservice.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION ABOUT SERVICE END-->

    <!--SECTION ABOUT SERVICE DESCR START-->
    <section class="about_service_descr_wrapper">
        <div class="container_descr">
            <div class="about_service_descr">
                <div class="descr_item">
                    <div class="descr_title">
                        Совмещаем <span class="text_decor">хобби и бизнес</span>
                    </div>
                    <div class="descr_text">
                        <h4>
                            Как и вы, мы играли в компьютерные клубы “нулевых” и с
                            тоской наблюдали их упадок в “десятых”.
                        </h4>
                        <h4>
                            Повзрослев, мы активно участвовали в их возрождении,
                            а сегодня создаём стандарты и внедряем передовой опыт в нашу индустрию.
                        </h4>
                    </div>
                </div>
                <div class="descr_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/descr.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION ABOUT SERVICE DESCR END-->

    <!--SECTION SERVICE FOR PEOPLE START-->
    <section class="service_for_people_wrapper">
        <div class="container_service">
            <div class="service_for_people">
                <div class="text_wrapper">
                    <div class="descr_title">
                        Работаем <span class="text_decor">для людей</span>
                    </div>
                    <div class="descr_text">
                        Для этого в своих продуктах мы объединяем всех, кто выстраивает рынок
                        и культуру компьютерных клубов вместе с нами: владельцев, сотрудников и,
                        конечно, посетителей.
                    </div>
                </div>
            </div>

            <div class="service_list">
                <div class="service_item">
                    <div class="img_wrapper f5">
                        <img src="{{ asset('/img/service/f5.svg')}}" alt="image">
                    </div>
                    <div class="descr">
                        Сеть собственных компьютерных клубов
                        “F5 Центр Киберспорта”
                    </div>
                    <a href="https://f5center.com">Посетить</a>
                </div>
                <div class="service_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/ln3.svg')}}" alt="image">
                    </div>
                    <div class="descr">
                        Программный комплекс
                        для управления вашим
                        компьютерным клубом
                    </div>
                    <a href="{{url('langame-software')}}">Установить</a>
                </div>
                <div class="service_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/ln1.svg')}}" alt="image">
                    </div>
                    <div class="descr">
                        Информационный портал
                        для владельцев и
                        посетителей клубов
                    </div>
                    <a href="{{url('/')}}/{{city()}}">Узнать</a>
                </div>
                <div class="service_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/service/ln2.svg')}}" alt="image">
                    </div>
                    <div class="descr">
                        Дистрибуция, доверительное
                        управление и другие услуги
                        для бизнеса
                    </div>
                    <a href="{{url('contacts')}}">Заказать</a>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION SERVICE FOR PEOPLE END-->

    <!--SECTION OUR GOALS START-->
    <section class="our_goals_wrapper">
        <div class="container_service">
            <div class="service_for_people">
                <div class="text_wrapper">
                    <div class="descr_title">
                        Идем <span class="text_decor">к нашим целям</span>
                    </div>
                    <div class="descr_text">
                        В 2017 году нашей целью было открыть три клуба в течение трёх лет.
                        За это время у нас появилось 7 площадок, собственное ПО и приложение, интернет-магазин,
                        агрегатор и другие направления бизнеса. С тех пор мы ставим более амбициозные цели.
                    </div>
                </div>
            </div>
        </div>

        <div class="our_goals_list">
            <div class="our_goals_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/website.svg')}}" alt="image">
                </div>
                <div class="text_wrapper">
                    <div class="title">Стать федеральной сетью</div>
                    <div class="descr">
                        Покрыть собственными
                        клубами 16 городов-миллионов
                    </div>
                </div>
            </div>
            <div class="our_goals_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/percent.svg')}}" alt="image">
                </div>
                <div class="text_wrapper">
                    <div class="title">Сделать лучшее ПО</div>
                    <div class="descr">
                        Интегрировать
                        LANGAME Software
                        минимум в 40% клубов страны
                    </div>
                </div>
            </div>
            <div class="our_goals_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/inbox.svg')}}" alt="image">
                </div>
                <div class="text_wrapper">
                    <div class="title">Быть самыми информативными</div>
                    <div class="descr">
                        Собрать самую полную и
                        актуальную базу клубов
                        в России на langame.ru
                    </div>
                </div>
            </div>
            <div class="our_goals_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/handshake.svg')}}" alt="image">
                </div>
                <div class="text_wrapper">
                    <div class="title">Собрать сообщество профессионалов</div>
                    <div class="descr">
                        Создать экспертную платформу
                        для взаимодействия всех
                        участников клубного рынка
                    </div>
                </div>
            </div>
            <div class="our_goals_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/octicon.svg')}}" alt="image">
                </div>
                <div class="text_wrapper">
                    <div class="title">Сформировать стандарты</div>
                    <div class="descr">
                        Создать общепринятую
                        классификацию и оценку
                        компьютерных клубов
                    </div>
                </div>
            </div>
            <div class="our_goals_item">
                <span>к <span class="text_decor">2024 году!</span></span>
            </div>
        </div>
    </section>
    <!--SECTION OUR GOALS END-->

    <!--SECTION OUR TEAM START-->
    <section class="our_team_wrapper">
        <div class="container_service">
            <div class="title">
                Силами лучшей <span class="text_decor">команды</span>
            </div>
        </div>

        <div class="our_team_list">
            <div class="our_team_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/team1.png')}}" alt="image">
                </div>
                <div class="name">
                    Дмитрий Лукин
                </div>
                <div class="position">
                    Основатель F5 Центр киберспорта и LANGAME
                </div>
            </div>
            <div class="our_team_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/team6.png')}}" alt="image">
                </div>
                <div class="name">
                    Максим Улыбышев
                </div>
                <div class="position">
                    Коммерческий директор
                </div>
            </div>
            <div class="our_team_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/team5.png')}}" alt="image">
                </div>
                <div class="name">
                    Василий Фокин
                </div>
                <div class="position">
                    Руководитель службы поддержки
                </div>
            </div>
            <div class="our_team_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/team4.png')}}" alt="image">
                </div>
                <div class="name">
                    Кирилл Соцков
                </div>
                <div class="position">
                    Должность
                </div>
            </div>
            <div class="our_team_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/team3.png')}}" alt="image">
                </div>
                <div class="name">
                    Роман Ролдугин
                </div>
                <div class="position">
                    IT-директор
                </div>
            </div>
            <div class="our_team_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/team2.png')}}" alt="image">
                </div>
                <div class="name">
                    Павел Голубев
                </div>
                <div class="position">
                    Руководитель проекта
                </div>
            </div>
            <div class="our_team_item">
                <div class="img_wrapper">
                    <img src="{{ asset('/img/service/team.png')}}" alt="image">
                </div>
                <div class="name">
                    Сергей Чернышев
                </div>
                <div class="position">
                    Директор по развитию
                </div>
            </div>
        </div>

        <p>И ещё <span class="text_decor">42 ценных сотрудника</span></p>
    </section>
    <!--SECTION OUR TEAM END-->

    <!--SECTION OUR BLOG START-->
    <section class="our_team_wrapper">
        <div class="container_service">
            <div class="title">
                О работе <span class="text_decor">которых говорят</span>
            </div>

            <div class="articles">
                <div class="articles_list">
                    <div class="articles_item">
                        <a href="#">
                            <div class="article_img_wrapper">
                                <img src="{{ asset('/img/service/gallery.png')}}" alt="image">
                            </div>
                            <div class="article_content_wrapper">
                                <div class="article_title">
                                    Киберспорт не для слабаков! Как разбогатеть на компьюте ...
                                </div>
                                <p class="descr">Теперь Я Босс!</p>
                                <p>Смотреть</p>
                            </div>
                        </a>
                    </div>
                    <div class="articles_item">
                        <a href="#">
                            <div class="article_img_wrapper">
                                <img src="{{ asset('/img/service/gallery1.png')}}" alt="image">
                            </div>
                            <div class="article_content_wrapper">
                                <div class="article_title">
                                    Как компьютерные клубы выживают в карантин? ...
                                </div>
                                <p class="descr">Игромания</p>
                                <p>Смотреть</p>
                            </div>
                        </a>
                    </div>
                    <div class="articles_item">
                        <a href="#">
                            <div class="article_img_wrapper">
                                <img src="{{ asset('/img/service/gallery2.png')}}" alt="image">
                            </div>
                            <div class="article_content_wrapper">
                                <div class="article_title">
                                    Куда ездят по ночам москвичи
                                </div>
                                <p class="descr">The Village</p>
                                <p>Смотреть</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION OUR BLOG END-->

    <!--SECTION OUR PARTNERS START-->
    <section class="our_team_wrapper">
        <div class="container_service">
            <div class="title">
                Поэтому нам <span class="text_decor">доверяют</span>
            </div>

            <div class="our_partners_list">
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/nvidia.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/msi.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/cooler.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/ocs.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/intel.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/pepsico.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/dxracer.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/apk.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/fed.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/game.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/logitech.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/strim.svg')}}" alt="image">
                </div>
                <div class="our_partners_item">
                    <img src="{{ asset('/img/service/electronic.svg')}}" alt="image">
                </div>
            </div>
        </div>
    </section>
    <!--SECTION OUR PARTNERS END-->

    <!--SECTION SERVICE BOTTOM BLOCK START-->
    <section class="service_block_bottom">
        <div class="container_service">
            <div class="title">
                И всё это, чтобы <span class="text_decor">воплотить мечту</span>
            </div>
            <div class="decsr">
                <p>
                    Делать игры и киберспорт <span class="text_decor">доступными для каждого!</span>
                </p>
            </div>
            <a href="{{url('register')}}" class="learn_more">Вы с нами?</a>
        </div>
    </section>
    <!--SECTION SERVICE BOTTOM BLOCK END-->
@endsection
