<?php

declare(strict_types=1);

?>

<div class="form_tab_title">
    Предпросмотр
</div>

<div class="preview_wrapper">
    <a href="#" class="club_card">
        <div class="search_club_img_wrapper">
            <div class="search_club_img">
                <img src="{{asset('/img/default-club-preview-image.svg')}}" alt="club">
            </div>
            <div class="club_services">
                <img class="vip_services" src="{{asset('/img/vip.svg')}}" alt="icon">
                <img class="food_services" src="{{asset('/img/fastfood.svg')}}" alt="icon">
                <img class="drink__services" src="{{asset('/img/drink.svg')}}" alt="icon">
                <img class="hookah_services" src="{{asset('/img/hook-white.svg')}}" alt="icon">
            </div>
            <div class="club_promotion">
                <span>Акция</span>
            </div>
        </div>
        <div class="search_club_info">
            <div class="club_name">
                <span></span>
            </div>
            <div class="club_subway_wrapper">
                <div class="subway_img_wrapper">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                        </svg>
                </div>
                <div class="subway_station">
                    <span></span>
                    <span class="subway_time_to"></span>
                </div>
            </div>
            <div class="club_address_wrapper">
                <div class="address_img_wrapper">
                    <img src="{{asset('/img/point-red.svg')}}" alt="location">
                </div>
                <div class="club_address"></div>
            </div>
            <div class="club_features_wrapper">
                <div class="club_features_item">
                    <div class="club_features_qty total_pc">
                        <span></span>
                    </div>
                    <div class="club_features_img_wrapper">
                        <img src="{{asset('/img/pc.svg')}}" alt="icon">
                    </div>
                </div>
                <div class="club_features_item">
                    <div class="club_features_qty console">
                        <span></span>
                    </div>
                    <div class="club_features_img_wrapper">
                        <img src="{{asset('/img/playstation.svg')}}" alt="icon">
                    </div>
                </div>
                <div class="club_features_item">
                    <div class="club_features_qty vr">
                        <span></span>
                    </div>
                    <div class="club_features_img_wrapper">
                        <img src="{{asset('/img/vr.svg')}}" alt="icon">
                    </div>
                    
                </div>
                <div class="club_features_item">
                    <div class="club_features_qty autosim">
                        <span></span>
                    </div>
                    <div class="club_features_img_wrapper">
                        <img src="{{asset('/img/drive.svg')}}" alt="icon">
                    </div>
                    
                </div>
            </div>
            <div class="club_price_wrapper">
                <div class="club_price">от <span></span> ₽/час</div>
                <div class="club_booking">Забронировать</div>
            </div>
        </div>
    </a>
</div>

