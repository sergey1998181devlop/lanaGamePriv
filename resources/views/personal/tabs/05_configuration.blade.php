<?php

declare(strict_types=1);

?>
<div class="form_tab_title">
    5. Конфигурация оборудования
</div>

<div data-role="pc-configuration">
    <div class="pc_configuration_nav_wrapper">
        <div class="pc_configuration_nav_item">
            <ul data-role="pc-configuration-nav">
                <li data-nav-tab="0">
                    <a href="#" data-show-tab="0" class="active"></a>
                </li>
                <li data-nav-tab="1" data-block="vip_pc">
                    <a href="#" data-show-tab="1"></a>
                </li>
            </ul>

            <button class="add_pc_config" data-role="pc-configuration-create-tab"></button>
        </div>
    </div>

    <div class="pc_configuration_content_wrapper" data-role="pc-configuration-tabs">
        <div class="tab active" data-tab="0" data-role="pc-configuration-tab">
            <div class="form-group">
                <div class="pc_config">Оборудование</div>
                <div class="pc_config">
                    <input type="text" value="1. Общий зал" placeholder="Введите название" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="cpu-vendor-0">Процессор</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="cpu-vendor-0" name="configuration[0][cpu_vendor]" data-placeholder="Фирма" required>
                                <option value=""></option>
                                <option value="1">Фирма</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="cpu-model-0" name="configuration[0][cpu_model]" data-placeholder="Модель" required>
                                <option value=""></option>
                                <option value="1">Модель</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="video-vendor-0">Видеокарта</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="video-vendor-0" name="configuration[0][video_vendor]" data-placeholder="Фирма" required>
                                <option value=""></option>
                                <option value="1">Фирма</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="video-model-0" name="configuration[0][video_model]" data-placeholder="Модель" required>
                                <option value=""></option>
                                <option value="1">Модель</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="memory-size-0">Оперативная память</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="memory-size-0" name="configuration[0][memory_size]" data-placeholder="Объем" required>
                                <option value=""></option>
                                <option value="1">Объем</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="memory-type-0" name="configuration[0][memory_type]" data-placeholder="Тип" required>
                                <option value=""></option>
                                <option value="1">Тип</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="hard-disc-type-0">Жёсткий диск</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="hard-disc-type-0" name="configuration[0][hard_disc_type]" data-placeholder="Тип" required>
                            <option value=""></option>
                            <option value="1">Тип</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="keyboard-vendor-0">Клавиатура</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="keyboard-vendor-0" name="configuration[0][keyboard_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="mouse-vendor-0">Мышь</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="mouse-vendor-0" name="configuration[0][mouse_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="headphone-vendor-0">Гарнитура</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="headphone-vendor-0" name="configuration[0][headphone_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="chair-vendor-0">Кресло</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="chair-vendor-0" name="configuration[0][chair_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="monitor-vendor-0">Монитор</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="monitor-vendor-0" name="configuration[0][monitor_vendor]" data-placeholder="Фирма" required>
                                <option value=""></option>
                                <option value="1">Фирма</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="monitor-type-0" name="configuration[0][monitor_type]" data-placeholder="Тип" required>
                                <option value=""></option>
                                <option value="1">Тип</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="internet-0">Интернет</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="internet-0" name="configuration[0][internet]" data-placeholder="Скорость" required>
                            <option value=""></option>
                            <option value="1">Скорость</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab" data-tab="1" data-role="pc-configuration-tab" data-block="vip_pc">
            <div class="form-group">
                <div class="pc_config">Оборудование</div>
                <div class="pc_config">
                    <input type="text" value="2. VIP" placeholder="Введите название" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="cpu-vendor-1">Процессор</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="cpu-vendor-1" name="configuration[1][cpu_vendor]" data-placeholder="Фирма" required required>
                                <option value=""></option>
                                <option value="1">Фирма</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="cpu-model-1" name="configuration[1][cpu_model]" data-placeholder="Модель" required required>
                                <option value=""></option>
                                <option value="1">Модель</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="video-vendor-1">Видеокарта</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="video-vendor-1" name="configuration[1][video_vendor]" data-placeholder="Фирма" required required>
                                <option value=""></option>
                                <option value="1">Фирма</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="video-model-1" name="configuration[1][video_model]" data-placeholder="Модель" required required>
                                <option value=""></option>
                                <option value="1">Модель</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="memory-size-1">Оперативная память</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="memory-size-1" name="configuration[1][memory_size]" data-placeholder="Объем" required required>
                                <option value=""></option>
                                <option value="1">Объем</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="memory-type-1" name="configuration[1][memory_type]" data-placeholder="Тип" required required>
                                <option value=""></option>
                                <option value="1">Тип</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="hard-disc-type-1">Жёсткий диск</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="hard-disc-type-1" name="configuration[1][hard_disc_type]" data-placeholder="Тип" required required>
                            <option value=""></option>
                            <option value="1">Тип</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="keyboard-vendor-1">Клавиатура</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="keyboard-vendor-1" name="configuration[1][keyboard_vendor]" data-placeholder="Фирма" required required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="mouse-vendor-1">Мышь</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="mouse-vendor-1" name="configuration[1][mouse_vendor]" data-placeholder="Фирма" required required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="headphone-vendor-1">Гарнитура</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="headphone-vendor-1" name="configuration[1][headphone_vendor]" data-placeholder="Фирма" required required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="chair-vendor-1">Кресло</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="chair-vendor-1" name="configuration[1][chair_vendor]" data-placeholder="Фирма" required required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="monitor-vendor-1">Монитор</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="monitor-vendor-1" name="configuration[1][monitor_vendor]" data-placeholder="Фирма" required required>
                                <option value=""></option>
                                <option value="1">Фирма</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="monitor-type-1" name="configuration[1][monitor_type]" data-placeholder="Тип" required required>
                                <option value=""></option>
                                <option value="1">Тип</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="internet-1">Интернет</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="internet-1" name="configuration[1][internet]" data-placeholder="Скорость" required required>
                            <option value=""></option>
                            <option value="1">Скорость</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="configuration-tab-template">
    <div class="tab" data-tab="{n}" data-role="pc-configuration-tab">
        <div class="main-error">
            Заполните всю информацию об оборудовании в дополнительной зоне или удалите ее
        </div>
        <div class="form-group">
            <div class="pc_config">Оборудование</div>
            <div class="pc_config">
                <input type="text" value="" placeholder="Введите название">
            </div>
        </div>
        <div class="form-group">
            <label for="cpu-vendor-{n}">Процессор</label>
            <div class="input_wrapper">
                <div class="pc_config_select">
                    <div class="select2_wrapper">
                        <select id="cpu-vendor-{n}" name="configuration[{n}][cpu_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="cpu-model-{n}" name="configuration[{n}][cpu_model]" data-placeholder="Модель" required>
                            <option value=""></option>
                            <option value="1">Модель</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="video-vendor-{n}">Видеокарта</label>
            <div class="input_wrapper">
                <div class="pc_config_select">
                    <div class="select2_wrapper">
                        <select id="video-vendor-{n}" name="configuration[{n}][video_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="video-model-{n}" name="configuration[{n}][video_model]" data-placeholder="Модель" required>
                            <option value=""></option>
                            <option value="1">Модель</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="memory-size-{n}">Оперативная память</label>
            <div class="input_wrapper">
                <div class="pc_config_select">
                    <div class="select2_wrapper">
                        <select id="memory-size-{n}" name="configuration[{n}][memory_size]" data-placeholder="Объем" required>
                            <option value=""></option>
                            <option value="1">Объем</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="memory-type-{n}" name="configuration[{n}][memory_type]" data-placeholder="Тип" required>
                            <option value=""></option>
                            <option value="1">Тип</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="hard-disc-type-{n}">Жёсткий диск</label>
            <div class="input_wrapper">
                <div class="select2_wrapper">
                    <select id="hard-disc-type-{n}" name="configuration[{n}][hard_disc_type]" data-placeholder="Тип" required>
                        <option value=""></option>
                        <option value="1">Тип</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="keyboard-vendor-{n}">Клавиатура</label>
            <div class="input_wrapper">
                <div class="select2_wrapper">
                    <select id="keyboard-vendor-{n}" name="configuration[{n}][keyboard_vendor]" data-placeholder="Фирма" required>
                        <option value=""></option>
                        <option value="1">Фирма</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="mouse-vendor-{n}">Мышь</label>
            <div class="input_wrapper">
                <div class="select2_wrapper">
                    <select id="mouse-vendor-{n}" name="configuration[{n}][mouse_vendor]" data-placeholder="Фирма" required>
                        <option value=""></option>
                        <option value="1">Фирма</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="headphone-vendor-{n}">Гарнитура</label>
            <div class="input_wrapper">
                <div class="select2_wrapper">
                    <select id="headphone-vendor-{n}" name="configuration[{n}][headphone_vendor]" data-placeholder="Фирма" required>
                        <option value=""></option>
                        <option value="1">Фирма</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="chair-vendor-{n}">Кресло</label>
            <div class="input_wrapper">
                <div class="select2_wrapper">
                    <select id="chair-vendor-{n}" name="configuration[{n}][chair_vendor]" data-placeholder="Фирма" required>
                        <option value=""></option>
                        <option value="1">Фирма</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="monitor-vendor-{n}">Монитор</label>
            <div class="input_wrapper">
                <div class="pc_config_select">
                    <div class="select2_wrapper">
                        <select id="monitor-vendor-{n}" name="configuration[{n}][monitor_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            <option value="1">Фирма</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="monitor-type-{n}" name="configuration[{n}][monitor_type]" data-placeholder="Тип" required>
                            <option value=""></option>
                            <option value="1">Тип</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="internet-{n}">Интернет</label>
            <div class="input_wrapper">
                <div class="select2_wrapper">
                    <select id="internet-{n}" name="configuration[{n}][internet]" data-placeholder="Скорость" required>
                        <option value=""></option>
                        <option value="1">Скорость</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
</script>
