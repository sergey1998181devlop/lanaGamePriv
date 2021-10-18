@extends('layouts.app')
@section('page')
    <title>Компьютерный клуб {{$club->club_name}} {{$club->city["name"]}} - цены, отзывы, обзоры</title>
    <meta name="description" content="Компьютерный клуб {{$club->club_name}} по адресу {{$club->club_full_address}} - расположение, цены, отзывы, рейтинг ({{$club->rating }} из 5), честные обзоры, новости, ближайшие мероприятия">
    <meta name="keywords" content="компьютерный клуб {{$club->club_name}}, интернет кафе {{$club->club_name}}, киберклуб {{$club->club_name}}, {{$club->city["name"]}}"/>

    <style>
        .comment{
            position: relative;
        }
        .comment button[data-role-remove-comment]{
            position: absolute;
            top: -7px;
            right: -7px;
            display: block;
            width: 20px;
            height: 20px;
            background-image: url(../img/cancel.svg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: 24px 24px;
            background-color: #fff;
            border: 0;
            border-radius: 50%;
            outline: 0;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <?php
    if ($club->work_time == '2') {
        $schedule_item = unserialize($club->work_time_days);
    }

    $youtubeVideoUrl = null;
    $youtubeImageUrl = null;

    if (\preg_match('#^https://youtu\.be/(.+)#', $club->club_youtube_link ?: '', $matches)) {
        $youtubeVideoUrl = "https://www.youtube.com/embed/{$matches[1]}";
        $youtubeImageUrl = "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg";
    } elseif (\preg_match('#^https://www\.youtube\.com/watch\?v=(.+)#', $club->club_youtube_link ?: '', $matches)) {
        $youtubeVideoUrl = "https://www.youtube.com/embed/{$matches[1]}";
        $youtubeImageUrl = "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg";
    }
    ?>
    <section class="club_page_main_info_wrapper" data-track-sticky>
        <div class="container">
            @if(isset($comments))
                <div class="club_comments">
                    @foreach($comments as $comment)
                        <div class="comment">
                            @if(admin())
                                <button type="button" data-role-remove-comment data-id="{{$comment->id}}"></button>
                            @endif
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
                    <button class="report" data-remodal-target="report_club_modal">
                        <img src="{{asset('/img/icons/wrmsg.svg')}}" alt="">
                    </button>
                </div>

                <div class="main_info_btn_wrapper">
                    @if($club->deleted_at != null)
                    <a
                           style="background:#ff6328;border: 2px solid black;color:#000;margin-right: 5px;font-size: 14px;    cursor: auto;"
                           class="btn">Клуб удален</a>
                        <a href="{{url('panel/club/'.$club->id.'/recover')}}"
                           style="background:#5a985a;color:#000;margin-right: 5px;font-size: 14px;"
                           class="btn">Вернуть</a>
                    @endif
                    @if(admin()  && $club->deleted_at == null)
                        <a href="{{url('personal/club/'.$club->id.'/edit')}}"
                           style="background:#cb8e20;color:#000;margin-right: 5px;font-size: 14px;"
                           class="btn"
                           data-remodal-target="change_user_modal"  data-remodal-options="hashTracking: false">Сменить владелеца</a>
                    @endif
                    @if($club->published_at == null && admin() && $club->deleted_at == null)
                        <a href="{{url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city["en_name"].'/active')}}" class="club_active btn">Опубликовать</a>
                        <button type="button" class="club_comment" data-remodal-target="club_comment_modal">Написать коммент</button>
                    @endif
                    @if(admin())
                    <a href="{{url('personal/club/'.$club->id.'/edit')}}" style="background:#1f42ff;color:#fff;margin-right: 5px;" class="btn">Редактировать</a>
                    @endif
                    @if(admin() && $club->published_at != null &&  $club->deleted_at == null)
                        <a href="{{url('personal/club/'.$club->id.'/edit')}}"
                           style="background:#a0a0a0;color:#fff;margin-right: 5px;"
                           data-remodal-target="club_comment_modal"
                           class="btn">Снять с публикации</a>
                    @endif
                    @if($club->closed == '1')
                        <button type="button" class="club_calling closed">Закрыто навсегда</button>
                    @else
                        <?php
                        $showCallButton = true;
                        if ($club->work_time == '2' && is_array($schedule_item)) {
                            if (!isset($schedule_item[strtolower(date("l"))])) {
                                $showCallButton = false;
                            } else {
                                if (!empty($schedule_item[strtolower(date("l"))]['from']) && !empty($schedule_item[strtolower(date("l"))]['to'])) {
                                    $now = new DateTime();
                                    $begin = new DateTime($schedule_item[strtolower(date("l"))]['from']);
                                    if (explode(":", $schedule_item[strtolower(date("l"))]['to'])[0]<explode(":", $schedule_item[strtolower(date("l"))]['from'])[0]){
                                        $end = new DateTime($schedule_item[strtolower(date("l"))]['to']);
                                        $end->add(new DateInterval("P1D"));
                                    }else{
                                        $end = new DateTime($schedule_item[strtolower(date("l"))]['to']);
                                    }
                                    if ($now >= $begin && $now <= $end) {
                                        $showCallButton = true;
                                    } else {
                                        $showCallButton = false;
                                    }
                                }
                            }
                        }
                        ?>
                        @if($showCallButton)
                            <button type="button" class="club_calling" data-remodal-target="club_phone_modal" onclick="ym(82365286,'reachGoal','phone');gtag('event', 'send', { 'event_category': 'phone', 'event_action': 'click' });">Позвонить</button>
                        @else
                            <button type="button" class="club_calling closed">Закрыт</button>
                        @endif
                    @endif
                </div>
            </div>
            <div class="club_page_main_info_bottom">
                @if($club->published_at != null)
                    <div class="rating_wrapper">
                        <div class="rating_stars">
                            {!!echoRating($club->rating * 10)!!}
                            <span class="rating">{{$club->rating }}</span>
                        </div>
                        @if(false)
                            <div class="reviews_qty">
                                <span>47 отзывов</span>
                            </div>
                        @endif
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
                            @if(false)
                                <span class="subway_time_to">(1 мин.)</span>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="club_address_wrapper">
                    <div class="address_img_wrapper">
                        <img src="{{asset('/img/point-red.svg')}}" alt="location">
                    </div>
                    <div class="club_address">
                        {{$club->club_full_address}}
                    </div>
                </div>
                <div class="club_distance">
                    <img src="{{asset('/img/walk-black.svg')}}" alt="icon">
                    <span>{{$club->nearby}} км</span>
                </div>
            </div>
        </div>
    </section>
    <section class="club_page_content_wrapper">
        <?php $images = array_filter(explode(',', $club->club_photos));?>
        @if(count($images) > 0)
            <div class="club_page_photo_wrapper">
                <div class="container">
                    <div class="club_page_photo_list">
                        <?php if ($youtubeVideoUrl && $youtubeImageUrl): ?>
                        <div class="club_page_photo_item club_video">
                            <a href="{{$youtubeVideoUrl}}" data-fancybox="gallery">
                                <img src="{{ $youtubeImageUrl }}" alt="">
                            </a>
                        </div>
                        <?php endif; ?>

                        <?php
                        $images = array_filter(explode(',', $club->club_photos));
                        foreach ($images as $value) {
                        ?>
                        <div class="club_page_photo_item">
                            <a href="{{$value}}" data-fancybox="gallery">
                                <img src="{{$value}}" onerror="this.src='/img/default-club-preview-image.svg'" alt="image">
                            </a>
                        </div>

                        <?php } ?>

                            <button type="button" class="@if(count($images) < 5) hidden-lg @endif" data-remodal-target="club_photo_modal">Показать все фото</button>
                    </div>
                </div>
                <span class="counter"></span>
            </div>
        @endif
        <div class="club_page_services_wrapper">
            <div class="container">
                <div class="club_page_title">
                    <span>Услуги</span>
                </div>
                <div class="club_page_services_list mob_toggle">
                    <div class="club_page_services_item">
                        <img src="{{asset('/img/icons/pc.svg')}}" alt="icons">
                        <?
                        $message = msgfmt_create('ru_RU', '{count, plural, one{# компьютер} few{# компьютера} many{# компьютеров} other{# компьютера}}');
                        ?>
                        <span>{{$message->format(['count' => $club->qty_pc]) . PHP_EOL}}</span>
                    </div>
                    @if($club->console == '1')
                        <?
                        $message = msgfmt_create('ru_RU', '{count, plural, one{# консоль} few{# консоли} many{# консолей} other{# консоли}}');
                        ?>
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/playstation.svg')}}" alt="icons">
                            <span>{{$message->format(['count' => $club->qty_console]) . PHP_EOL}} {{$club->console_type}}</span>
                        </div>
                    @endif
                    @if($club->qty_vip_pc > 0)
                        <?
                        $message = msgfmt_create('ru_RU', '{count, plural, one{# компьютер} few{# компьютера} many{# компьютеров} other{# компьютера}}');
                        ?>
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/vip-black.svg')}}" alt="icons">
                            <span>{{$message->format(['count' => $club->qty_vip_pc]) . PHP_EOL}}</span>
                        </div>
                    @endif
                    @if($club->qty_simulator > 0)
                        <?
                        $message = msgfmt_create('ru_RU', '{count, plural, one{# устройство} few{# устройства} many{# устройств} other{# устройства}}');
                        ?>
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/drive.svg')}}" alt="icons">
                            <span>{{$message->format(['count' => $club->qty_simulator]) . PHP_EOL}}</span>
                        </div>
                    @endif
                    @if($club->qty_vr > 0)
                        <?
                        $message = msgfmt_create('ru_RU', '{count, plural, one{# устройство} few{# устройства} many{# устройств} other{# устройства}}');
                        ?>
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/vr.svg')}}" alt="icons">
                            <span>{{$message->format(['count' => $club->qty_vr]) . PHP_EOL}}</span>
                        </div>
                    @endif

                    @if($club->food_drinks == '1')
                        <div class="club_page_services_item">
                            <img src="{{asset('/img/icons/club-fastfood.svg')}}" alt="icons">
                            <span>{{$club->food_drink_type}}</span>
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
                    @if($club->tsena == '1')
                        <div class="club_page_services_item mob_hide">
                            <img src="{{asset('/img/icons/tsena.svg')}}" alt="icons">
                            <span>Сцена и зрительный зал</span>
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
                    @if($club->club_price_file != null && $club->club_price_file != '')
                        @if(substr($club->club_price_file, strrpos($club->club_price_file, '.') + 1) != 'pdf')
                            <button type="button" class="show_price_list" data-remodal-target="club_price_list_modal">Посмотреть прайс-лист</button>
                        @else
                            <a href="{{$club->club_price_file}}" target="_blank" class="show_price_list">Посмотреть прайс-лист</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @if($club->marketing_event == '1' && canBeUnserialized($club->marketing_event_descr))
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
        @if(canBeUnserialized($club->configuration))
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
                                                <th>
                                                    {{isset($val['conf_name'])? $val['conf_name'] : null}}
                                                    <span class="text_decor">{{isset($val['pc_quantity'])? intval($val['pc_quantity']).' ПК' : null}}</span>
                                                </th>
                                                <? foreach ($val as $key => $value) {
                                                    $configurationAr[$key][] = $value;
                                                }?>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($configurationAr['cpu_vendor']))
                                            <tr>
                                                <td>Процессор</td>
                                                @foreach($configurationAr['cpu_vendor'] as $key=>$val)
                                                    <td>{{$val}} {{isset($configurationAr['cpu_model'][$key]) ? $configurationAr['cpu_model'][$key] : null}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['video_vendor']))
                                            <tr>
                                                <td>Видеокарта</td>
                                                @foreach($configurationAr['video_vendor'] as $key=>$val)
                                                    <td>{{$val}} {{isset($configurationAr['video_model'][$key]) ? $configurationAr['video_model'][$key] : null}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['memory_size']))
                                            <tr>
                                                <td>Оперативная память</td>
                                                @foreach($configurationAr['memory_size'] as $key=>$val)
                                                    <td>{{$val}} {{isset($configurationAr['memory_type'][$key]) ? $configurationAr['memory_type'][$key] : null}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['hard_disc_type']))
                                            <tr>
                                                <td>Жёсткий диск</td>
                                                @foreach($configurationAr['hard_disc_type'] as $val)
                                                    <td>{{$val}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['keyboard_vendor']))
                                            <tr>
                                                <td>Клавиатура</td>
                                                @foreach($configurationAr['keyboard_vendor'] as $val)
                                                    <td>{{$val}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['mouse_vendor']))
                                            <tr>
                                                <td>Мышь</td>
                                                @foreach($configurationAr['mouse_vendor'] as $val)
                                                    <td>{{$val}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['headphone_vendor']))
                                            <tr>
                                                <td>Гарнитура</td>
                                                @foreach($configurationAr['headphone_vendor'] as $val)
                                                    <td>{{$val}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['chair_vendor']))
                                            <tr>
                                                <td>Кресло</td>
                                                @foreach($configurationAr['chair_vendor'] as $val)
                                                    <td>{{$val}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['monitor_vendor']))
                                            <tr>
                                                <td>Монитор</td>
                                                @foreach($configurationAr['monitor_vendor'] as $key=>$val)
                                                    <td>{{$val}} {{isset($configurationAr['monitor_type'][$key]) ? $configurationAr['monitor_type'][$key] : null}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if(isset($configurationAr['internet']))
                                            <tr>
                                                <td>Интернет</td>
                                                @foreach($configurationAr['internet'] as $val)
                                                    <td>{{$val}}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
        @if(false)
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
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if($club->club_description != '')
            <div class="club_page_description_wrapper">
                <div class="container">
                    <div class="club_page_title">
                        <span>Описание</span>
                    </div>
                    <div class="club_page_description">
                        <p>
                            {!!$club->club_description!!}
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
                                    @if(false)
                                        <span class="subway_time_to">(1 мин.)</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="club_address_wrapper">
                            <div class="address_img_wrapper">
                                <img src="{{asset('/img/point-red.svg')}}" alt="location">
                            </div>
                            <div class="club_address">
                                {{$club->club_full_address}}
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
                @if($club->closed == '1')
                    <a class="club_calling closed">Закрыто навсегда</a>
                @else
                    @if($showCallButton)
                        <a href="tel:84958749900" class="club_calling">Позвонить</a>
                    @else
                        <a class="club_calling closed">Закрыт</a>
                    @endif
                @endif
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

    @if(admin())
        <div class="change_user_modal remodal admin_modal" id="change_user_modal" data-remodal-id="change_user_modal"  data-remodal-options="hashTracking: false">
            <button data-remodal-action="close" class="remodal-close">Закрыть</button>
            <div class="remodal-content">
                <form action="{{url('panel/club/'.$club->id.'/change-user')}}" method="post" style="dispaly:inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="club_id" value="{{$club->id}}">
                    <div class="modal-header">
                        <h4 class="modal-title">Сменить владелеца клуба</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group required">
                            <label for="select_new_user">Выберите нового владелеца</label>
                            <div class="input_wrapper">
                                <input id="select_new_user" type="text" placeholder="" autocomplete="false" autocomplete="chrome-off" required>
                                <input type="hidden" id="new_user_id" name="new_user" required>
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Отправить</button>
                </form>
            </div>
        </div>
        <div class="club_comment_modal remodal admin_modal" id="club_comment_modal" data-remodal-id="club_comment_modal"  data-remodal-options="hashTracking: false">
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
                        <div class="checkbox_holder" style="margin-top: 10px;">
                            <input type="checkbox" name="send_mail" id="send_mail">
                            <label for="send_mail">Отправить письмо владельцу</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Отправить</button>
                </form>
            </div>
        </div>

    @endif

    <div class="remodal report_modal report_club_modal" data-remodal-id="report_club_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="title">Комментарий к клубу</div>
        <div class="instr">
            С помощью этой формы можно указать на неточности в
            описании или оставить заявку на передачу управления
            представителю клуба.
        </div>
        <form action="{{url('report_club_error')}}" method="post" id="report-club-form" data-recaptcha-form>
            @csrf
            <input type="hidden" name="url" value="{{url()->current()}}">
            <div class="forma">
                <div class="form-group required @error('name') error @enderror">
                    <label for="contact-us-name-input">Имя</label>
                    <input id="contact-us-name-input" name="name" value="{{ old('name') }}"  type="text" placeholder=""  required>
                </div>
                <div class="form-group required @error('email') error @enderror">
                    <label for="contact-us-email-input">Email</label>
                    <input id="contact-us-email-input" name="email" value="{{ old('email') }}" type="email" placeholder=""  required>
                </div>
                <div class="form-group @error('phone') error @enderror">
                    <label for="contact-us-phone-input">Контактный телефон</label>
                    <input id="contact-us-phone-input" name="phone" value="{{ old('phone') }}" type="tel" placeholder="+7 (___) ___-__-__">
                </div>
                <div class="form-group required @error('message') error @enderror">
                    <label for="contact-us-message-input">Текст сообщения</label>
                    <textarea name="message" id="contact-us-message-input" value="{{ old('message') }}" maxlength="1500" required></textarea>
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
            <div class="btn_wrapper">
                <button type="submit">Отправить</button>
            </div>
        </form>
    </div>
</div>
    <div class="remodal show_club_photo_modal" data-remodal-id="club_photo_modal"  data-remodal-options="hashTracking: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="remodal-content">
            <div class="counter_slide" id="show_club_photo_counter_slide">
                1/10
            </div>
            <div class="club_photo_modal_wrapper">
                <?php if ($youtubeVideoUrl && $youtubeImageUrl): ?>
                <div class="slide_item club_video">
                    <iframe src="{{$youtubeVideoUrl}}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
                <?php endif; ?>
                @foreach ($images as $value)
                    <div class="slide_item">
                        <img src="{{$value}}" alt="club_image">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if(substr($club->club_price_file, strrpos($club->club_price_file, '.') + 1) != 'pdf')
        <div class="remodal show_club_price_list_modal" data-remodal-id="club_price_list_modal"  data-remodal-options="hashTracking: false">
            <button data-remodal-action="close" class="remodal-close"></button>
            <div class="remodal-content">
                <div class="club_price_list_wrapper">
                    <a href="{{$club->club_price_file}}" data-fancybox>
                        <img src="{{$club->club_price_file}}" alt="price_list">
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    @if($club->lat!= '' && $club->lon!= '')
        <script src="https://api-maps.yandex.ru/2.1/?apikey={{env('YANDIX_MAPS_KEY','79ca1998-f254-447d-8081-bcd9647a8fb9')}}&lang=ru_RU" type="text/javascript"></script>
        <script>
            ymaps.ready(init);

            function init() {
                var myMap = new ymaps.Map('club_page_maps', {
                    center: [{{$club->lat}}, {{$club->lon}}],
                    zoom: 15
                });
                myMap.geoObjects
                    .add(new ymaps.Placemark([{{$club->lat}}, {{$club->lon}}], {
                        preset: 'islands#dotIcon',
                        iconColor: '#735184'
                    }));
            }
        </script>
    @endif
    @if(admin())
        <script src="{{ asset('/js/jquery.autocomplete.js') }}?v={{ENV('JS_VERSION',0)}}"></script>
        <script>
            $('#select_new_user').autocomplete({
                serviceUrl: '{{url("/panel/find-user")}}',
                dataType: 'json',

                onSelect: function(suggestion) {
                    $('#new_user_id').val(suggestion.data);
                }
            });
        </script>
    @endif
    @if(session('success') || (isset($_GET['status']) && $_GET['status'] === 'success'))
        <script>
            $(document).ready(function() {
                jQuery('[data-remodal-id="success_modal"]').remodal().open();
            });
            window.history.replaceState({}, document.title, $('meta[name="site"]').attr('content') +  "/{{$club->id.'_computerniy_club_'.$club->url.'_'.$club->city->en_name.''}}");
        </script>
    @endif
    @if(isset($_GET['action']) && $_GET['action'] == 'change_user')
        <script>
            $(document).ready(function() {
                jQuery('[data-remodal-id="change_user_modal"]').remodal().open();
                jQuery('[data-remodal-id="change_user_modal"] #select_new_user').focus()
            });
        </script>
    @endif
    @if(admin())
        <script>
            $('.comment button[data-role-remove-comment]').click(function(){
                var id = $(this).attr('data-id'),
                comment = $(this).closest('.comment');
                comment.css('background','#ccc');
                    $.ajax({
                    url: "{{url('club').'/'.$club->id.'/remove_comment'}}",
                    type: 'post',
                    data: {
                        'id': id,
                        '_token':$('[name="_token"]').val()
                    },
                    success: function(data) {
                        comment.remove();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        comment.css('background','');
                    }
                });
            })
        </script>
    @endif
@endsection
