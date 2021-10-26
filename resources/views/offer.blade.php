
<a href="#" class="offer_item" data-id="{{$offer->id}}" data-remodal-target="<?= !owner() ? 'company_offers_alert' : 'company_offers_modal_'.$offer->id?>">
    <div class="img_wrapper">
        <img src="{{($offer->image != '') ? url('storage/offers/'.$offer->image) : asset('img/default-club-preview-image.svg')}}"
                alt="image">
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
@if(!player())
<div class="remodal company_offers_modal" data-remodal-id="company_offers_modal_{{$offer->id}}" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="title">{{strip_tags($offer->about)}}</div>
        <div class="offer_content_wrapper">
            <div class="offer_content_item">
                <div class="img_wrapper">
                    <img src="{{($offer->image != '') ? url('storage/offers/'.$offer->image) : asset('img/default-club-preview-image.svg')}}"
                            alt="image">
                </div>
                <div class="subtitle">Контактное лицо</div>
                <div class="contact_name">{{$offer->user_name}}</div>
                <button type="button" class="offer_btn show_offer_contacts" data-id="{{$offer->id}}">Показать контакт</button>
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
@endif
