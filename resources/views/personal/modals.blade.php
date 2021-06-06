<!--MODALS START-->
<div class="person_add_club_modal_wrapper"></div>
<div class="person_add_club_modal" data-remodal-id="add_club_modal">
    <button data-remodal-action="close" class="remodal-close">Закрыть</button>
    <div class="remodal-content">
        <form action="" method="post" id="add-club-form">
            <div class="forma">
                <div class="form_tab_wrapper">
                    <div class="form_tab form_tab_01_common_info">
                        @include("personal.tabs.01_common_info")
                    </div>

                    <div class="form_tab form_tab_02_basic_services">
                    @include("personal.tabs.02_basic_services")
                    </div>

                    <div class="form_tab form_tab_03_advanced_services">
                    @include("personal.tabs.03_advanced_services")
                    </div>

                    <div class="form_tab form_tab_04_schedule">
                    @include("personal.tabs.04_schedule")
                    </div>

                    <div class="form_tab form_tab_05_configuration">
                    @include("personal.tabs.05_configuration")
                    </div>

                    <div class="form_tab form_tab_06_price">
                    @include("personal.tabs.06_price")
                    </div>

                    <div class="form_tab form_tab_07_contact_information">
                    @include("personal.tabs.07_contact_information")
                    </div>

                    <div class="form_tab form_tab_08_club_formalization" data-next-button-text="Отправить на модерацию">
                    @include("personal.tabs.08_club_formalization")
                    </div>

                    <div class="form_tab form_tab_09_club_preview">
                    @include("personal.tabs.09_club_preview")
                    </div>

                </div>
                <div class="form_btn_wrapper">
                    <div class="form_btn_item">
                        <button type="button" class="save_draft" data-role="save-draft">Сохранить как черновик</button>
                    </div>
                    <div class="form_btn_item">
                        <button type="button" class="prev_btn" data-role="prev-tab-button">Назад</button>
                        <button type="button" class="next_btn" data-role="next-tab-button">Продолжить</button>
                        <button type="submit">Подтвердить отправку</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="club_page_modals_wrapper"></div>
<div class="show_club_price_list_modal" data-remodal-id="club_price_list_modal">
    <button data-remodal-action="close" class="remodal-close">Закрыть</button>
    <div class="remodal-content">
        <div class="club_price_list_wrapper">
            <img src="{{asset('/img/club_prices.png')}}" alt="price_list">
        </div>
    </div>
</div>

<div class="show_club_photo_modal" data-remodal-id="club_photo_modal">
    <button data-remodal-action="close" class="remodal-close">Закрыть</button>
    <div class="remodal-content">
        <div class="counter_slide" id="show_club_photo_counter_slide">
            1/10
        </div>
        <div class="club_photo_modal_wrapper">
            <div class="slide_item">
                <img src="{{asset('/img/slider.png')}}" alt="club_image">
            </div>
            <div class="slide_item">
                <img src="{{asset('/img/slider.png')}}" alt="club_image">
            </div>
            <div class="slide_item">
                <img src="{{asset('/img/slider.png')}}" alt="club_image">
            </div>
            <div class="slide_item">
                <img src="{{asset('/img/slider.png')}}" alt="club_image">
            </div>
            <div class="slide_item">
                <img src="{{asset('/img/slider.png')}}" alt="club_image">
            </div>
        </div>
    </div>
</div>

<div class="remodal show_club_phone_modal" data-remodal-id="club_phone_modal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="club_phone_wrapper">
            <p>+7 (495)874-99-00</p>
        </div>
    </div>
</div>

<div class="remodal success_modal" data-remodal-id="success_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="club_phone_wrapper">
        <p class="title">Успешно!</p>
        </div>
    </div>
</div>
<!--MODALS END-->