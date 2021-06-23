<!doctype html>
<html lang="ru">
<head>
@yield('page')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="site" content="{{url('/')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
          integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
          integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
          integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.css"
          integrity="sha512-UO+dUiFTr6cCaPZKCzXEGhYsuK8DkGAS5iThyMUrtHsg+INCFyRM3GiqJ4rjuvfEyn81XGjpfmjSwwR1dAjAsw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.css"
          integrity="sha512-xlddSVZtsRE3eIgHezgaKXDhUrdkIZGMeAFrvlpkK0k5Udv19fTPmZFdQapBJnKZyAQtlr3WXEM3Lf4tsrHvSA=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal-default-theme.min.css"
          integrity="sha512-jRxwiuoe3nt8lMSnOzNEuQ7ckDrLl31dwVYFWS6jklXQ6Nzl7b05rrWF9gjSxgOow5nFerdoN6CBB4gY5m5nDw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('/fonts/stylesheet.css') }}?v={{ENV('CSS_VERSION',0)}}">
    <link rel="stylesheet" href="{{ asset('/fonts/PT/stylesheet.css') }}?v={{ENV('CSS_VERSION',0)}}">
    <link rel="stylesheet" href="{{ asset('/css/layout.css') }}?v={{ENV('CSS_VERSION',0)}}">
</head>

