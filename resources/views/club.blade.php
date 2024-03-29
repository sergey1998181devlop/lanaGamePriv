<?php
$clubIndex = isset($clubIndex) ? $clubIndex : null;
$likedClubs = (isset($page) && $page=='likedClubs') ? true : false;
?>
<?$isHidden = (isset($show) && $show === 'map' && (city(true)['id'] != 1 && $club->club_city != city(true)['id'])) ? true : false ?>
<div class="sc_item <?=(isset($show) && $show === 'map') ? 'in_map' : null ?> <?=($isHidden) ? 'another_city' : null ?> <?= $likedClubs ? 'liked_list' : null?>"
     data-id="{{$club->id}}"
     data-role-club
     data-lon="{{$club->lon}}"
     data-lat="{{$club->lat}}"
     style="<?=($isHidden) ? 'display:none;' : null ?>"
>
    <a href="{{url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name)}}" class="club_card">
        <div class="sc_img_wrapper">
            <div class="sc_img">
                @if($club->main_preview_photo != null)
                    <?php
                    $main_preview_photo = ($club->club_thumbnail != null) ? $club->club_thumbnail : $club->main_preview_photo;
                    $isLazyLoad = $clubIndex !== null && $clubIndex > 5;
                    ?>
                    <img src="<?= $isLazyLoad ? 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNc9R8AAlkBq1Ih+jkAAAAASUVORK5CYII=' : $main_preview_photo; ?>"
                         data-src="<?= $main_preview_photo; ?>"
                         class="main_preview_photo <?= $isLazyLoad ? 'lazy' : ''; ?>"
                         alt="">
                @else
                    <img src="{{ asset('/img/default-club-preview-image.svg')}}" alt="club">
                @endif
            </div>
            @if($club->qty_vip_pc > 0 || $club->food_drinks =='1' || $club->alcohol =='1')
                <div class="club_services">
                    @if($club->qty_vip_pc > 0)
                        <img src="{{ asset('/img/vip.svg')}}" alt="icon">
                    @endif
                    @if($club->food_drinks =='1')
                        <img src="{{ asset('/img/fastfood.svg')}}" alt="icon">
                    @endif
                    @if($club->alcohol =='1')
                        <img src="{{ asset('/img/drink.svg')}}" alt="icon">
                    @endif
                </div>
            @endif
            <div class="club_distance">
                <img src="{{ asset('/img/walk.svg')}}" alt="icon">
                <span>{{$club->nearby}} км. от вас</span>
            </div>
            @if($club->marketing_event == '1')
                <div class="club_promotion">
                    <span>Акция</span>
                </div>
            @endif
        </div>
        <div class="sc_info">
            <div class="club_name">
                <span>{{$club->club_name}}</span>
            </div>
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
            @if($club->club_metro != null && $club->metro != null)
                <div class="club_subway_wrapper">
                    <div class="subway_img_wrapper" style="--subway-color:#{{ $club->metro->color}}">
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
                    <img src="{{ asset('/img/point-red.svg')}}" alt="location">
                </div>
                <div class="club_address">
                    <?=((isset($show) && $show === 'map') || isset($mainPage) || city(true)['id'] == 1) ? $club->city->name . ', ' : null ?> {{$club->club_address}}
                </div>
            </div>
            <div class="cf_wrapper">
                <div class="cf_item">
                    <div class="cf_img_wrapper">
                        <img src="{{ asset('/img/pc.svg')}}" alt="icon">
                    </div>
                    <div class="cf_qty">
                        <span>{{$club->qty_pc}}</span>
                    </div>
                </div>
                @if($club->qty_console > 0 )
                    <div class="cf_item">
                        <div class="cf_img_wrapper">
                            <img src="{{ asset('/img/playstation.svg')}}" alt="icon">
                        </div>
                        <div class="cf_qty">
                            <span>{{$club->qty_console + $club->qty_console_1 + $club->qty_console_2 + $club->qty_console_3}}</span>
                        </div>
                    </div>
                @endif
                @if($club->qty_vr > 0 )
                    <div class="cf_item">
                        <div class="cf_img_wrapper">
                            <img src="{{ asset('/img/vr.svg')}}" alt="icon">
                        </div>
                        <div class="cf_qty">
                            <span>{{$club->qty_vr}}</span>
                        </div>
                    </div>
                @endif
                @if($club->qty_simulator > 0 )
                    <div class="cf_item">
                        <div class="cf_img_wrapper">
                            <img src="{{ asset('/img/drive.svg')}}" alt="icon">
                        </div>
                        <div class="cf_qty">
                            <span>{{$club->qty_simulator}}</span>
                        </div>
                    </div>
                @endif
            </div>
            <div class="club_price_wrapper">
                <div class="club_price">от {{$club->club_min_price}} ₽/час</div>
                @if($club->closed == '1')
                    <div class="club_booking closed">Закрыто навсегда</div>
                @else

                    <?php
                    if ($club->work_time == '2') {
                        $schedule_item = unserialize($club->work_time_days);
                    }
                    $showCallButton = true;
                    if ($club->work_time == '2' && is_array($schedule_item)) {
                        if (!isset($schedule_item[$today])) {
                            $showCallButton = false;
                        } else {
                            if (!empty($schedule_item[$today]['from']) && !empty($schedule_item[$today]['to'])) {
                                $begin = new DateTime($schedule_item[$today]['from']);
                                if (explode(":", $schedule_item[$today]['to'])[0] < explode(":", $schedule_item[$today]['from'])[0]) {
                                    $end = new DateTime($schedule_item[$today]['to']);
                                    $end->add(new DateInterval("P1D"));
                                } else {
                                    $end = new DateTime($schedule_item[$today]['to']);
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
                        <div class="club_calling" onclick="ym(82365286,'reachGoal','book');gtag('event', 'send', { 'event_category': 'book', 'event_action': 'click' });">Бронь по
                            звонку
                        </div>
                    @else
                        <div class="club_booking closed">Закрыт</div>
                    @endif
                @endif
            </div>
        </div>
    </a>
</div>
