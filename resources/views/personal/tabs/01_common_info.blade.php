<?php

declare(strict_types=1);

?>

<div class="form_tab_title">
    1. Общая информация о клубе
</div>
<div class="form-group required">
    <label for="club-name-input">Название клуба</label>
    <div class="input_wrapper">
        <input id="club-name-input" value="{{clubValue('club_name')}}" name="club_name" type="text" placeholder="" required>
        <div class="error"></div>
    </div>
</div>
<div class="form-group required">
    <label for="select-сity">Город</label>
    <div class="input_wrapper">
        <div class="select2_wrapper">
            <select id="select-сity" name="club_city" data-select2-skip-auto-init required data-placeholder="Выберите город">
                <option value=""></option>
                @if(!$edit)
                <option value="{{city(true)['id']}}" selected >{{city(true)['name']}}</option>
                @else
                   @if($clubAr->club_city != '')
                      @if($curCity = App\city::select('id','name','metroMap')->find($clubAr->club_city))
                        <option value="{{$curCity->id}}"  selected >{{$curCity->name}}</option>
                      @endif
                   @endif
                @endif
            </select>
            <div class="error"></div>
        </div>
    </div>
</div>
<div class="form-group required">
    <label for="club-phone-input">Телефон клуба</label>
    <div class="input_wrapper">
        <input id="club-phone-input" name="phone" value="{{clubValue('phone')}}" type="tel" placeholder="+7 (___) ___-__-__" required>
        <div class="error"></div>
    </div>
</div>
<div class="form-group required">
    <label for="club-address-input">Адрес</label>
    <div class="input_wrapper">
        <input id="club-address-input" value="{{clubValue('club_address')}}" type="text" placeholder="" autocomplete="off" required>
        <div class="error address_error"></div>
    </div>
</div>
<div class="form-group">
    <label for="select-subway">Метро</label>
    <div class="input_wrapper">
        <div class="select2_wrapper">
          <?
          $metro_disabled = true;
          if(!$edit){
              if(city(true)['metroMap'] == '1') $metro_disabled = false;
          }else{
            if($clubAr->club_city != '' && $curCity){
                if($curCity->metroMap == '1'){$metro_disabled = false;}
            }
          }
          ?>
            <select id="select-subway" name="club_metro" data-placeholder="Выберите метро" data-select2-skip-auto-init @if($metro_disabled) disabled @endif>
                <option value=""></option>
                @if(!$metro_disabled && clubValue('club_metro'))
                    @if($curMetro = App\metro::select('id','name','color')->find(clubValue('club_metro')))
                        <option value="{{$curMetro->id}}"  selected data-line-color="#{{$curMetro->color}}">{{$curMetro->name}}</option>
                    @endif
                @endif
            </select>
            <div class="error"></div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="club-area-input">Общая площадь клуба</label>
    <div class="input_wrapper">
        <input id="club-area-input" name="club_area" value="{{clubValue('club_area')}}"  type="number" min="1" step="1" placeholder="м2">
        <div class="error"></div>
    </div>
</div>
@if(admin())
<div class="form-group">
    <label for="rating-input">Отзыв клуба</label>
    <div class="input_wrapper">
        <input id="rating-input" name="rating" value="{{clubValue('rating')}}">
        <div class="error"></div>
    </div>
</div>
@endif
<input type="hidden" name="lat" id="lat" value="{{clubValue('lat')}}">
<input type="hidden" name="lon" id="lon" value="{{clubValue('lon')}}">
<input type="hidden" name="club_address" id="club_address" value="{{clubValue('club_address')}}">
<input type="hidden" name="club_full_address" id="club_full_address" value="{{clubValue('club_full_address')}}">
