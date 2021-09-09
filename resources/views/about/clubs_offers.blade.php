@extends('layouts.app')
@section('page')
    <title>Предложения компьютерных клубов</title>
@endsection
@section('content')
    <section class="clubs_offers_wrapper">
        <div class="container">
            <div class="clubs_offers_page_title">Предложения для компьютерных клубов</div>
            <div class="club_list_navigation_tabs_wrapper">
                <ul class="club_list_navigation_tabs offer">
                    <li>
                        <a href="#tab4" class="active">
                            <span>От компаний</span>
                        </a>
                    </li>
                    <li><a href="#tab5">
                            <span>От других клубов</span>
                        </a>
                    </li>
                    <li><a href="#tab6" class="disabled">
                            <span>Совместные закупки</span>
                            <span class="decor">В разработке</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="club_list_content_tabs">
                <div class="tab" id="tab4">
                    <div class="club_list_content">
                        <div class="company_offers_wrapper">
                            <div class="company_offers_list">
                                <a href="#" class="offer_item" data-remodal-target="company_offers_modal">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/msi.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="descr">
                                            Аксессуары в подарок при покупке набора комплектующих
                                        </div>
                                        <div class="btn_wrapper">
                                            <button type="button" class="btn_detail">Подробнее</button>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="offer_item">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/dxracer.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="descr">
                                            Аксессуары в подарок при покупке набора комплектующих
                                        </div>
                                        <div class="btn_wrapper">
                                            <button type="button" class="btn_detail">Подробнее</button>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="offer_item">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/redragon.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="descr">
                                            Аксессуары в подарок при покупке набора комплектующих
                                        </div>
                                        <div class="btn_wrapper">
                                            <button type="button" class="btn_detail">Подробнее</button>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="offer_item">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/steel.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="descr">
                                            Аксессуары в подарок при покупке набора комплектующих
                                        </div>
                                        <div class="btn_wrapper">
                                            <button type="button" class="btn_detail">Подробнее</button>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="offer_item">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/eon.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="descr">
                                            Аксессуары в подарок при покупке набора комплектующих
                                        </div>
                                        <div class="btn_wrapper">
                                            <button type="button" class="btn_detail">Подробнее</button>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="offer_item">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/razer.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="descr">
                                            Аксессуары в подарок при покупке набора комплектующих
                                        </div>
                                        <div class="btn_wrapper">
                                            <button type="button" class="btn_detail">Подробнее</button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a id="show_more_company_offers" class="show_more pointer">Показать ещё</a>
                        </div>
                    </div>
                </div>
                <div class="tab" id="tab5" style="display: none">
                    <div class="club_list_content">
                        <div class="company_offers_wrapper">
                            <button type="button" class="add_offer" data-remodal-target="add_offer_modal">Добавить объявление</button>
                            <div class="attention_text_wrapper">
                                <div class="img_wrapper">
                                    <img src="{{ asset('/img/attention.svg')}}" alt="image">
                                </div>
                                <div class="title">Будьте внимательны при совершении сделки.</div>
                                <div class="instr">
                                    <p>
                                        Убедитесь, что продавец действительно располагает заявленным на продажу товаром, а покупатель - платежеспособен.
                                    </p>
                                    <p>
                                        <span class="text-decor">Администрация langame.ru не имеет отношения</span> к содержанию объявлений, а просто предоставляет площадку для
                                        них.
                                    </p>
                                    <p>
                                        В любой непонятной ситуации - оставайтесь людьми.
                                    </p>
                                </div>
                            </div>
                            <div class="clubs_offers_list">
                                <a href="#" class="offer_item" data-remodal-target="clubs_offers_modal">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/mouse.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="info_item">
                                            <div class="title">БУ Периферия</div>
                                            <div class="descr">
                                                БУ игровые мышки, клавиатуры в хорошем состоянии, 10 комплектов
                                            </div>
                                        </div>
                                        <div class="info_item">
                                            <div class="price">6.000 ₽</div>
                                            <div class="club_name">Клуб: <span>Кибертында</span></div>
                                            <div class="date">Дата публикации: <span>24.07.2021</span></div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="offer_item" data-remodal-target="clubs_offers_modal">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/mouse.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="info_item">
                                            <div class="title">БУ Периферия</div>
                                            <div class="descr">
                                                БУ игровые мышки, клавиатуры в хорошем состоянии, 10 комплектов
                                            </div>
                                        </div>
                                        <div class="info_item">
                                            <div class="price">6.000 ₽</div>
                                            <div class="club_name">Клуб: <span>Кибертында</span></div>
                                            <div class="date">Дата публикации: <span>24.07.2021</span></div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="offer_item" data-remodal-target="clubs_offers_modal">
                                    <div class="img_wrapper">
                                        <img src="{{ asset('/img/mouse.png')}}" alt="image">
                                    </div>
                                    <div class="info_wrapper">
                                        <div class="info_item">
                                            <div class="title">БУ Периферия</div>
                                            <div class="descr">
                                                БУ игровые мышки, клавиатуры в хорошем состоянии, 10 комплектов
                                            </div>
                                        </div>
                                        <div class="info_item">
                                            <div class="price">6.000 ₽</div>
                                            <div class="club_name">Клуб: <span>Кибертында</span></div>
                                            <div class="date">Дата публикации: <span>24.07.2021</span></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a id="show_more_club_offers" class="show_more pointer">Показать ещё</a>
                        </div>
                    </div>
                </div>
                <div class="tab" id="tab6" style="display: none">
                    <div class="club_list_content"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="remodal company_offers_modal" data-remodal-id="company_offers_modal" data-remodal-options="hashTracking: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="remodal-content">
            <div class="title">Предложение от компании MSI</div>
            <div class="offer_content_wrapper">
                <div class="offer_content_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/dxracer.png')}}" alt="image">
                    </div>
                    <div class="subtitle">Контактное лицо</div>
                    <div class="contact_name">Аркадий Лещ</div>
                    <button type="button" class="offer_btn show_offer_contacts" >Показать контакт</button>
                    <div class="contacts_wrapper">
                        <div class="club_contact">
                            <img src="{{asset('/img/phone.svg')}}" alt="phone">
                            <a href="tel:+7(495)999-99-99">+7(495)999-99-99</a>
                        </div>

                        <div class="club_contact">
                            <img src="{{asset('/img/mail.svg')}}" alt="email">
                            <a href="mailto:hello@langame.ru">hello@langame.ru</a>
                        </div>
                    </div>
                </div>
                <div class="offer_content_item">
                    <div class="subtitle text_decor">Подробные условия</div>
                    <div class="offer_info_text_wrapper">
                        <div class="offer_info_text" data-simplebar>
                            Купи 10 материнских плат и получи мышку в подарок. Купи 5 мониторов и получи лещща.
                            Купи 10 материнских плат и получи мышку в подарок. Купи 5 мониторов
                            и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи
                            мышку в подарок. Купи 5 мониторов и получи лещща.
                            Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="remodal clubs_offers_modal" data-remodal-id="clubs_offers_modal" data-remodal-options="hashTracking: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="remodal-content">
            <div class="title">
                <span>БУ Периферия</span>
                <span>6.000 ₽</span>
            </div>
            <div class="offer_content_wrapper">
                <div class="offer_content_item">
                    <div class="img_wrapper">
                        <img src="{{ asset('/img/mouse.png')}}" alt="image">
                    </div>
                    <div class="subtitle">Клуб</div>
                    <div class="contact_name">Кибертында</div>
                    <div class="subtitle">Дата публикации</div>
                    <div class="contact_name">24.07.2021</div>
                    <div class="subtitle">Контактное лицо</div>
                    <div class="contact_name">Аркадий Лещ</div>
                    <button type="button" class="offer_btn show_offer_contacts">Показать контакт</button>
                    <div class="contacts_wrapper">
                        <div class="club_contact">
                            <img src="{{asset('/img/phone.svg')}}" alt="phone">
                            <a href="tel:+7(495)999-99-99">+7(495)999-99-99</a>
                        </div>

                        <div class="club_contact">
                            <img src="{{asset('/img/mail.svg')}}" alt="email">
                            <a href="mailto:hello@langame.ru">hello@langame.ru</a>
                        </div>
                    </div>
                </div>
                <div class="offer_content_item">
                    <div class="subtitle text_decor">Описание</div>
                    <div class="offer_info_text_wrapper">
                        <div class="offer_info_text">
                            Купи 10 материнских плат и получи мышку в подарок. Купи 5 мониторов и получи лещща.
                            Купи 10 материнских плат и получи мышку в подарок. Купи 5 мониторов
                            и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи
                            мышку в подарок. Купи 5 мониторов и получи лещща.
                            Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща. Купи 10 материнских плат и получи мышку в подарок.
                            Купи 5 мониторов и получи лещща.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="remodal add_offer_modal" data-remodal-id="add_offer_modal" data-remodal-options="hashTracking: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="remodal-content">
            <form action="" method="post" id="add-offer-form">
                <div class="top_wrapper">
                    <div class="title">Добавить объявление</div>
                    <div class="btn_wrapper">
                        <button type="submit">На модерацию</button>
                    </div>
                </div>
                <div class="forma">
                    <div class="form-group required">
                        <label for="offer-name-input">Заголовок объявления</label>
                        <input id="offer-name-input" name="name" value="" type="text" placeholder="" required>
                    </div>
                    <div class="form-group descr required">
                        <label for="offer-descr-input">Описание объявления</label>
                        <textarea name="message" id="offer-descr-input" maxlength="1500" required></textarea>
                    </div>
                    <div class="form-group required">
                        <label for="offer-price-input">Цена</label>
                        <div class="input_wrapper">
                            <input id="offer-price-input" name="price" value="" type="number" placeholder="Введите стоимость" min="1" required>
                        </div>
                    </div>
                    <div class="add_photo_wrapper">
                        <div class="add_photo_title">Фото</div>
                        <input id="offer_photos_input" type="hidden" name="offer_photos" value="">
                        <div class="add_photo">
                            <label>
                                <input id="add-photo-offer-input" type="file" required accept="image/*">
                                <span class="add-offer-photo-text">Загрузить</span>
                            </label>
                        </div>
                    </div>
                    <div class="offer_img_wrapper" style="display: none">
                        <img src="" alt="" class="offer_img">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
