@extends('layouts.app')
@section('page')
<title>Список клубов - LanGame</title>
@endsection
@section('content')


<!--SECTION PERSONAL PAGE START-->
<section class="personal_page_wrapper">
    <div class="container-fluid">
        <div class="personal_page">
            <div class="personal_menu_wrapper">
                <h2>Личный кабинет</h2>
                <div class="personal_menu">
                    <a href="{{url('personal/profile')}}">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-account"></use>
                        </svg>
                        <span>Профиль</span>
                    </a>
                    <a href="{{url('personal/clubs')}}" class="active">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-file"></use>
                        </svg>
                        <span>Список клубов</span>
                    </a>
                    <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="exit">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-cancel"></use>
                        </svg>
                        <span>Выйти</span>
                        
                    </a>                    
                </div>
            </div>
            <div class="personal_main_content_wrapper">
                <div class="club_list_navigation_wrapper">
                    <ul class="club_list_navigation_tabs">
                        <li>
                            <a href="#tab1" class="active">
                                <span>Опубликованные</span>
                                <span class="qty">2</span>
                            </a>
                        </li>
                        <li><a href="#tab2">
                                <span>На модерации</span>
                                <span class="qty">1</span>
                            </a>
                        </li>
                        <li><a href="#tab3">
                                <span>Черновики</span>
                                <span class="qty">1</span>
                            </a>
                        </li>
                    </ul>
                    <div class="btn_wrapper">
                        <div class="club_list_title">Список клубов</div>
                        <button type="button" class="add_club" data-remodal-target="add_club_modal">Добавить</button>
                    </div>
                </div>

                <div class="club_list_content_tabs">
                    <div class="tab" id="tab1">
                        <div class="club_list_content">
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <form action="" method="post" class="hide-from-search-form">
                                            <div class="checkbox_wrapper">
                                                <label>
                                                    <input type="checkbox" name="hide_from_search">
                                                    <span class="activator"><span></span></span>
                                                    <span>Скрыть из поиска</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <form action="" method="post" class="hide-from-search-form">
                                            <div class="checkbox_wrapper">
                                                <label>
                                                    <input type="checkbox" name="hide_from_search">
                                                    <span class="activator"><span></span></span>
                                                    <span>Скрыть из поиска</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <form action="" method="post" class="hide-from-search-form">
                                            <div class="checkbox_wrapper">
                                                <label>
                                                    <input type="checkbox" name="hide_from_search">
                                                    <span class="activator"><span></span></span>
                                                    <span>Скрыть из поиска</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <form action="" method="post" class="hide-from-search-form">
                                            <div class="checkbox_wrapper">
                                                <label>
                                                    <input type="checkbox" name="hide_from_search">
                                                    <span class="activator"><span></span></span>
                                                    <span>Скрыть из поиска</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <form action="" method="post" class="hide-from-search-form">
                                            <div class="checkbox_wrapper">
                                                <label>
                                                    <input type="checkbox" name="hide_from_search">
                                                    <span class="activator"><span></span></span>
                                                    <span>Скрыть из поиска</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <form action="" method="post" class="hide-from-search-form">
                                            <div class="checkbox_wrapper">
                                                <label>
                                                    <input type="checkbox" name="hide_from_search">
                                                    <span class="activator"><span></span></span>
                                                    <span>Скрыть из поиска</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <form action="" method="post" class="hide-from-search-form">
                                            <div class="checkbox_wrapper">
                                                <label>
                                                    <input type="checkbox" name="hide_from_search">
                                                    <span class="activator"><span></span></span>
                                                    <span>Скрыть из поиска</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <form action="" method="post" class="hide-from-search-form">
                                            <div class="checkbox_wrapper">
                                                <label>
                                                    <input type="checkbox" name="hide_from_search">
                                                    <span class="activator"><span></span></span>
                                                    <span>Скрыть из поиска</span>
                                                </label>
                                            </div>
                                        </form>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab" id="tab2" style="display: none">
                        <div class="club_list_content moderation">
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <div class="club_status_wrapper">
                                            <img src="{{asset('/img/time-slot.svg')}}" alt="icon">
                                            <span>На модерации</span>
                                        </div>
                                        <div class="club_price_wrapper">
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab" id="tab3" style="display: none">
                        <div class="club_list_content">
                            <div class="club_list_item">
                                <a href="#" class="club_card">
                                    <div class="search_club_img_wrapper">
                                        <div class="search_club_img">
                                            <img src="{{asset('/img/club6.png')}}" alt="club">
                                        </div>
                                        <div class="club_services">
                                            <img src="{{asset('/img/vip.svg')}}" alt="icon">
                                            <img src="{{asset('/img/fastfood.svg')}}" alt="icon">
                                            <img src="{{asset('/img/drink.svg')}}" alt="icon">
                                        </div>
                                        <div class="club_distance">
                                            <img src="{{asset('/img/walk.svg')}}" alt="icon">
                                            <span>5 км. от вас</span>
                                        </div>
                                        <div class="club_promotion">
                                            <span>Акция</span>
                                        </div>
                                    </div>
                                    <div class="search_club_info">
                                        <div class="club_name">
                                            <span>F5 - Центр Киберспорта</span>
                                        </div>
                                        <div class="rating_wrapper">
                                            <div class="rating_stars">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star.svg')}}" alt="star">
                                                <img src="{{asset('/img/star0.svg')}}" alt="star">
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
                                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                                            </div>
                                            <div class="club_address">
                                                Ленинградский проспект 71КБ
                                            </div>
                                        </div>
                                        <div class="club_status_wrapper">
                                            <img src="{{asset('/img/draft.svg')}}" alt="icon">
                                            <span>Черновик</span>
                                        </div>
                                        <div class="club_price_wrapper">
                                            <div class="club_price"></div>
                                            <div class="club_edit">Редактировать</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--SECTION PERSONAL PAGE END-->
@include("personal.modals")

@endsection

@section('scripts')
@if(isset($_GET['action']) && $_GET['action'] == 'add_club')
<script>
    $( document ).ready(function(){
        $('[data-remodal-target="add_club_modal"]').click();
    })

</script>
@endif
@endsection