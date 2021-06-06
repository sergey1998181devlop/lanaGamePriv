@extends('layouts.app')
@section('page')
<title>О нас - LanGame</title>
@endsection
@section('content')
<!--SECTION LANGAME SOFTWARE START-->
<section class="langame_software_wrapper">
    <div class="container">
        <div class="langame_software_content">
            <div class="langame_software_title">
                LanGame Software
            </div>
            <p>
                LanGame Software - это новейший комплекс вашим компьютерным клубом или киберспортивной ареной.
            </p>
            <div class="langame_software_title text_decor">
                Клубное ПО + мобильное приложение
            </div>
            <p>
                Единое решение, удобное как для владельцев, так и для гостей. Разработано и проверено на сети собственных компьютерных клубов.
            </p>

            <div class="club_list_navigation_wrapper">
                <ul class="club_list_navigation_tabs">
                    <li>
                        <a href="#tab1" class="active">
                            <span>Безопаность</span>
                        </a>
                    </li>
                    <li><a href="#tab2">
                            <span>Автоматизация</span>
                        </a>
                    </li>
                    <li><a href="#tab3">
                            <span>Полный контроль</span>
                        </a>
                    </li>
                    <li><a href="#tab4">
                            <span>Интеграция</span>
                        </a>
                    </li>
                    <li><a href="#tab5">
                            <span>Лояльность</span>
                        </a>
                    </li>
                    <li><a href="#tab6">
                            <span>Облако</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="club_list_content_tabs">
                <div class="tab" id="tab1">
                   <div class="content_wrapper">
                       <div class="content_item">
                           <p>
                               Наше ПО разрабатывается, исходя из принципа
                               “Любая угроза безопасности - это финансовые потери”. Ни один бизнесмен
                               не любит терять деньги. Мы тоже.
                           </p>
                       </div>
                       <div class="content_item">
                           <ul>
                               <li>Высокий уровень взломостойкости как со стороны посетителей, так и администраторов</li>
                               <li>Предотвращение установки любого вредоносного ПО</li>
                               <li>Мониторинг установленного оборудования и любых манипуляций с ним</li>
                               <li>Особое отношение к хранению персональных данных гостей</li>
                           </ul>
                       </div>
                   </div>
                </div>
                <div class="tab" id="tab2" style="display: none">

                </div>
                <div class="tab" id="tab3" style="display: none">

                </div>
                <div class="tab" id="tab4" style="display: none">

                </div>
                <div class="tab" id="tab5" style="display: none">

                </div>
                <div class="tab" id="tab6" style="display: none">

                </div>
            </div>

            <div class="marketing_offer_wrapper">
                <span>6 месяцев - бесплатно!</span>
            </div>
            <p>
                Попробуйте LanGame Software в своём клубе в рамках бесплатного тестового периода.
                Оставьте заявку и получите все необходимые материалы для его установки и настройки.
            </p>
            <div class="add_club_request_wrapper">
                <form action="" method="post" id="add-club-request-form">
                    <div class="forma">
                        <div class="form-group required">
                            <label for="club-request-user-name-input">Ваше имя</label>
                            <input id="club-request-user-name-input" name="add_club_request_user_name" type="text" placeholder="" required>
                        </div>
                        <div class="form-group required">
                            <label for="club-request-name-input">Название клуба</label>
                            <input id="club-request-name-input" name="add_club_request_name" type="text" placeholder="Введите название клуба" required>
                        </div>
                        <div class="form-group required">
                            <label for="club-request-select-сity">Город</label>
                            <div class="input_wrapper">
                                <div class="select2_wrapper">
                                    <select id="club-request-select-сity" name="add_club_request_city" required data-placeholder="Выберите город">
                                        <option value=""></option>
                                        <option value="2">Москва</option>
                                        <option value="3">Санкт-Петербург</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="club-request-phone-input">Контактный телефон</label>
                            <input id="club-request-phone-input" name="add_club_request_phone" type="tel" placeholder="+7 (___) ___-__-__">
                        </div>
                        <div class="form-group required">
                            <label for="club-request-email-input">Email</label>
                            <input id="club-request-email-input" name="add_club_request_email" type="email" placeholder="" required>
                        </div>
                        <div class="checkbox_wrapper">
                            <div class="checkbox_item">
                                <label>
                                    <input type="checkbox" name="add_club_request_user_agree" required>
                                    <span class="activator"><span></span></span>
                                    <span>Согласен с условиями обработки персональных данных</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit">Отправить заявку</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!--SECTION LANGAME SOFTWARE END-->
@endsection