<?php

declare(strict_types=1);

?>

<div class="form_tab_title">
    6. Цены и акции
</div>

<div class="form-group required">
    <label for="min-price-input">
        Миниальная стоимость часа
        (без учёта акций и пакетов)
    </label>
    <div class="input_wrapper">
        <input id="min-price-input" name="club_min_price" type="number" placeholder="Введите стоимость" min="1" required>
        <div class="error"></div>
    </div>
</div>

<div class="form-group">
    <label for="add-price-file-input">
        Загрузите прайс-лист на все ваши игровые услуги
    </label>
    <div class="input_wrapper">
        <div class="add_file_wrapper">
            <label>
                <input id="add-price-file-input" type="file">
                <input type="hidden" id="add-price-file-hidden-input" name="club_price_file">
                <span id="add-price-file-text">Загрузить файл</span>
            </label>
        </div>
        <div class="error"></div>
    </div>
</div>

<div class="marketing_event_wrapper">

        <div class="checkbox_wrapper">
            <label>
                <input type="checkbox" name="marketing_event" data-toggle-block='[data-block="marketing_event"]'>
                <span class="activator"><span></span></span>
                <span>У нас действуют акции</span>
            </label>
        </div>

    <div class="marketing_event" data-block="marketing_event">
        <div class="marketing_event_list">
            <div class="form-group" >
                <label for="marketing-event-input[1]">Акция №</label>
                <div class="input_wrapper" >
                    <input id="marketing-event-input[1]" name="marketing_event_descr[]" type="text" placeholder="Описание акции" required>
                    <div class="error"></div>
                </div>
            </div>
        </div>
        <button type="button" data-role="marketing-event-add-tab">Добавить акцию</button>
    </div>
</div>


<div class="payment_method_wrapper">
    <div class="payment_method_title">
        <span>Выберите способы оплаты</span>
    </div>
    <div class="payment_method_list">
        <div class="payment_method_item">
            <label>
                <input type="checkbox" name="payment_cash" checked data-payment-method>
                <span class="activator"><span>Наличные</span></span>
            </label>
        </div>
        <div class="payment_method_item" >
            <label>
                <input type="checkbox" name="payment_cards" data-payment-method>
                <span class="activator"><span>Карты</span></span>
            </label>
        </div>
        <div class="payment_method_item">
            <label>
                <input type="checkbox" name="payment_online" data-payment-method>
                <span class="activator"><span>Online-перевод</span></span>
            </label>
        </div>
        <div class="payment_method_item">
            <label>
                <input type="checkbox" name="payment_web_wallet" data-payment-method>
                <span class="activator"><span>Web-кошельки</span></span>
            </label>
        </div>
        <div class="payment_method_item">
            <label>
                <input type="checkbox" name="payment_account_number" data-payment-method>
                <span class="activator"><span>По счёту</span></span>
            </label>
        </div>
    </div>
    <div class="error"></div>
</div>