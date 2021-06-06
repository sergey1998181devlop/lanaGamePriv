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
                <option value="2">Москва</option>
                <option value="3">Санкт-Петербург</option>
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
            <select id="select-subway" name="club_city" data-placeholder="Выберите метро">
                <option value=""></option>
                <option value="1">Не указан</option>
                <option value="2">Сокол</option>
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
