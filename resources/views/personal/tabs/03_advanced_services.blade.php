<?php

declare(strict_types=1);

?>

<div class="form_tab_title">
    3. Выберите дополнительные услуги, предоставляемые вашим клубом
</div>
<div class="checkbox_wrapper">
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('hookah') == '1') ? 'checked' : null}} name="hookah" data-hookah-service>
            <span class="activator"><span></span></span>
            <span>Есть кальяны</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('streamer') == '1') ? 'checked' : null}} name="streamer">
            <span class="activator"><span></span></span>
            <span>Есть стримерская</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('alcohol') == '1') ? 'checked' : null}} name="alcohol" data-alcohol-service>
            <span class="activator"><span></span></span>
            <span>Есть алкоголь в продаже</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('with_own_device') == '1') ? 'checked' : null}} name="with_own_device">
            <span class="activator"><span></span></span>
            <span>Можно со своими девайсами</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('bathroom') == '1') ? 'checked' : null}} name="bathroom">
            <span class="activator"><span></span></span>
            <span>Есть санузел</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('club_account') == '1') ? 'checked' : null}} name="club_account">
            <span class="activator"><span></span></span>
            <span>Предоставляем клубные аккаунты для гостей</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('checkroom') == '1') ? 'checked' : null}} name="checkroom">
            <span class="activator"><span></span></span>
            <span>Есть гардероб</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('download_app') == '1') ? 'checked' : null}} name="download_app">
            <span class="activator"><span></span></span>
            <span>Можно скачивать игры и приложения</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('conditioner') == '1') ? 'checked' : null}} name="conditioner">
            <span class="activator"><span></span></span>
            <span>Есть кондиционер</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('smoke') == '1') ? 'checked' : null}} name="smoke">
            <span class="activator"><span></span></span>
            <span>Можно курить вейпы, электронные сигареты</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('print') == '1') ? 'checked' : null}} name="print">
            <span class="activator"><span></span></span>
            <span>Есть печать документов</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('with_own_food') == '1') ? 'checked' : null}} name="with_own_food" data-food-service>
            <span class="activator"><span></span></span>
            <span>Можно со своей едой</span>
        </label>
    </div>
    <div class="checkbox_item">
        <label>
            <input type="checkbox" {{(clubValue('tsena') == '1') ? 'checked' : null}} name="tsena">
            <span class="activator"><span></span></span>
            <span>Есть сцена и зрительный зал</span>
        </label>
    </div>
</div>
