@extends('layouts.app')
@section('page')
<title>LanGame</title>
@endsection
@section('content')

<!--SECTION CHOOSE CLUB INFO START-->
<section class="choose_club_info_wrapper">
    <div class="container">
        <div class="choose_club_info">
            <div class="choose_club_info_title">
                <h1>Выбери свой <br>
                    компьютерный клуб в <span class="text_decor">Москве</span>
                </h1>
            </div>
            <div class="choose_club_info_img">
                <img src="{{ asset('/img/choose.png')}}" alt="image">
            </div>
        </div>
    </div>
</section>
<!--SECTION CHOOSE CLUB INFO END-->

<!--SECTION SEARCH CLUB START-->
<section class="search_club_wrapper">
    <div class="container">
        <div class="search_club">
            <div class="search_club_sort_wrapper">
                <div class="search_club_sort">
                    <div class="search_club_result">
                        <span>Найдено:</span>
                        <span class="search_qty">256</span>
                    </div>
                    <div class="sort_by">
                        <div class="sort_by_title">
                            Сортировать:
                        </div>

                        <div class="sort_by_options">
                            <a href="#" class="active">По цене</a>

                            <a href="#">По рейтингу</a>

                            <a href="#">По близости</a>
                        </div>
                    </div>
                </div>
                <div class="search_club_show">
                    <div class="show_by_list">
                        <a href="#"><span>Список</span></a>
                    </div>
                    <div class="show_by_map">
                        <a href="#"><span>На карте</span></a>
                    </div>
                </div>
            </div>
            <div class="search_club_list">
                <div class="search_club_item">
                    <a href="#" class="club_card">
                        <div class="search_club_img_wrapper">
                            <div class="search_club_img">
                                <img src="{{ asset('/img/club6.png')}}" alt="club">
                            </div>
                            <div class="club_services">
                                <img src="{{ asset('/img/vip.svg')}}" alt="icon">
                                <img src="{{ asset('/img/fastfood.svg')}}" alt="icon">
                                <img src="{{ asset('/img/drink.svg')}}" alt="icon">
                            </div>
                            <div class="club_distance">
                                <img src="{{ asset('/img/walk.svg')}}" alt="icon">
                                <span>5 км. от вас</span>
                            </div>
                            <div class="club_promotion">
                                <span>Акция</span>
                            </div>
                        </div>
                        <div class="search_club_info">
                            <div class="club_name approve">
                                <span>F5 - Центр Киберспорта</span>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star0.svg')}}" alt="star">
                                </div>
                                <div class="reviews_qty">
                                    <span>47 отзывов</span>
                                </div>
                            </div>
                            <div class="club_subway_wrapper">
                                <div class="subway_img_wrapper" style="--subway-color: blue">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                                    </svg>
                                </div>
                                <div class="subway_station">
                                    <span>Сокол</span>
                                    <span class="subway_time_to">(1 мин.)</span>
                                </div>
                            </div>
                            <div class="club_address_wrapper">
                                <div class="address_img_wrapper">
                                    <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                                </div>
                                <div class="club_address">
                                    Ленинградский проспект 71КБ
                                </div>
                            </div>
                            <div class="club_features_wrapper">
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/pc.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/playstation.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/vr.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/drive.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                            <div class="club_price_wrapper">
                                <div class="club_price">от 80 ₽/час</div>
                                <div class="club_booking">Забронировать</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="search_club_item">
                    <a href="#" class="club_card">
                        <div class="search_club_img_wrapper">
                            <div class="search_club_img">
                                <img src="{{ asset('/img/club6.png')}}" alt="club">
                            </div>
                            <div class="club_services">
                                <img src="{{ asset('/img/vip.svg')}}" alt="icon">
                                <img src="{{ asset('/img/fastfood.svg')}}" alt="icon">
                                <img src="{{ asset('/img/drink.svg')}}" alt="icon">
                            </div>
                            <div class="club_distance">
                                <img src="{{ asset('/img/walk.svg')}}" alt="icon">
                                <span>5 км. от вас</span>
                            </div>
                            <div class="club_promotion">
                                <span>Акция</span>
                            </div>
                        </div>
                        <div class="search_club_info">
                            <div class="club_name approve">
                                <span>F5 - Центр Киберспорта</span>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star0.svg')}}" alt="star">
                                </div>
                                <div class="reviews_qty">
                                    <span>47 отзывов</span>
                                </div>
                            </div>
                            <div class="club_subway_wrapper">
                                <div class="subway_img_wrapper">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                                    </svg>
                                </div>
                                <div class="subway_station">
                                    <span>Сокол</span>
                                    <span class="subway_time_to">(1 мин.)</span>
                                </div>
                            </div>
                            <div class="club_address_wrapper">
                                <div class="address_img_wrapper">
                                    <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                                </div>
                                <div class="club_address">
                                    улица Для того, чтобы показать, что карточка может в две строки :)
                                </div>
                            </div>
                            <div class="club_features_wrapper">
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/pc.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/playstation.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/vr.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/drive.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                            <div class="club_price_wrapper">
                                <div class="club_price">от 80 ₽/час</div>
                                <div class="club_calling">Позвонить</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="search_club_item">
                    <a href="#" class="club_card">
                        <div class="search_club_img_wrapper">
                            <div class="search_club_img">
                                <img src="{{ asset('/img/club6.png')}}" alt="club">
                            </div>
                            <div class="club_services">
                                <img src="{{ asset('/img/vip.svg')}}" alt="icon">
                                <img src="{{ asset('/img/fastfood.svg')}}" alt="icon">
                                <img src="{{ asset('/img/drink.svg')}}" alt="icon">
                            </div>
                            <div class="club_distance">
                                <img src="{{ asset('/img/walk.svg')}}" alt="icon">
                                <span>5 км. от вас</span>
                            </div>
                            <div class="club_promotion">
                                <span>Акция</span>
                            </div>
                        </div>
                        <div class="search_club_info">
                            <div class="club_name approve">
                                <span>F5 - Центр Киберспорта</span>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star0.svg')}}" alt="star">
                                </div>
                                <div class="reviews_qty">
                                    <span>47 отзывов</span>
                                </div>
                            </div>
                            <div class="club_subway_wrapper">
                                <div class="subway_img_wrapper">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                                    </svg>
                                </div>
                                <div class="subway_station">
                                    <span>Сокол</span>
                                    <span class="subway_time_to">(1 мин.)</span>
                                </div>
                            </div>
                            <div class="club_address_wrapper">
                                <div class="address_img_wrapper">
                                    <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                                </div>
                                <div class="club_address">
                                    Ленинградский проспект 71КБ
                                </div>
                            </div>
                            <div class="club_features_wrapper">
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/pc.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/playstation.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/vr.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/drive.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                            <div class="club_price_wrapper">
                                <div class="club_price">от 80 ₽/час</div>
                                <div class="club_close">Закрыто</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="search_club_item">
                    <a href="#" class="club_card">
                        <div class="search_club_img_wrapper">
                            <div class="search_club_img">
                                <img src="{{ asset('/img/club6.png')}}" alt="club">
                            </div>
                            <div class="club_services">
                                <img src="{{ asset('/img/vip.svg')}}" alt="icon">
                                <img src="{{ asset('/img/fastfood.svg')}}" alt="icon">
                                <img src="{{ asset('/img/drink.svg')}}" alt="icon">
                            </div>
                            <div class="club_distance">
                                <img src="{{ asset('/img/walk.svg')}}" alt="icon">
                                <span>5 км. от вас</span>
                            </div>
                            <div class="club_promotion">
                                <span>Акция</span>
                            </div>
                        </div>
                        <div class="search_club_info">
                            <div class="club_name approve">
                                <span>F5 - Центр Киберспорта</span>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star0.svg')}}" alt="star">
                                </div>
                                <div class="reviews_qty">
                                    <span>47 отзывов</span>
                                </div>
                            </div>
                            <div class="club_subway_wrapper">
                                <div class="subway_img_wrapper">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                                    </svg>
                                </div>
                                <div class="subway_station">
                                    <span>Сокол</span>
                                    <span class="subway_time_to">(1 мин.)</span>
                                </div>
                            </div>
                            <div class="club_address_wrapper">
                                <div class="address_img_wrapper">
                                    <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                                </div>
                                <div class="club_address">
                                    улица Для того, чтобы показать, что карточка может в две строки :)
                                </div>
                            </div>
                            <div class="club_features_wrapper">
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/pc.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/playstation.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/vr.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/drive.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                            <div class="club_price_wrapper">
                                <div class="club_price">от 80 ₽/час</div>
                                <div class="club_calling">Позвонить</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="search_club_item">
                    <a href="#" class="club_card">
                        <div class="search_club_img_wrapper">
                            <div class="search_club_img">
                                <img src="{{ asset('/img/club6.png')}}" alt="club">
                            </div>
                            <div class="club_services">
                                <img src="{{ asset('/img/vip.svg')}}" alt="icon">
                                <img src="{{ asset('/img/fastfood.svg')}}" alt="icon">
                                <img src="{{ asset('/img/drink.svg')}}" alt="icon">
                            </div>
                            <div class="club_distance">
                                <img src="{{ asset('/img/walk.svg')}}" alt="icon">
                                <span>5 км. от вас</span>
                            </div>
                            <div class="club_promotion">
                                <span>Акция</span>
                            </div>
                        </div>
                        <div class="search_club_info">
                            <div class="club_name approve">
                                <span>F5 - Центр Киберспорта</span>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star0.svg')}}" alt="star">
                                </div>
                                <div class="reviews_qty">
                                    <span>47 отзывов</span>
                                </div>
                            </div>
                            <div class="club_subway_wrapper">
                                <div class="subway_img_wrapper">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                        </svg>
                                </div>
                                <div class="subway_station">
                                    <span>Сокол</span>
                                    <span class="subway_time_to">(1 мин.)</span>
                                </div>
                            </div>
                            <div class="club_address_wrapper">
                                <div class="address_img_wrapper">
                                    <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                                </div>
                                <div class="club_address">
                                    улица Для того, чтобы показать, что карточка может в две строки :)
                                </div>
                            </div>
                            <div class="club_features_wrapper">
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/pc.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/playstation.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/vr.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/drive.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                            <div class="club_price_wrapper">
                                <div class="club_price">от 80 ₽/час</div>
                                <div class="club_calling">Позвонить</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="search_club_item">
                    <a href="#" class="club_card">
                        <div class="search_club_img_wrapper">
                            <div class="search_club_img">
                                <img src="{{ asset('/img/club6.png')}}" alt="club">
                            </div>
                            <div class="club_services">
                                <img src="{{ asset('/img/vip.svg')}}" alt="icon">
                                <img src="{{ asset('/img/fastfood.svg')}}" alt="icon">
                                <img src="{{ asset('/img/drink.svg')}}" alt="icon">
                            </div>
                            <div class="club_distance">
                                <img src="{{ asset('/img/walk.svg')}}" alt="icon">
                                <span>5 км. от вас</span>
                            </div>
                            <div class="club_promotion">
                                <span>Акция</span>
                            </div>
                        </div>
                        <div class="search_club_info">
                            <div class="club_name approve">
                                <span>F5 - Центр Киберспорта</span>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star.svg')}}" alt="star">
                                    <img src="{{ asset('/img/star0.svg')}}" alt="star">
                                </div>
                                <div class="reviews_qty">
                                    <span>47 отзывов</span>
                                </div>
                            </div>
                            <div class="club_subway_wrapper">
                                <div class="subway_img_wrapper" style="--subway-color: red">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                                    </svg>
                                </div>
                                <div class="subway_station">
                                    <span>Сокол</span>
                                    <span class="subway_time_to">(1 мин.)</span>
                                </div>
                            </div>
                            <div class="club_address_wrapper">
                                <div class="address_img_wrapper">
                                    <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                                </div>
                                <div class="club_address">
                                    улица Для того, чтобы показать, что карточка может в две строки :)
                                </div>
                            </div>
                            <div class="club_features_wrapper">
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/pc.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/playstation.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/vr.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                                <div class="club_features_item">
                                    <div class="club_features_img_wrapper">
                                        <img src="{{ asset('/img/drive.svg')}}" alt="icon">
                                    </div>
                                    <div class="club_features_qty">
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                            <div class="club_price_wrapper">
                                <div class="club_price">от 80 ₽/час</div>
                                <div class="club_calling">Позвонить</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <a href="#" class="show_more">Показать ещё</a>
        </div>
    </div>
</section>
<!--SECTION SEARCH CLUB END-->
@if(isset( $posts) && count($posts)>0)
<!--SECTION ARTICLES START-->
<section class="articles_wrapper">
    <div class="container">
        <h2>Статьи</h2>
        <div class="articles">
            <div class="articles_list">
            @foreach($posts as $post)
          
          <div class="articles_item">
                    <a href="{{url('post/read/'.$post->id.'/'.$post->url)}}">
                        <div class="article_img_wrapper">
                            <img src="{{url('../storage/app/public/posts/'.$post->image)}}" alt="club">
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
                <a href="{{url('posts')}}" class="show_more">Смотреть все</a>
            @endif
        </div>
    </div>
</section>
<!--SECTION ARTICLES END-->
@endif
@endsection