<?php

declare(strict_types=1);

?>
<div class="form_tab_title">
    1. Общая информация о клубе
</div>
<div class="form-group required">
    <label for="club-name-input">Название клуба</label>
    <div class="input_wrapper">
        <input id="club-name-input" name="club_name" type="text" placeholder="" required>
        <div class="error"></div>
    </div>
</div>
<div class="form-group required">
    <label for="select-сity">Город</label>
    <div class="input_wrapper">
        <div class="select2_wrapper">
            <select id="select-сity" name="club_city" required data-placeholder="Выберите город">
            <option value=""></option>
                <option value="moscow">Москва</option>
                <option value="saint-peterburg">Санкт-Петербург</option>
            </select>
            <div class="error"></div>
        </div>
    </div>
</div>
<div class="form-group required">
    <label for="club-phone-input">Телефон клуба</label>
    <div class="input_wrapper">
        <input id="club-phone-input" name="phone" type="tel" placeholder="+7 (___) ___-__-__" required>
        <div class="error"></div>
    </div>
</div>
<div class="form-group required">
    <label for="club-address-input">Адрес</label>
    <div class="input_wrapper">
        <input id="club-address-input" name="club_address" type="text" placeholder="" required>
        <div class="error"></div>
    </div>
</div>
<div class="form-group">
    <label for="select-subway">Метро</label>
    <div class="input_wrapper">
        <div class="select2_wrapper">
        <select id="select-subway" name="club_city" data-placeholder="Выберите метро" data-select2-manual-init>
                <option value="2" data-city="moscow" data-line-color="aqua">Выставочная</option>
                <option value="3" data-city="moscow" data-line-color="blue">Арбат</option>
                <option value="4" data-city="moscow" data-line-color="blue">Площадь революции</option>
                <option value="5" data-city="moscow" data-line-color="brown">Октябрьская</option>
                <option value="6" data-city="moscow" data-line-color="brown">Парк культуры</option>
                <option value="7" data-city="saint-peterburg" data-line-color="blue">Горьковская</option>
                <option value="8" data-city="saint-peterburg" data-line-color="blue">Невский</option>
                <option value="9" data-city="saint-peterburg" data-line-color="purple">Адмиралтейская</option>
                <option value="10" data-city="saint-peterburg" data-line-color="red">Чернышевская</option>
            </select>
            <div class="error"></div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="club-area-input">Общая площадь клуба</label>
    <div class="input_wrapper">
        <input id="club-area-input" name="club_area" type="number" min="1" step="1" placeholder="м2">
        <div class="error"></div>
    </div>
</div>
