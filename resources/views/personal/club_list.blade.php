@extends('layouts.app')
@section('page')
    <title>Список клубов - LanGame</title>
    <style>
        .ck.ck-content.ck-editor__editable {
            height: 250px;
        }

        .ck.ck-reset.ck-editor {
            max-width: 500px;
            width: 400px;
        }

        @media (max-width: 500px) {
            .ck.ck-reset.ck-editor {
                max-width: 100%;
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    @include('personal/club_card')
    <?
    include_once(resource_path('views/personal/tabs/conf.blade.php'));
    ?>
    <?php
    global $edit;
    global $clubAr;
    global $schedule_item;
    global $configuration;
    global $marketing_events;
    if (isset($action) && $action == 'edit') {
        $edit = true;
        $schedule_item = '1';
        if ($clubAr->work_time != '1' && $clubAr->work_time_days != '') {
            $schedule_item = unserialize($clubAr->work_time_days);
        }
        $configuration = [];
        if (canBeUnserialized($clubAr->configuration)) {
            $configuration = unserialize($clubAr->configuration);
            // Разделить дюймы и герцы в мониторах
            foreach ($configuration as $key => $zone) {
                $mon_t = array_filter(explode(' ', str_replace('Гц', '', $zone['monitor_type'])));
                $configuration[$key]['monitor_type'] = (isset($mon_t[0])) ? $mon_t[0] : '';
                $configuration[$key]['monitor_hertz'] = (isset($mon_t[1])) ? $mon_t[1] : '';
            }
        }
        $marketing_events = [];
        if (canBeUnserialized($clubAr->marketing_event_descr)) {
            $marketing_events = unserialize($clubAr->marketing_event_descr);
        }
    } else {
        $edit = false;
    }

    function clubValue($input)
    {
        global $edit;
        if (!$edit) return false;
        global $clubAr;
        if (isset($clubAr->$input)) {
            if (is_numeric($clubAr->$input) && $clubAr->$input == 0) return false;

            return $clubAr->$input;
        }

        return false;
    }
    function checkDays($day)
    {
        global $edit;
        if (!$edit) return true;
        global $clubAr;
        if ($clubAr->work_time == '1') return true;
        global $schedule_item;
        if (!is_array($schedule_item) || !isset($schedule_item[$day])) return false;

        return true;
    }
    function hours($day, $fromOrTo = 'to')
    {
        $hours = [
            '00:00',
            '01:00',
            '02:00',
            '03:00',
            '04:00',
            '05:00',
            '06:00',
            '07:00',
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00',
            '23:00'
        ];
        global $edit;
        if ($edit) {
            global $clubAr;
            global $schedule_item;
        }
        foreach ($hours as $value) {
            $selected = '';
            if ($edit && is_array($schedule_item) && isset($schedule_item[$day])) {
                $selected = ($schedule_item[$day][$fromOrTo] == $value) ? 'selected' : null;
            }
            echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
        }
    }
    function getConf($name, $key)
    {
        global $edit;
        if (!$edit) return false;
        global $configuration;
        if (!is_array($configuration)) return false;
        if (isset($configuration[$key][$name])) {
            return $configuration[$key][$name];
        }

        return false;
    }
    function getMarketingEvents($key = null)
    {
        global $edit;
        if (!$edit) return false;
        global $clubAr;
        if ($clubAr->marketing_event != '1') return false;
        global $marketing_events;
        if (canBeUnserialized($clubAr->marketing_event_descr)) {
            $marketing_events = unserialize($clubAr->marketing_event_descr);
        } else {
            return false;
        }
        if ($key === null) return $marketing_events;

        return $marketing_events[$key];
    }
    ?>
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
                        @if(owner())
                            <a href="{{url('personal/clubs')}}" class="active">
                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-file"></use>
                                </svg>
                                <span>Список клубов</span>
                            </a>
                            <a href="{{url('clubs-offers')}}">
                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-offer"></use>
                                </svg>
                                <span>Биржа предложений</span>
                            </a>
                        @endif
                        <a href="{{ route('logout') }}"
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
                        <div class="club_list_navigation_tabs_wrapper">
                            <ul class="club_list_navigation_tabs">
                                <li>
                                    <a href="#tab1" @if(!$edit || $clubAr->published_at != null)class="active" @endif>
                                        <span>Опубликованные </span>
                                        @if(count($published) > 0)
                                            <span class="qty"> {{count($published)}}</span>
                                        @endif
                                    </a>
                                </li>
                                <li><a href="#tab2" @if($edit && $clubAr->draft != '1' && $clubAr->published_at == null)class="active" @endif>
                                        <span>На модерации </span>
                                        @if(count($underModify) > 0)
                                            <span class="qty"> {{count($underModify)}}</span>
                                        @endif
                                    </a>
                                </li>
                                <li><a href="#tab3" @if($edit && $clubAr->draft == '1')class="active" @endif>
                                        <span>Черновики </span>
                                        @if(count($draft) > 0)
                                            <span class="qty"> {{count($draft)}}</span>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="btn_wrapper">
                            <div class="club_list_title">Список клубов</div>
                            <button type="button" class="add_club" data-remodal-target="add_club_modal">Добавить</button>
                        </div>
                    </div>

                    <div class="club_list_content_tabs">
                        <div class="tab" id="tab1" @if($edit && $clubAr->published_at == null)style="display: none" @endif>
                            @if(notVerifed())
                                <div class="user_verified">
                                    Мы не сможем приступить к проверке вашего клуба, пока вы не подтвердите адрес электронной почты. Письмо с инструкциями направлено на указанный
                                    ящик.
                                    Для повторной отправки <a href="{{url('profile/verify/resend')}}">нажмите сюда.</a>
                                </div>
                            @endif
                            @if(count($published)==0 && count($underModify)==0 && count($draft)==0)
                                <div class="instr">
                                    Привет! Добро пожаловать на <span class="text_decor">langame.ru</span> - платформу для компьютерных клубов.
                                    <br>
                                    <br>
                                    Если ваша площадка уже есть на нашем сайте, и вы хотите управлять информацией на ней,
                                    просто запросите её перенос на ваш аккаунт. Для этого достаточно нажать иконку рядом с названием клуба и
                                    заполнить появившуюся форму.
                                    <br>
                                    <br>
                                    А если вы не нашли ваш клуб на портале, то можете добавить его прямо сейчас. Просто нажмите кнопку "Добавить"
                                    и заполните все необходимые данные. После подтверждения вашей почты и прохождения модерации,
                                    клуб обязательно появится в поиске.
                                    <br>
                                    <br>
                                    Спасибо, что участвуете в развитии LAN-культуры!
                                </div>
                            @endif
                            <div class="club_list_content">
                                @foreach($published as $club)
                                    <div class="club_list_item">
                                        {!!echoCard($club)!!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab" id="tab2" @if(!$edit || $clubAr->draft == '1' || $clubAr->published_at != null)style="display: none"@endif>
                            <div class="club_list_content moderation1">
                                @foreach($underModify as $club)
                                    <div class="club_list_item">
                                        {!!echoCard($club,'under_edit')!!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab" id="tab3" @if(!$edit || $clubAr->draft != '1')style="display: none"@endif>
                            <div class="club_list_content">
                                @foreach($draft as $club)
                                    <div class="club_list_item">
                                        {!!echoCard($club,'draft')!!}
                                    </div>
                                @endforeach
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
    @if(isset($action) && $action == 'edit')
        <script>
            $(document).ready(function() {
                $('[data-remodal-target="add_club_modal"]').click();
            });
        </script>
    @endif
    @if(isset($_GET['action']) && $_GET['action'] == 'add_club')
        <script>
            $(document).ready(function() {
                $('[data-remodal-target="add_club_modal"]').click();
            });
            window.history.replaceState({}, document.title, $('meta[name="site"]').attr('content') + '/' + 'personal/clubs/');
        </script>
    @endif
    @if(isset($_GET['status']) && $_GET['status'] == 'success')
        <script>
            $(document).ready(function() {
                jQuery('[data-remodal-id="success_modal"]').remodal().open();
            });
            window.history.replaceState({}, document.title, $('meta[name="site"]').attr('content') + '/' + 'personal/clubs/');
        </script>
    @endif
    <script src="{{ asset('/js/jquery.autocomplete.js') }}?v={{ENV('JS_VERSION',0)}}"></script>
    <script src="{{url('ck5/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#club-descr-input'), {
                toolbar: {
                    items: [
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'undo',
                        'redo'
                    ]
                },
                language: 'ru',
                licenseKey: ''
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.warn('Build id: lkxv7bp3c78d-1afjedfm0hw0');
                console.error(error);
            });
    </script>
@endsection
