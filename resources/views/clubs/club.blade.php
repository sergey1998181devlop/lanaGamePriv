@extends('layouts.app')
@section('page')
    <title>{{$club->club_name}} - LanGame</title>
@endsection
@section('content')
    <section class="club_page_main_info_wrapper" data-track-sticky>
        <div class="container">
            @if(isset($comments))
                <div class="club_comments">
                    @foreach($comments as $comment)
                        <div class="comment">
                            <div class="comment-header">
                                {{timelabe($comment->created_at)}}
                                @if(admin())
                                    Написал
                                    {{$comment->user->name}}
                                @endif
                            </div>
                            <div class="comment-content">
                                {{$comment->comment}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="club_page_main_info_top">
                <div class="main_info_title approve">
                    <span>{{$club->club_name}}</span>
                </div>

                <div class="main_info_btn_wrapper">
                    @if($club->published_at == null && admin())
                        <a href="{{url('club/'.$club->id.'/active')}}" class="club_active btn">Активировать</a>
                        <button type="button" class="club_comment" data-remodal-target="club_comment_modal">Написать коммент</button>
                    @endif
                    <button type="button" class="club_calling" data-remodal-target="club_phone_modal">Позвонить</button>

                </div>
            </div>
            <div class="club_page_main_info_bottom">
                @if($club->published_at != null)
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
                @endif
                @if($club->club_metro != null && $club->metro != null)
                    <div class="club_subway_wrapper">
                        <div class="subway_img_wrapper" style="--subway-color: #{{$club->metro->color}}">
                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                            </svg>
                        </div>
                        <div class="subway_station">
                            <span>{{$club->metro->name}}</span>
                            <span class="subway_time_to">(1 мин.)</span>
                        </div>
                    </div>
                @endif
                <div class="club_address_wrapper">
                    <div class="address_img_wrapper">
                        <img src="{{asset('/img/point-red.svg')}}" alt="location">
                    </div>
                    <div class="club_address">
                        {{$club->club_address}}
                    </div>
                </div>
                <div class="club_distance">
                    <img src="{{asset('/img/walk-black.svg')}}" alt="icon">
                    <span>5 км. от вас</span>
                </div>
            </div>
        </div>
    </section>

    <section class="club_page_content_wrapper">
        <div class="club_page_photo_wrapper">
            <div class="container">
                <div class="club_page_photo_list">
                    <?php
                    $images = array_filter(explode(',', $club->club_photos));
                    foreach ($images as $value) {
                    ?>
                    <div class="club_page_photo_item">
                        <img src="{{$value}}" alt="image">
                    </div>
                    <?
                    }?>

                        <button type="button" class="@if(count($images) < 5) hidden-lg @endif" data-remodal-target="club_photo_modal">Показать все фото</button>

                </div>
            </div>
        </div>

        <div class="club_page_services_wrapper">
            <div class="container">
                <div class="club_page_title">
                    <span>Услуги</span>
                </div>
                <div class="club_page_services_list mob_toggle">
                    <div class="club_page_services_item">
                        <img src="{{asset('/img/icons/pc.svg')}}" alt="icons">
                        <span>{{$club->qty_pc}} компьютеров</span>
                    </div>
                    @if($club->console == '1')
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/playstation.svg')}}" alt="icons">
                            <span>{{$club->qty_console}} консоли {{$club->console_type}}</span>
                        </div>
                    @endif
                    @if($club->qty_vip_pc > 0)
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/vip-black.svg')}}" alt="icons">
                            <span>{{$club->qty_vip_pc}} компьютеров</span>
                        </div>
                    @endif
                    @if($club->qty_simulator > 0)
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/drive.svg')}}" alt="icons">
                            <span>{{$club->qty_simulator}} устройства</span>
                        </div>
                    @endif
                    @if($club->qty_vr > 0)
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/vr.svg')}}" alt="icons">
                            <span>{{$club->qty_vr}} устройства</span>
                        </div>
                    @endif

                    @if($club->food_drinks == '1')
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/club-fastfood.svg')}}" alt="icons">
                            <span>Горячее питание</span>
                        </div>
                    @endif
                    @if($club->hookah == '1')
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/hook.svg')}}" alt="icons">
                            <span>Кальян</span>
                        </div>
                    @endif
                    @if($club->alcohol == '1')
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/alcohol.svg')}}" alt="icons">
                            <span>Алкоголь</span>
                        </div>
                    @endif
                    @if($club->bathroom == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/toilet.svg')}}" alt="icons">
                            <span>Санузел</span>
                        </div>
                    @endif
                    @if($club->checkroom == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/cloakroom.svg')}}" alt="icons">
                            <span>Гардероб</span>
                        </div>
                    @endif
                    @if($club->conditioner == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/wpf.svg')}}" alt="icons">
                            <span>Кондиционер</span>
                        </div>
                    @endif
                    @if($club->print == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/printer.svg')}}" alt="icons">
                            <span>Принтер</span>
                        </div>
                    @endif
                    @if($club->streamer == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/record.svg')}}" alt="icons">
                            <span>Стримерская</span>
                        </div>
                    @endif
                    @if($club->club_account == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/account1.svg')}}" alt="icons">
                            <span>Клубные аккаунты</span>
                        </div>
                    @endif
                    @if($club->download_app == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/download.svg')}}" alt="icons">
                            <span>Можно скачивать игры и приложения</span>
                        </div>
                    @endif
                    @if($club->smoke == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/smoke.svg')}}" alt="icons">
                            <span>Можно курить вейпы, электронные сигареты</span>
                        </div>
                    @endif
                    @if($club->with_own_device == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/keyboard.svg')}}" alt="icons">
                            <span>Можно со своими девайсами</span>
                        </div>
                    @endif
                    @if($club->with_own_food == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/fastfood.svg')}}" alt="icons">
                            <span>Можно со своей едой</span>
                        </div>
                    @endif
                    <button class="club_services_mobile_toggle"></button>
                </div>
            </div>
        </div>
        <div class="club_page_prices_wrapper">
            <div class="container">
                <div class="club_page_title">
                    <span>Цены</span>
                </div>
                <div class="club_page_prices">
                    <div class="club_page_min_price">
                        Стоимость аренды от {{$club->club_min_price}}₽/час
                    </div>
                    <!-- <button type="button" class="show_price_list" data-remodal-target="club_price_list_modal">Посмотреть прайс-лист</button> -->
                    @if($club->club_price_file != null && $club->club_price_file != '')
                        <a href="{{$club->club_price_file}}" action="_blank" class="show_price_list">Посмотреть прайс-лист</a>
                    @endif
                </div>
            </div>
        </div>
        @if($club->marketing_event == '1')
            <? $events = unserialize($club->marketing_event_descr);?>
            @if(is_array($events))
                <div class="club_page_marketing_event_wrapper">
                    <div class="container">
                        <div class="marketing_event_title">
                            <span>Акции</span>
                        </div>

                        <div class="club_page_marketing_event_list">

                            <ul>
                                @foreach($events as $event)
                                    <li>{{$event}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <div class="club_page_payment_wrapper">
            <div class="container">
                <div class="club_page_payment_title">
                    <span>Cпособы оплаты</span>
                </div>
                <div class="club_page_payment_list">
                    <?php
                    $payment_list = array_filter(explode(',', $club->payment_methods));
                    foreach ($payment_list as $value) {?>

                    <div class="club_page_payment_item">
                        <span>{{ __('messages.'.$value) }}</span>
                    </div>
                    <? }?>
                </div>
            </div>
        </div>
        <?php
        $configuration = unserialize($club->configuration);
        $configurationAr = [];
        ?>
        @if(is_array( $configuration))
            <div class="club_page_pc_configuration_wrapper toggle_block_wrapper">
                <div class="container">
                    <div class="club_page_title club_page_toggle_content">
                        <span>Конфигурация компьютеров</span>
                    </div>

                    <div class="club_page_pc_configuration_list toggle_block">
                        <div class="table_wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Оборудование</th>
                                        @foreach($configuration as $val)
                                            <th>{{isset($val['conf_name'])? $val['conf_name'] : null}}</th>
                                            <? foreach ($val as $key => $value) {
                                                $configurationAr[$key][] = $value;
                                            }?>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Процессор</td>
                                        @foreach($configurationAr['cpu_vendor'] as $key=>$val)
                                            <td>{{$val}} {{$configurationAr['cpu_model'][$key]}}</td>
                                        @endforeach

                                    </tr>
                                    <tr>
                                        <td>Видеокарта</td>
                                        @foreach($configurationAr['video_vendor'] as $key=>$val)
                                            <td>{{$val}} {{$configurationAr['video_model'][$key]}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Оперативная память</td>
                                        @foreach($configurationAr['memory_size'] as $key=>$val)
                                            <td>{{$val}} {{$configurationAr['memory_type'][$key]}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Жёсткий диск</td>
                                        @foreach($configurationAr['hard_disc_type'] as $val)
                                            <td>{{$val}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Клавиатура</td>
                                        @foreach($configurationAr['keyboard_vendor'] as $val)
                                            <td>{{$val}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Мышь</td>
                                        @foreach($configurationAr['mouse_vendor'] as $val)
                                            <td>{{$val}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Гарнитура</td>
                                        @foreach($configurationAr['headphone_vendor'] as $val)
                                            <td>{{$val}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Кресло</td>
                                        @foreach($configurationAr['chair_vendor'] as $val)
                                            <td>{{$val}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Монитор</td>
                                        @foreach($configurationAr['monitor_vendor'] as $key=>$val)
                                            <td>{{$val}} {{$configurationAr['monitor_type'][$key]}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Интернет</td>
                                        @foreach($configurationAr['internet'] as $val)
                                            <td>{{$val}}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if($club->lat!= '' && $club->lon!= '')
        <div class="club_page_map_wrapper">
            <div class="container">
                <div class="club_page_title">
                    <span>Расположение</span>
                </div>
                <div class="club_page_map" id="club_page_maps"></div>
            </div>
        </div>
        @endif
        <div class="club_page_reviews_wrapper">
            <div class="container">
                <div class="club_page_title">
                    <span>Отзывы</span>
                </div>
                <div class="club_page_reviews">
                    <div class="club_page_reviews_list">
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                        <div class="club_page_reviews_item">
                            <div class="user_info">
                                <div class="user_avatar">
                                    <img src="{{asset('/img/avatar.svg')}}" alt="avatar">
                                </div>
                                <div class="user_name">
                                    Федор Лукин
                                </div>
                            </div>
                            <div class="rating_wrapper">
                                <div class="rating_stars">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                    <img src="{{asset('/img/star.svg')}}" alt="star">
                                </div>
                            </div>
                            <div class="review_content_wrapper">
                                <div class="review_content">
                                    Мощная аппаратура, тянет все игры, часто здесь бываю и один, и с компанией.
                                    Отличный вариант отдыха после работы для любителей игр.
                                    Располагающая атмосфера, приятный персонал, много единомышленников, даже если пришёл один
                                    - без компании не останешься. Мне нравится бывать в этом клубе, цены не завышены.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @if($club->club_description != '')
        <div class="club_page_description_wrapper">
            <div class="container">
                <div class="club_page_title">
                    <span>Описание</span>
                </div>
                <div class="club_page_description">
                    <p>
                        {{$club->club_description}}
                    </p>
                </div>
            </div>
        </div>
        @endif
        <div class="club_page_contacts_wrapper toggle_block_wrapper">
            <div class="container">
                <div class="club_page_title club_page_toggle_content">
                    <span>Контактная информация</span>
                </div>
                <div class="club_page_contacts_list toggle_block">
                    <div class="club_page_contacts_list_title">График работы</div>
                    <div class="club_page_schedule">
                        @if($club->work_time == '1')
                            <div class="club_page_schedule_item">
                                <span>Круглосуточно</span>
                            </div>
                        @else
                            <?php
                            $schedule_item = unserialize($club->work_time_days);
                            ?>
                            @if(is_array($schedule_item))
                                <div class="club_page_schedule_item">
                                    <span>Понедельник</span>
                                    <span>{{isset($schedule_item['monday']) ? $schedule_item['monday']['from'].'-'.$schedule_item['monday']['to'] : 'Закрыт'}}</span>
                                </div>
                                <div class="club_page_schedule_item">
                                    <span>Вторник</span>
                                    <span>{{isset($schedule_item['tuesday']) ? $schedule_item['tuesday']['from'].'-'.$schedule_item['tuesday']['to'] : 'Закрыт'}}</span>
                                </div>
                                <div class="club_page_schedule_item">
                                    <span>Среда</span>
                                    <span>{{isset($schedule_item['wednesday']) ? $schedule_item['wednesday']['from'].'-'.$schedule_item['wednesday']['to'] : 'Закрыт'}}</span>
                                </div>
                                <div class="club_page_schedule_item">
                                    <span>Четверг</span>
                                    <span>{{isset($schedule_item['thursday']) ? $schedule_item['thursday']['from'].'-'.$schedule_item['thursday']['to'] : 'Закрыт'}}</span>
                                </div>
                                <div class="club_page_schedule_item">
                                    <span>Пятница</span>
                                    <span>{{isset($schedule_item['friday']) ? $schedule_item['friday']['from'].'-'.$schedule_item['friday']['to'] : 'Закрыт'}}</span>
                                </div>
                                <div class="club_page_schedule_item">
                                    <span>Суббота</span>
                                    <span>{{isset($schedule_item['saturday']) ? $schedule_item['saturday']['from'].'-'.$schedule_item['saturday']['to'] : 'Закрыт'}}</span>
                                </div>
                                <div class="club_page_schedule_item">
                                    <span>Воскресенье</span>
                                    <span>{{isset($schedule_item['sunday']) ? $schedule_item['sunday']['from'].'-'.$schedule_item['sunday']['to'] : 'Закрыт'}}</span>
                                </div>
                            @endif
                        @endif

                    </div>
                    <div class="club_page_contacts_list_title">Контакты</div>
                    <div class="club_page_contacts_item">

                        <div class="club_city">
                            <span>{{$club->city->name}}</span>
                        </div>
                    </div>
                    <div class="club_page_contacts_item">
                        @if($club->club_metro != null && $club->metro != null)
                            <div class="club_subway_wrapper">
                                <div class="subway_img_wrapper" style="--subway-color: #{{$club->metro->color}}">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                                    </svg>
                                </div>
                                <div class="subway_station">
                                    <span>{{$club->metro->name}}</span>
                                    <span class="subway_time_to">(1 мин.)</span>
                                </div>
                            </div>
                        @endif
                        <div class="club_address_wrapper">
                            <div class="address_img_wrapper">
                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                            </div>
                            <div class="club_address">
                                {{$club->club_address}}
                            </div>
                        </div>
                    </div>
                    <div class="club_page_contacts_item">
                        <div class="club_contact">
                            <img src="{{asset('/img/phone.svg')}}" alt="phone">
                            <a href="tel:{{$club->phone}}">{{$club->phone}}</a>
                        </div>
                    </div>
                    @if($club->club_email != '')
                    <div class="club_page_contacts_item">
                        <div class="club_contact">
                            <img src="{{asset('/img/mail.svg')}}" alt="email">
                            <a href="mailto:{{$club->club_email}}">{{$club->club_email}}</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="bottom_nav_mobile">
        <div class="container">
            <div class="club_price_wrapper">
                <div class="club_price">Аренда от {{$club->club_min_price}} ₽/час</div>
                <button type="button" class="club_calling" data-remodal-target="club_phone_modal">Позвонить</button>
            </div>
        </div>
    </section>
    <div class="remodal show_club_phone_modal" data-remodal-id="club_phone_modal" data-remodal-options="hashTracking: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="remodal-content">
            <div class="club_phone_wrapper">
                <p>{{$club->phone}}</p>
            </div>
        </div>
    </div>

    @if($club->published_at == null && admin())
        <div class="club_comment_modal remodal admin_modal" id="club_comment_modal" data-remodal-id="club_comment_modal">
            <button data-remodal-action="close" class="remodal-close">Закрыть</button>
            <div class="remodal-content">
                <form action="{{url('club/')}}/{{$club->id}}/comment" method="post" style="dispaly:inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="club_id" value="{{$club->id}}">
                    <div class="modal-header">
                        <h4 class="modal-title">Написать коммент</h4>
                    </div>
                    <div class="modal-body">
                        Напишите коммент
                        <div class="textarea-holder">
                            <textarea name="comment" cols="30" rows="10" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Отправить</button>
            </div>
        </div>

    @endif


<div class="show_club_photo_modal" data-remodal-id="club_photo_modal">
    <button data-remodal-action="close" class="remodal-close">Закрыть</button>
    <div class="remodal-content">
        <div class="counter_slide" id="show_club_photo_counter_slide">
            1/10
        </div>
        <div class="club_photo_modal_wrapper">
        @foreach ($images as $value)
            <div class="slide_item">
                <img src="{{$value}}" alt="club_image">
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
@if($club->lat!= '' && $club->lon!= '')
<script src="https://api-maps.yandex.ru/2.1/?apikey=79ca1998-f254-447d-8081-bcd9647a8fb9&lang=ru_RU" type="text/javascript"></script>
<script>
ymaps.ready(init);
    function init() {
    var myMap = new ymaps.Map("club_page_maps", {
            center: [{{$club->lat}}, {{$club->lon}}],
            zoom: 12
        });
        myMap.geoObjects
            .add(new ymaps.Placemark([{{$club->lat}}, {{$club->lon}}],  {
                preset: 'islands#dotIcon',
                iconColor: '#735184'
            }));
    }

</script>
@endif
@endsection
