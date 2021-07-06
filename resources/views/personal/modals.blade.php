<!--MODALS START-->
<div class="person_add_club_modal_wrapper"></div>
<div class="person_add_club_modal" data-remodal-id="add_club_modal">
@if($edit)
<a href="{{url('personal/clubs')}}" class="remodal-close">Закрыть</a>
@else
<button data-remodal-action="close" class="remodal-close">Закрыть</button>
@endif
    <div class="remodal-content">
        @if($edit)
        <form action="{{url('personal/club/'.$clubAr->id.'/update')}}" @if($clubAr->draft == '1') draft-action="{{url('personal/club/'.$clubAr->id.'/update-draft')}}" @endif class="edit_club_form" list-action="{{url('clubs/add-list')}}" image-action="{{url('clubs/add-image')}}" method="post" id="add-club-form">
        @else
        <form action="{{url('clubs/add')}}" draft-action="{{url('clubs/add-draft')}}" list-action="{{url('clubs/add-list')}}" image-action="{{url('clubs/add-image')}}" method="post" id="add-club-form">
        @endif
        {{ csrf_field() }}
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
                        @if(!$edit || $clubAr->draft == '1')
                        <button type="button" class="save_draft" data-role="save-draft">Сохранить как черновик</button>
                        @endif
                    </div>

                    <div class="form_btn_item">
                        <button type="button" class="prev_btn" data-role="prev-tab-button">Назад</button>
                        <button type="button" class="next_btn" data-role="next-tab-button">Продолжить</button>


                        @if(notVerifed())
                            <button type="submit" disabled>Подтвердить отправку</button>
                        @else
                            <button type="submit">Подтвердить отправку</button>
                        @endif

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!--MODALS END-->