<body>
<div class="svg_icons">
    <svg id="icon-svg-account" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.8684 17C14.8045 17 13.0459 16.2622 11.5925 14.7865C10.1391 13.3108 9.41238 11.5252 9.41238 9.42969C9.41238 7.3342 10.1391 5.54861 11.5925 4.07292C13.0459 2.59722 14.8045 1.85938 16.8684 1.85938C18.9322 1.85938 20.6908 2.59722 22.1442 4.07292C23.5977 5.54861 24.3244 7.3342 24.3244 9.42969C24.3244 11.5252 23.5977 13.3108 22.1442 14.7865C20.6908 16.2622 18.9322 17 16.8684 17ZM16.8684 20.8073C18.6997 20.8073 20.7199 21.0729 22.9291 21.6042C25.1383 22.1354 27.1585 23.0061 28.9898 24.2161C30.8211 25.4262 31.7367 26.7986 31.7367 28.3333V32.1406H2V28.3333C2 26.7986 2.91565 25.4262 4.74694 24.2161C6.57824 23.0061 8.59848 22.1354 10.8077 21.6042C13.0168 21.0729 15.0371 20.8073 16.8684 20.8073Z" style="fill: var(--icon-color, black)"/>
    </svg>

    <svg id="icon-svg-file" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M28.3754 9.58574C28.5746 9.78496 28.6875 10.0539 28.6875 10.3361V30.8125C28.6875 31.4002 28.2127 31.875 27.625 31.875H6.375C5.7873 31.875 5.3125 31.4002 5.3125 30.8125V3.1875C5.3125 2.5998 5.7873 2.125 6.375 2.125H20.4764C20.7586 2.125 21.0309 2.23789 21.2301 2.43711L28.3754 9.58574ZM26.2371 10.8242L19.9883 4.57539V10.8242H26.2371ZM10.625 16.0039C10.5546 16.0039 10.487 16.0319 10.4372 16.0817C10.3874 16.1315 10.3594 16.1991 10.3594 16.2695V17.8633C10.3594 17.9337 10.3874 18.0013 10.4372 18.0511C10.487 18.1009 10.5546 18.1289 10.625 18.1289H23.375C23.4454 18.1289 23.513 18.1009 23.5628 18.0511C23.6126 18.0013 23.6406 17.9337 23.6406 17.8633V16.2695C23.6406 16.1991 23.6126 16.1315 23.5628 16.0817C23.513 16.0319 23.4454 16.0039 23.375 16.0039H10.625ZM10.625 20.5195C10.5546 20.5195 10.487 20.5475 10.4372 20.5973C10.3874 20.6471 10.3594 20.7147 10.3594 20.7852V22.3789C10.3594 22.4494 10.3874 22.5169 10.4372 22.5667C10.487 22.6165 10.5546 22.6445 10.625 22.6445H16.7344C16.8048 22.6445 16.8724 22.6165 16.9222 22.5667C16.972 22.5169 17 22.4494 17 22.3789V20.7852C17 20.7147 16.972 20.6471 16.9222 20.5973C16.8724 20.5475 16.8048 20.5195 16.7344 20.5195H10.625Z" style="fill: var(--icon-color, black)"/>
    </svg>

    <svg id="icon-svg-cancel" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 2.83337C9.16587 2.83337 2.83337 9.16587 2.83337 17C2.83337 24.8342 9.16587 31.1667 17 31.1667C24.8342 31.1667 31.1667 24.8342 31.1667 17C31.1667 9.16587 24.8342 2.83337 17 2.83337ZM24.0834 22.0859L22.0859 24.0834L17 18.9975L11.9142 24.0834L9.91671 22.0859L15.0025 17L9.91671 11.9142L11.9142 9.91671L17 15.0025L22.0859 9.91671L24.0834 11.9142L18.9975 17L24.0834 22.0859Z" style="fill: var(--icon-color, #DC0000)"/>
    </svg>

    <svg id="icon-svg-subway" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.7717 19.5045L7.88463 3.90002L13 13.0896L18.0963 3.90002L24.1727 19.5045H26V22.1H16.7877V19.5045H18.0963L16.7877 15.8676L13 22.1L9.1613 15.8676L7.88463 19.5045H9.1613V22.1H0V19.5045H1.7717Z" style="fill: var(--subway-color, #4DB762)"/>
    </svg>
</div>


<!--HEADER START-->
<header class="header">
    <div class="container-fluid">
        <div class="header_wrapper">
            <div class="header_logo_wrapper">
                <a href="{{url('/')}}/{{city()}}">
                    <img src="{{ asset('/img/logo.svg')}}" alt="logo">
                </a>
            </div>
            <div class="select2_wrapper select_city_wrapper">
                <select class="select_city" id="city_selector">
                    <option>{{city(true)['name']}}</option>
                </select>
            </div>
            <div class="mobile_menu_bg"></div>
            <div class="header_menu_wrapper">
                <a href="#" class="mobile_menu_btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <div class="header_menu">
                    <div class="decor"></div>
                    @if(!Auth::guest())
                    <div class="mob_menu_item">
                        <h4>Личный кабинет</h4>
                        <ul class="personal_menu">
                            <li>
                                <a href="{{url('personal/profile')}}">Профиль</a>
                            </li>
                            <li>
                                <a href="{{url('personal/clubs')}}">Список клубов</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="exit" class="exit">Выйти</a>
                            </li>
                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    @endif

                    <ul class="main_menu">
                      @if(admin())
                      <li>
                        <a href="<?=url('panel')?>">Панель</a>
                        </li>
                      @endif
                        <li>
                        <a href="<?= Auth::guest() ? url('register') : url('personal/clubs') ?>?action=add_club">Добавить клуб</a>
                        </li>
                        <li>
                            <a href="{{url('contacts')}}">Контакты</a>
                        </li>
                    </ul>
                    <div class="mob_menu_item">

                        <ul>
                            @if(Auth::guest())
                                <li>
                                    <a href="<?=url('personal/clubs')?>">Личный кабинет</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{url('register')}}">Как попасть на LanGame</a>
                            </li>
                            <li>
                                <a href="{{url('langame-software')}}">LanGame Software</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mob_menu_item">
                        <ul>
                            <li>
                                <a href="{{url('about-us')}}">О сервисе</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mob_menu_item">
                        <ul>
                            <li>
                                <a href="{{url('privacy_policy')}}">Политика конфиденциальности</a>
                            </li>
                            <li>
                                <a href="{{url('terms_of_use')}}">Пользовательское соглашение</a>
                            </li>
                        </ul>
                        <div class="rights_wrapper">
                            <p>© ООО «Лангейм», 2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--HEADER END-->
@yield('content')
<!-- MODALS -->

<div class="remodal success_modal" data-remodal-id="success_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="club_phone_wrapper">
        <p class="title">Успешно!</p>
        </div>
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



<!-- END OF MODALS -->
<!--FOOTER START-->
<footer class="footer">
    <div class="container-fluid">
        <div class="footer_top">
            <div class="footer_logo_wrapper">
                <div class="logo_wrapper">
                    <a href="{{url('/')}}/{{city()}}">
                        <img src="{{ asset('/img/logo.svg')}}" alt="logo">
                    </a>
                </div>
            </div>
            <div class="footer_content_wrapper">
                <div class="footer_content_list">
                    <div class="footer_content_item">
                        <h4>Игрокам</h4>
                        <ul>
                            <li>
                                <a href="{{url('about-us')}}">О сервисе</a>
                            </li>
                            <li>
                                <a href="{{url('contacts')}}">Обратная связь</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer_content_item">
                        <h4>Владельцам клубов</h4>
                        <ul>
                            <li>
                                <a href="{{url('personal/clubs')}}">Личный кабинет владельца</a>
                            </li>
                            <li>
                                <a href="{{url('personal/clubs')}}?action=add_club">Как попасть на Langame</a>
                            </li>
                            <li>
                                <a href="{{url('langame-software')}}">Langame Software</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="footer_rights_wrapper">
                <p>© ООО «Лангейм», 2021</p>
            </div>
            <div class="footer_site_info">
                <a href="{{url('privacy_policy')}}">Политика конфиденциальности</a>
                <a href="{{url('terms_of_use')}}">Пользовательское соглашение</a>
            </div>
        </div>
    </div>
</footer>
<!--FOOTER END-->

    <script>
        window.YANDEX_API_KEY = '{{env('YANDIX_MAPS_KEY','79ca1998-f254-447d-8081-bcd9647a8fb9')}}';
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.js"
            integrity="sha512-a/KwXZUMuN0N2aqT/nuvYp6mg1zKg8OfvovbIlh4ByLw+BJ4sDrJwQM/iSOd567gx+yS0pQixA4EnxBlHgrL6A=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
            integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"
            integrity="sha512-5AcaBUUUU/lxSEeEcruOIghqABnXF8TWqdIDXBZ2SNEtrTGvD408W/ShtKZf0JNjQUfOiRBJP+yHk6Ab2eFw3Q=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
            integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
            crossorigin="anonymous"></script>
    <script src="{{ asset('/js/inputmask.js') }}"></script>
    <script src="{{ asset('/js/dest/layout.js') }}?v={{ENV('JS_VERSION',0)}}"></script>
    <script src="{{ asset('/js/main.js') }}?v={{ENV('JS_VERSION',0)}}"></script>


    @yield('scripts')

   <script>
   $('#city_selector').on('select2:select', function (e) {
        var url = $('meta[name="site"]').attr('content');
        window.location.href = url + '/'+e.params.data.data;
    });

    $('#city_selector').select2({
        ajax: {
            url: '{{url("searchCities")}}',
            dataType: 'json'
        },
        cache: true
    });
    $('#select-сity').select2({
        ajax: {
            url: '{{url("searchCities")}}',
            dataType: 'json',
            data:{
                selected : $('#select-сity').val()
            }
        },
        cache: true
    });
   </script>
   <style>
   .select2-container .select2-dropdown{
    z-index: 9999999!important;
   }</style>
</body>
</html>
