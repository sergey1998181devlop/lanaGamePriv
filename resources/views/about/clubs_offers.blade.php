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
                            @if(isset( $offersBrand  ) && count($offersBrand)>0)
                                <div class="company_offers_list">
                                    @foreach($offersBrand as $offer)
                                        <a href="#" class="offer_item" data-id="{{$offer->id}}" data-remodal-target="company_offers_modal_{{$offer->id}}">
                                            <div class="img_wrapper">
                                                <img src="{{($offer->image != '') ? url('storage/offers/'.$offer->image) : asset('img/default-club-preview-image.svg')}}" alt="image">
                                            </div>
                                            <div class="info_wrapper">
                                                <div class="descr">
                                                    {{strip_tags($offer->about)}}
                                                </div>
                                                <div class="btn_wrapper">
                                                    <button type="button" class="btn_detail">Подробнее</button>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="remodal company_offers_modal" data-remodal-id="company_offers_modal_{{$offer->id}}" data-remodal-options="hashTracking: false">
                                            <button data-remodal-action="close" class="remodal-close"></button>
                                            <div class="remodal-content">
                                                <div class="title">{{strip_tags($offer->about)}}</div>
                                                <div class="offer_content_wrapper">
                                                    <div class="offer_content_item">
                                                        <div class="img_wrapper">
                                                            <img src="{{($offer->image != '') ? url('storage/offers/'.$offer->image) : asset('img/default-club-preview-image.svg')}}" alt="image">
                                                        </div>
                                                        <div class="subtitle">Контактное лицо</div>
                                                        <div class="contact_name">{{$offer->user_name}}</div>
                                                        <button type="button" class="offer_btn show_offer_contacts" data-id="{{$offer->id}}" >Показать контакт</button>
                                                        <div class="contacts_wrapper">
                                                            @if( $offer->user_phone != "" )
                                                            <div class="club_contact">
                                                                <img src="{{asset('/img/phone.svg')}}" alt="phone">
                                                                <a href="tel:{{$offer->user_phone}}">{{$offer->user_phone}}</a>
                                                            </div>
                                                            @endif

                                                            @if( $offer->user_email != "" )
                                                            <div class="club_contact">
                                                                <img src="{{asset('/img/mail.svg')}}" alt="email">
                                                                <a href="mailto:{{$offer->user_email}}">{{$offer->user_email}}</a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="offer_content_item">
                                                        <div class="subtitle text_decor">Подробные условия</div>
                                                        <div class="offer_info_text_wrapper">
                                                            <div class="offer_info_text" data-simplebar>
                                                                {!!$offer->description!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if(isset( $offersBrand ) && count($offersBrand)>6)
                                    <a id="show_more_company_offers" class="show_more pointer">Показать ещё</a>
                                @endif
                            @endif
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
                                <button class="offer_instr_toggle_mobile"></button>
                            </div>
                            @if(count($offersClub)==0)
                                <div class="instr">
                                    Здесь пока нет объявлений от клубов. Будьте первыми!
                                </div>
                            @endif
                            @if(isset( $offersClub ) && count($offersClub)>0)
                                <div class="clubs_offers_list">
                                    @foreach($offersClub as $offer)

                                        <a href="#" class="offer_item" data-id="{{$offer->id}}" data-remodal-target="clubs_offers_modal_{{$offer->id}}">
                                            <div class="img_wrapper">
                                                <img src="{{($offer->image != '') ? url('storage/offers/'.$offer->image) : asset('img/default-club-preview-image.svg')}}" alt="image">
                                            </div>
                                            <div class="info_wrapper">
                                                <div class="info_item">
                                                    <div class="title">{{$offer->name}}</div>
                                                    <div class="descr">
                                                    {{$offer->about}}
                                                    </div>
                                                </div>
                                                <div class="info_item">
                                                    <div class="price">{{$offer->price}} ₽</div>
                                                    <div class="club_name">Клуб: <span>{{$offer->user_link}}</span></div>
                                                    <div class="date">Дата публикации: <span>{{$offer->created_at}}</span></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="remodal clubs_offers_modal" data-remodal-id="clubs_offers_modal_{{$offer->id}}" data-remodal-options="hashTracking: false">
                                            <button data-remodal-action="close" class="remodal-close"></button>
                                            <div class="remodal-content">
                                                <div class="title">
                                                    <span>{{$offer->name}}</span>
                                                    <span>{{$offer->price}} ₽</span>
                                                </div>
                                                <div class="offer_content_wrapper">
                                                    <div class="offer_content_item">
                                                        <div class="img_wrapper">
                                                            <img src="{{($offer->image != '') ? url('storage/offers/'.$offer->image) : asset('img/default-club-preview-image.svg')}}" alt="image">
                                                        </div>
                                                        <div class="subtitle">Клуб</div>
                                                        <div class="contact_name">{{$offer->user_link}}</div>
                                                        <div class="subtitle">Дата публикации</div>
                                                        <div class="contact_name">{{$offer->created_at}}</div>
                                                        <div class="subtitle">Контактное лицо</div>
                                                        <div class="contact_name">{{$offer->user_name}}</div>
                                                        <button type="button" class="offer_btn show_offer_contacts" data-id="{{$offer->id}}" >Показать контакт</button>
                                                        <div class="contacts_wrapper">
                                                            @if( $offer->user_phone != "" )
                                                            <div class="club_contact">
                                                                <img src="{{asset('/img/phone.svg')}}" alt="phone">
                                                                <a href="tel:{{$offer->user_phone}}">{{$offer->user_phone}}</a>
                                                            </div>
                                                            @endif
                                                            @if( $offer->user_email != "" )
                                                            <div class="club_contact">
                                                                <img src="{{asset('/img/mail.svg')}}" alt="email">
                                                                <a href="mailto:{{$offer->user_email}}">{{$offer->user_email}}</a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="offer_content_item">
                                                        <div class="subtitle text_decor">Описание</div>
                                                        <div class="offer_info_text_wrapper">
                                                            <div class="offer_info_text" data-simplebar>
                                                                {!!$offer->description!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                                @if(isset( $offersClub ) && count($offersClub)>6)
                                    <a id="show_more_club_offers" class="show_more pointer">Показать ещё</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab" id="tab6" style="display: none">
                    <div class="club_list_content"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="remodal add_offer_modal" data-remodal-id="add_offer_modal" data-remodal-options="hashTracking: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="remodal-content">
            <form action="/clubs-offers/add" method="post" id="add-offer-form">
            {{ csrf_field() }}
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
                        <textarea name="description" id="offer-descr-input" maxlength="1500" required></textarea>
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

@section('scripts')
    <script>
        $(document).on('click', '.offer_item', function() {
            jQuery.ajax({
                type: 'get',
                url: '{{url('/')}}/offer/views/'+$(this).attr("data-id"),
                data: '',
                success: function(data) {
                    console.log(data);
                }
            });
        });
        $(document).on('click', '.show_offer_contacts', function() {
            jQuery.ajax({
                type: 'get',
                url: '{{url('/')}}/offer/views_click/'+$(this).attr("data-id"),
                data: '',
                success: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
