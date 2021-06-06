<?php

declare(strict_types=1);

?>
<div class="form_tab_title">
    2. Информация о базовых услугах
</div>
<div class="form-group required">
    <label for="qty_pc-input">Общее кол-во ПК</label>
    <div class="input_wrapper">
        <input id="qty_pc-input" name="qty_pc" type="number" placeholder="Количество" min="1" step="1" required>
        <div class="error"></div>
    </div>
</div>
<div class="form-group">
    <div class="checkbox_qty_wrapper">
        <label>
            <input type="checkbox" name="vip_pc" data-toggle-block='[data-block="vip_pc"]'>
            <span class="activator"><span></span></span>
            <span>VIP-компьютеры</span>
        </label>
    </div>
    <div class="input_wrapper" data-block="vip_pc">
        <input id="qty_vip-input" name="qty_vip_pc" type="number" placeholder="Количество" min="1" step="1" required>
        <div class="error"></div>
    </div>
</div>
<div class="form-group">
    <div class="checkbox_qty_wrapper">
        <label>
            <input type="checkbox" name="console" data-toggle-block='[data-block="console"]'>
            <span class="activator"><span></span></span>
            <span>Консоли</span>
        </label>
    </div>
    <div class="input_wrapper" data-block="console">
        <div class="console_select">
            <div class="select2_wrapper">
                <select class="type" id="console-type" name="console_type" required data-placeholder="Тип">
                    <option value=""></option>
                    <option value="1">1234</option>
                </select>
                <div class="error"></div>
            </div>
            <input id="qty_console-input" name="qty_console" type="number" placeholder="Количество" min="1" step="1" required>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="checkbox_qty_wrapper">
        <label>
            <input type="checkbox" name="food_drinks" data-toggle-block='[data-block="food_drinks"]'>
            <span class="activator"><span></span></span>
            <span>Еда и напитки</span>
        </label>
    </div>
    <div class="input_wrapper" data-block="food_drinks">
        <div class="select2_wrapper">
            <select class="type" id="food-drink-type" name="food_drink_type" required data-placeholder="Тип">
                <option value=""></option>
                <option value="1">123</option>
            </select>
            <div class="error"></div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="checkbox_qty_wrapper">
        <label>
            <input type="checkbox" name="vr" data-toggle-block='[data-block="vr"]'>
            <span class="activator"><span></span></span>
            <span>VR</span>
        </label>
    </div>
    <div class="input_wrapper" data-block="vr">
        <input id="qty_vr-input" name="qty_vr" type="number" placeholder="Количество" min="1" step="1" required>
        <div class="error"></div>
    </div>
</div>
<div class="form-group">
    <div class="checkbox_qty_wrapper">
        <label>
            <input type="checkbox" name="simulator" data-toggle-block='[data-block="simulator"]'>
            <span class="activator"><span></span></span>
            <span>Автосимулятор</span>
        </label>
    </div>
    <div class="input_wrapper" data-block="simulator">
        <input id="qty_simulator-input" name="qty_simulator" type="number" placeholder="Количество" min="1" step="1" required>
        <div class="error"></div>
    </div>
</div>
