<?php

declare(strict_types=1);

?>

<div class="form_tab_title">
    7. Дополнительная информация
</div>
<div class="form-group">
    <label for="club-site-input">Сайт клуба</label>
    <div class="input_wrapper">
        <input id="club-site-input" value="{{clubValue('club_site')}}" name="club_site" type="text" data-type="url" placeholder="">
        <div class="error"></div>
    </div>

</div>
<div class="form-group">
    <label for="club-email-input">Email клуба</label>
    <div class="input_wrapper">
        <input id="club-email-input"  value="{{clubValue('club_email')}}" name="club_email" type="email" placeholder="">
        <div class="error"></div>
    </div>

</div>
<div class="form-group">
    <label for="club-link-input">Ссылка на клуб (2ГИС, Яндекс.Карты, Google Maps)</label>
    <div class="input_wrapper">
        <input id="club-link-input"  value="{{clubValue('club_link')}}" name="club_link" type="text" data-type="url" placeholder="">
        <div class="error"></div>
    </div>

</div>
<div class="form-group">
    <label for="club-vk-link-input">Группа ВК</label>
    <div class="input_wrapper">
        <input id="club-vk-link-input"  value="{{clubValue('club_vk_link')}}" name="club_vk_link" type="text" data-type="url" placeholder="">
        <div class="error"></div>
    </div>

</div>
<div class="form-group">
    <label for="club-instagram-link-input">Instagram</label>
    <div class="input_wrapper">
        <input id="club-instagram-link-input"  value="{{clubValue('club_instagram_link')}}" name="club_instagram_link" type="text" data-type="url" placeholder="">
        <div class="error"></div>
    </div>

</div>
