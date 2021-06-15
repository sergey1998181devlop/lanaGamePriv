<?php

declare(strict_types=1);

?>
<div class="form_tab_title">
    4. График работы
</div>

<div class="radiobox_wrapper">
    <label>
        <input type="radio"
               name="work_time"
               {{(clubValue('work_time') != '2') ? 'checked' : null}}
               value="24/7"
               data-disable-block='[data-block="work_time"]'>
        <span class="activator"><span></span></span>
        <span>Круглосуточно</span>
    </label>
    <label>
        <input type="radio"
               name="work_time"
               {{(clubValue('work_time') == '2') ? 'checked' : null}}
               value="not-24/7"
               data-activate-block='[data-block="work_time"]'
               data-week-schedule>
        <span class="activator"><span></span></span>
        <span>Не круглосуточно</span>
    </label>
</div>
<div class="work_time_wrapper" data-block="work_time">
    <div class="error work_time_wrapper_error"></div>
    <div class="form-group">
        <div class="work_time_item">
            <label>
                <input type="checkbox" name="monday" {{(checkDays('monday')) ? 'checked' : null}} data-toggle-block='[data-block="monday"]' data-day-schedule>
                <span class="activator"><span></span></span>
                <span>Понедельник</span>
            </label>
        </div>
        <div class="input_wrapper" data-block="monday">
            <div class="work_time_select">
                <div class="select2_wrapper">
                    <select id="monday_work_from" name="monday_work_from" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('monday','from')!!}
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="monday_work_to" name="monday_work_to" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('monday')!!}
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="work_time_item">
            <label>
                <input type="checkbox" name="tuesday" {{(checkDays('tuesday')) ? 'checked' : null}} data-toggle-block='[data-block="tuesday"]' data-day-schedule>
                <span class="activator"><span></span></span>
                <span>Вторник</span>
            </label>
        </div>
        <div class="input_wrapper" data-block="tuesday">
            <div class="work_time_select">
                <div class="select2_wrapper">
                    <select id="tuesday_work_from" name="tuesday_work_from" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('tuesday','from')!!}
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="tuesday_work_to" name="tuesday_work_to" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('tuesday')!!}
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="work_time_item">
            <label>
                <input type="checkbox" name="wednesday" {{(checkDays('wednesday')) ? 'checked' : null}} data-toggle-block='[data-block="wednesday"]' data-day-schedule>
                <span class="activator"><span></span></span>
                <span>Среда</span>
            </label>
        </div>
        <div class="input_wrapper" data-block="wednesday">
            <div class="work_time_select">
                <div class="select2_wrapper">
                    <select id="wednesday_work_from" name="wednesday_work_from" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('wednesday','from')!!}
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="wednesday_work_to" name="wednesday_work_to" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('wednesday')!!}
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="work_time_item">
            <label>
                <input type="checkbox" name="thursday" {{(checkDays('thursday')) ? 'checked' : null}} data-toggle-block='[data-block="thursday"]' data-day-schedule>
                <span class="activator"><span></span></span>
                <span>Четверг</span>
            </label>
        </div>
        <div class="input_wrapper" data-block="thursday">
            <div class="work_time_select">
                <div class="select2_wrapper">
                    <select id="thursday_work_from" name="thursday_work_from" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('thursday','from')!!}
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="thursday_work_to" name="thursday_work_to" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('thursday')!!}
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="work_time_item">
            <label>
                <input type="checkbox" name="friday" {{(checkDays('friday')) ? 'checked' : null}} data-toggle-block='[data-block="friday"]' data-day-schedule>
                <span class="activator"><span></span></span>
                <span>Пятница</span>
            </label>
        </div>
        <div class="input_wrapper" data-block="friday">
            <div class="work_time_select">
                <div class="select2_wrapper">
                    <select id="friday_work_from" name="friday_work_from" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('friday','from')!!}
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="friday_work_to" name="friday_work_to" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('friday')!!}
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="work_time_item">
            <label>
                <input type="checkbox" name="saturday" {{(checkDays('saturday')) ? 'checked' : null}} data-toggle-block='[data-block="saturday"]' data-day-schedule>
                <span class="activator"><span></span></span>
                <span>Суббота</span>
            </label>
        </div>
        <div class="input_wrapper" data-block="saturday">
            <div class="work_time_select">
                <div class="select2_wrapper">
                    <select id="saturday_work_from" name="saturday_work_from" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('saturday','from')!!}
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="saturday_work_to" name="saturday_work_to" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('saturday')!!}
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="work_time_item">
            <label>
                <input type="checkbox" name="sunday" {{(checkDays('sunday')) ? 'checked' : null}} data-toggle-block='[data-block="sunday"]' data-day-schedule>
                <span class="activator"><span></span></span>
                <span>Воскресенье</span>
            </label>
        </div>
        <div class="input_wrapper" data-block="sunday">
            <div class="work_time_select">
                <div class="select2_wrapper">
                    <select id="sunday_work_from" name="sunday_work_from" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('sunday','from')!!}
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="sunday_work_to" name="sunday_work_to" data-select2-without-search required>
                        <option value=""></option>
                        {!!hours('sunday')!!}
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
</div>
