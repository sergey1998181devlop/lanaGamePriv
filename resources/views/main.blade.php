@extends('layouts.app')
@section('page')
    <title>Лучшие компьютерные клубы в России</title>
    <meta name="description"
          content="Все компьютерные клубы в России с их адресами в {{date('Y')}}. А также фото, отзывы, режим работы, цены, рейтинг и проводимые мероприятия.">
    <meta name="keywords" content="Компьютерный клуб, интернет-кафе, киберклуб, отзывы, цены"/>
@endsection
@section('content')

    <!--SECTION CHOOSE CLUB INFO START-->
    <section class="main_choose_club_info_wrapper">
        <div class="container">
            <div class="choose_club_info">
                <div class="choose_club_info_title">
                    <div class="title">
                        <span>Всё про компьютерные<br> клубы</span>
                        <div class="select2_wrapper select_city_wrapper">
                            <select class="select_city" id="all_city_selector">
                                <option>в России</option>
                                <option>{{city(true)['name']}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="main_descr">
                        Платформа для владельцев, управляющих и гостей кибер-арен,
                        гейм-лаунжей и киберспортивных клубов.
                    </div>
                </div>
                <div class="choose_club_info_img">
                    <img src="{{ asset('/img/choose.png')}}" alt="image">
                </div>
            </div>
        </div>
    </section>
    <!--SECTION CHOOSE CLUB INFO END-->

    @if(count($clubs) > 0)
        <!--SECTION SEARCH CLUB START-->
        <section class="sc_wrapper">
            <div class="container">
                <div class="search_club">
                    <div class="descr_title">Актуальная база</div>
                    <div class="main_descr">
                        Цены, характеристики ПК, акции, фото и другая информация об игровых площадках во всех городах России.
                    </div>
                    <div class="sc_list">
                        @foreach($clubs as $clubIndex => $club)
                            @include('club')
                        @endforeach
                    </div>
                    <a href="{{url('cities')}}" id="choose_city" class="show_more pointer">Выбрать свой город</a>
                </div>
            </div>
        </section>
        <!--SECTION SEARCH CLUB END-->

    @endif

    <!--SECTION MAIN PAGE OUR GOALS START-->
    <section class="main_our_goals_wrapper">
        <div class="container">
            <div class="service_for_people">
                <div class="text_wrapper">
                    <div class="descr_title">
                        Сообщество профессионалов
                    </div>
                    <div class="descr_text">
                        Объединяем владельцев и управляющих чтобы делиться опытом,
                        сотрудничать и развивать индустрию компьютерных клубов.
                    </div>
                </div>
            </div>
            <div class="our_goals_list">
                <div class="our_goals_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/bag.svg')}}" alt="image">
                    </div>
                    <div class="text_wrapper">
                        <div class="title">Маркетплейс</div>
                        <div class="descr">
                            Расскажите всем
                            о своей площадке
                        </div>
                    </div>
                </div>
                <div class="our_goals_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/events.svg')}}" alt="image">
                    </div>
                    <div class="text_wrapper">
                        <div class="title">Мероприятия</div>
                        <div class="descr">
                            Онлайн и оффлайн события для экспертов
                        </div>
                    </div>
                </div>
                <div class="our_goals_item prev_mob">
                    <span>И другие возможности!</span>
                </div>
                <div class="our_goals_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/stock.svg')}}" alt="image">
                    </div>
                    <div class="text_wrapper">
                        <div class="title">Биржа</div>
                        <div class="descr">
                            Выгодные предложения от брендов и других клубов
                        </div>
                    </div>
                </div>
                <div class="our_goals_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/ion.svg')}}" alt="image">
                    </div>
                    <div class="text_wrapper">
                        <div class="title">Киберспорт</div>
                        <div class="descr">
                            Турниры между десятками и сотнями клубов
                        </div>
                    </div>
                </div>
                <div class="our_goals_item last_mob">
                    <a href="{{url('register_club')}}">Зарегистрироваться</a>
                </div>
            </div>
        </div>

    </section>
    <!--SECTION MAIN PAGE OUR GOALS END-->

    <!--SECTION MAIN PAGE SOFTWARE DESCRIPTION START-->
    <div class="langame_software_description_wrapper">
        <div class="container">
            <div class="langame_software_description">
                <div class="description_item">
                    <div class="title">
                        Доступ к сервисам
                    </div>
                    <div class="main_descr">
                        LANGAME - это многолетний опыт управления собственной сетью компьютерных клубов,
                        которым мы готовы делиться, чтобы делать клубы комфортными для гостей,
                        а для владельцев - прибыльными.
                    </div>
                    <ul class="description_list">
                        <li>
                            <div class="title">
                                LANGAME Software
                            </div>
                            <div class="descr">
                                Программа для управления компьютерным клубом и приложение для гостей собственной разработки.
                                <a href="{{url('software')}}" class="text_decor">Подробнее</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                LANGAME Service
                            </div>
                            <div class="descr">
                                Доверительное управление, бугхалтерия, удалённый администратор, замена детских дисков на серверное решение и другие услуги.
                                <a href="{{url('contacts')}}" class="text_decor">Написать</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="description_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/software_main.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--SECTION MAIN PAGE SOFTWARE DESCRIPTION END-->

    @if(isset( $posts) && count($posts)>0)
        <!--SECTION ARTICLES START-->
        <section class="articles_wrapper">
            <div class="container">
                <div class="descr_title">Полезный контент</div>
                <div class="main_descr">
                    Пишем статьи и заметки, снимаем ролики и записываем подкасты с активными участниками движения LAN-гейминга.
                </div>
                <div class="articles">
                    <div class="articles_list">
                        @foreach($posts as $post)

                            <div class="articles_item">
                                <a href="{{url($post->id.'_statia_'.Str::slug($post->url))}}">
                                    <div class="article_img_wrapper">
                                        <img src="{{($post->image != '') ? url('storage/posts/thumbnail/'.$post->image) : asset('img/default-club-preview-image.svg')}}" alt="club">
                                    </div>
                                    <div class="article_content_wrapper">
                                        <div class="article_title">
                                            {{$post->name}}
                                        </div>
                                        <div class="article_descr">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($post->about),150, '...')}}
                                        </div>
                                        <p>Читать дальше</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    @if(isset( $postsCount) && $postsCount>3)
                        <a href="{{url('posts')}}" class="show_more">Читать ещё</a>
                    @endif
                </div>
            </div>
        </section>
        <!--SECTION ARTICLES END-->
    @endif

    <!--SECTION MAIN PAGE JOIN US START-->
    <section class="join_us_wrapper">
        <div class="container">
            <div class="choose_club_info">
                <div class="choose_club_info_title">
                    <div class="title">
                        Присоединяйтесь!
                    </div>
                    <div class="main_descr">
                        И вместе с вами мы создадим будущее бизнеса и культуры компьютерных клубов.
                    </div>
                    <div class="btn_wrapper">
                        <a href="<?= Auth::guest() ? url('register_club') : url('personal/clubs') ?>?action=add_club">Я - представитель клуба</a>
                        <a class="secondary" href="#">Я выбираю компьютерный клуб</a>
                    </div>
                </div>
                <div class="choose_club_info_img">
                    <img src="{{ asset('/img/en.png')}}" alt="image">
                </div>
            </div>
        </div>
    </section>
    <!--SECTION MAIN PAGE JOIN US END-->
@endsection
