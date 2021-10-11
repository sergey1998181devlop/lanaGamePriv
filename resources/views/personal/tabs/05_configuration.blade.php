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
                @if($edit && is_array($configuration) && count($configuration) > 1)
                    <?foreach($configuration as $key=>$confTap){
                         if($key == 0 || $key== 1)continue;
                         ?>
                        <li data-nav-tab="{{$key}}">
                            <a href="#" data-show-tab="{{$key}}"></a>
                            <button type="button" data-remove-tab="{{$key}}"></button>
                        </li>
                    <?}?>
                @endif
            </ul>

            <button class="add_pc_config" data-role="pc-configuration-create-tab"></button>
        </div>
    </div>

    <div class="pc_configuration_content_wrapper" data-role="pc-configuration-tabs">
        <div class="tab active" data-tab="0" data-role="pc-configuration-tab">
            <div class="form-group">
                <div class="pc_config">Оборудование</div>
                <div class="pc_config">
                    <input type="text" value="1. Общий зал" readonly>
                    <input type="hidden" value="Общий зал" name="configuration[0][conf_name]" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="cpu-vendor-0">Процессор</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="cpu-vendor-0" name="configuration[0][cpu_vendor]" data-placeholder="Фирма" required>
                                <option value=""></option>
                                @foreach($cpus as $key=>$vendor)
                                    <option value="{{$key}}" {{(getConf('cpu_vendor','0') === $key) ? 'selected' : null}}>{{$key}}</option>
                                @endforeach
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="cpu-model-0" name="configuration[0][cpu_model]" data-placeholder="Модель" data-select2-depends-on="#cpu-vendor-0" required>
                                <option value=""></option>
                                @foreach($cpus as $key=>$vendor)
                                    @foreach($vendor as $model)
                                        <option value="{{$model}}" {{(getConf('cpu_model','0') === $model) ? 'selected' : null}} data-depend-value="{{$key}}">{{$model}}</option>
                                    @endforeach
                                @endforeach
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
                                @foreach($videoCards as $key=>$vendor)
                                    <option value="{{$key}}" {{(getConf('video_vendor','0') === $key) ? 'selected' : null}}>{{$key}}</option>
                                @endforeach
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="video-model-0" name="configuration[0][video_model]" data-placeholder="Модель" data-select2-depends-on="#video-vendor-0" required>
                                <option value=""></option>
                                @foreach($videoCards as $key=>$vendor)
                                    @foreach($vendor as $model)
                                        <option value="{{$model}}" {{(getConf('video_model','0') === $model) ? 'selected' : null}} data-depend-value="{{$key}}">{{$model}}</option>
                                    @endforeach
                                @endforeach
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
                                <option value="4 Gb" {{(getConf('memory_size','0') == '4 Gb') ? 'selected' : null}}>4 Gb</option>
                                <option value="6 Gb" {{(getConf('memory_size','0') == '6 Gb') ? 'selected' : null}}>6 Gb</option>
                                <option value="8 Gb" {{(getConf('memory_size','0') == '8 Gb') ? 'selected' : null}}>8 Gb</option>
                                <option value="16 Gb" {{(getConf('memory_size','0') == '16 Gb') ? 'selected' : null}}>16 Gb</option>
                                <option value="32 Gb" {{(getConf('memory_size','0') == '32 Gb') ? 'selected' : null}}>32 Gb</option>
                                <option value="64 Gb" {{(getConf('memory_size','0') == '64 Gb') ? 'selected' : null}}>64 Gb</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="memory-type-0" name="configuration[0][memory_type]" data-placeholder="Тип" required>
                                <option value=""></option>
                                <option value="DDR3" {{(getConf('memory_type','0') == 'DDR3') ? 'selected' : null}}>DDR3</option>
                                <option value="DDR4" {{(getConf('memory_type','0') == 'DDR4') ? 'selected' : null}}>DDR4</option>
                                <option value="DDR5" {{(getConf('memory_type','0') == 'DDR5') ? 'selected' : null}}>DDR5</option>
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
                            <option value="HDD" {{(getConf('hard_disc_type','0') == 'HDD') ? 'selected' : null}}>HDD</option>
                            <option value="SSD" {{(getConf('hard_disc_type','0') == 'SSD') ? 'selected' : null}}>SSD</option>
                            <option value="SSD+HDD" {{(getConf('hard_disc_type','0') == 'SSD+HDD') ? 'selected' : null}}>SSD+HDD</option>
                            <option value="Бездисковая система" {{(getConf('hard_disc_type','0') == 'Бездисковая система') ? 'selected' : null}}>Бездисковая система</option>
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
                            @foreach ($keybords as $vendor)
                                <option value="{{$vendor}}" {{(getConf('keyboard_vendor','0') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                            @endforeach
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
                            @foreach ($mouses as $vendor)
                                <option value="{{$vendor}}" {{(getConf('mouse_vendor','0') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                            @endforeach
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
                            @foreach ($headphones as $vendor)
                                <option value="{{$vendor}}" {{(getConf('headphone_vendor','0') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                            @endforeach
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
                            @foreach ($chairs as $vendor)
                                <option value="{{$vendor}}" {{(getConf('chair_vendor','0') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                            @endforeach
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
                                @foreach ($monitors as $vendor)
                                <option value="{{$vendor}}" {{(getConf('monitor_vendor','0') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                                @endforeach
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="monitor-type-0" name="configuration[0][monitor_type]" data-placeholder="Дюймы" required>
                                <option value=""></option>
                                @foreach ($monitor_types as $vendor)
                                <option value="{{$vendor}}" {{(getConf('monitor_type','0') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                                @endforeach
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="monitor-hertz-0" name="configuration[0][monitor_hertz]" data-placeholder="Гц" required>
                                <option value=""></option>
                                @foreach ($monitor_hertz as $vendor)
                                <option value="{{$vendor}}" {{(getConf('monitor_hertz','0') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                                @endforeach
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
                            <option value="<100 Мбит" {{(getConf('internet','0') == '<100 Мбит') ? 'selected' : null}}>&lt;100 Мбит</option>
                            <option value=">100 Мбит" {{(getConf('internet','0') == '>100 Мбит') ? 'selected' : null}}>&gt;100 Мбит</option>
                            <option value=">1 Гбит" {{(getConf('internet','0') == '>1 Гбит') ? 'selected' : null}}>&gt;1 Гбит</option>
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
                    <input type="text" class="vip_placeholder" value="2. VIP" placeholder="2. VIP" readonly>
                    <input type="hidden" value="VIP" name="configuration[1][conf_name]" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="cpu-vendor-1">Процессор</label>
                <div class="input_wrapper">
                    <div class="pc_config_select">
                        <div class="select2_wrapper">
                            <select id="cpu-vendor-1" name="configuration[1][cpu_vendor]" data-placeholder="Фирма" required>
                                <option value=""></option>
                                @foreach($cpus as $key=>$vendor)
                                    <option value="{{$key}}" {{(getConf('cpu_vendor','1') === $key) ? 'selected' : null}}>{{$key}}</option>
                                @endforeach
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="cpu-model-1" name="configuration[1][cpu_model]" data-placeholder="Модель" data-select2-depends-on="#cpu-vendor-1" required>
                                <option value=""></option>
                                @foreach($cpus as $key=>$vendor)
                                    @foreach($vendor as $model)
                                        <option value="{{$model}}" {{(getConf('cpu_model','1') === $model) ? 'selected' : null}} data-depend-value="{{$key}}">{{$model}}</option>
                                    @endforeach
                                @endforeach
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
                            <select id="video-vendor-1" name="configuration[1][video_vendor]" data-placeholder="Фирма" required>
                                <option value=""></option>
                                @foreach($videoCards as $key=>$vendor)
                                    <option value="{{$key}}" {{(getConf('video_vendor','1') === $key) ? 'selected' : null}}>{{$key}}</option>
                                @endforeach
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="video-model-1" name="configuration[1][video_model]" data-placeholder="Модель" data-select2-depends-on="#video-vendor-1" required>
                                <option value=""></option>
                                @foreach($videoCards as $key=>$vendor)
                                    @foreach($vendor as $model)
                                        <option value="{{$model}}" {{(getConf('video_model','1') === $model) ? 'selected' : null}} data-depend-value="{{$key}}">{{$model}}</option>
                                    @endforeach
                                @endforeach
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
                            <select id="memory-size-1" name="configuration[1][memory_size]" data-placeholder="Объем" required>
                                <option value=""></option>
                                <option value="4 Gb" {{(getConf('memory_size','1') == '4 Gb') ? 'selected' : null}}>4 Gb</option>
                                <option value="6 Gb" {{(getConf('memory_size','1') == '6 Gb') ? 'selected' : null}}>6 Gb</option>
                                <option value="8 Gb" {{(getConf('memory_size','1') == '8 Gb') ? 'selected' : null}}>8 Gb</option>
                                <option value="16 Gb" {{(getConf('memory_size','1') == '16 Gb') ? 'selected' : null}}>16 Gb</option>
                                <option value="32 Gb" {{(getConf('memory_size','1') == '32 Gb') ? 'selected' : null}}>32 Gb</option>
                                <option value="64 Gb" {{(getConf('memory_size','1') == '64 Gb') ? 'selected' : null}}>64 Gb</option>
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="memory-type-1" name="configuration[1][memory_type]" data-placeholder="Тип" required>
                                <option value=""></option>
                                <option value="DDR3" {{(getConf('memory_type','1') == 'DDR3') ? 'selected' : null}}>DDR3</option>
                                <option value="DDR4" {{(getConf('memory_type','1') == 'DDR4') ? 'selected' : null}}>DDR4</option>
                                <option value="DDR5" {{(getConf('memory_type','1') == 'DDR5') ? 'selected' : null}}>DDR5</option>
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
                        <select id="hard-disc-type-1" name="configuration[1][hard_disc_type]" data-placeholder="Тип" required>
                            <option value=""></option>
                            <option value="HDD" {{(getConf('hard_disc_type','1') == 'HDD') ? 'selected' : null}}>HDD</option>
                            <option value="SSD" {{(getConf('hard_disc_type','1') == 'SSD') ? 'selected' : null}}>SSD</option>
                            <option value="SSD+HDD" {{(getConf('hard_disc_type','1') == 'SSD+HDD') ? 'selected' : null}}>SSD+HDD</option>
                            <option value="Бездисковая система" {{(getConf('hard_disc_type','1') == 'Бездисковая система') ? 'selected' : null}}>Бездисковая система</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="keyboard-vendor-1">Клавиатура</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="keyboard-vendor-1" name="configuration[1][keyboard_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            @foreach ($keybords as $vendor)
                                <option value="{{$vendor}}" {{(getConf('keyboard_vendor','1') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                            @endforeach
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="mouse-vendor-1">Мышь</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="mouse-vendor-1" name="configuration[1][mouse_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            @foreach ($mouses as $vendor)
                                <option value="{{$vendor}}" {{(getConf('mouse_vendor','1') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                            @endforeach
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="headphone-vendor-1">Гарнитура</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="headphone-vendor-1" name="configuration[1][headphone_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            @foreach ($headphones as $vendor)
                                <option value="{{$vendor}}" {{(getConf('headphone_vendor','1') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                            @endforeach
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="chair-vendor-1">Кресло</label>
                <div class="input_wrapper">
                    <div class="select2_wrapper">
                        <select id="chair-vendor-1" name="configuration[1][chair_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                            @foreach ($chairs as $vendor)
                                <option value="{{$vendor}}" {{(getConf('chair_vendor','1') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                            @endforeach
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
                            <select id="monitor-vendor-1" name="configuration[1][monitor_vendor]" data-placeholder="Фирма" required>
                                <option value=""></option>
                                @foreach ($monitors as $vendor)
                                <option value="{{$vendor}}" {{(getConf('monitor_vendor','1') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                                @endforeach
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="monitor-type-1" name="configuration[1][monitor_type]" data-placeholder="Тип" required>
                                <option value=""></option>
                                @foreach ($monitor_types as $vendor)
                                <option value="{{$vendor}}" {{(getConf('monitor_type','1') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                                @endforeach
                            </select>
                            <div class="error"></div>
                        </div>
                        <div class="select2_wrapper">
                            <select id="monitor-hertz-1" name="configuration[1][monitor_hertz]" data-placeholder="Гц" required>
                                <option value=""></option>
                                @foreach ($monitor_hertz as $vendor)
                                <option value="{{$vendor}}" {{(getConf('monitor_hertz','1') == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                                @endforeach
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
                        <select id="internet-1" name="configuration[1][internet]" data-placeholder="Скорость" required>
                            <option value=""></option>
                            <option value="<100 Мбит" {{(getConf('internet','1') == '<100 Мбит') ? 'selected' : null}}>&lt;100 Мбит</option>
                            <option value=">100 Мбит" {{(getConf('internet','1') == '>100 Мбит') ? 'selected' : null}}>&gt;100 Мбит</option>
                            <option value=">1 Гбит" {{(getConf('internet','1') == '>1 Гбит') ? 'selected' : null}}>&gt;1 Гбит</option>
                        </select>
                        <div class="error"></div>
                    </div>
                </div>
            </div>
        </div>
        @if($edit && is_array($configuration) && count($configuration) > 1)
            <?foreach($configuration as $tabKey=>$confTap){
                    if($tabKey == 0 || $tabKey== 1)continue;
                    ?>
                @include('personal.tabs.confTab')
            <?}?>
        @endif
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
                <input type="text" name="configuration[{n}][conf_name]" placeholder="Введите название">
            </div>
        </div>
        <div class="form-group">
            <label for="cpu-vendor-{n}">Процессор</label>
            <div class="input_wrapper">
                <div class="pc_config_select">
                    <div class="select2_wrapper">
                        <select id="cpu-vendor-{n}" name="configuration[{n}][cpu_vendor]" data-placeholder="Фирма" required>
                            <option value=""></option>
                                @foreach($cpus as $key=>$vendor)
                                    <option value="{{$key}}">{{$key}}</option>
                                @endforeach
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="cpu-model-{n}" name="configuration[{n}][cpu_model]" data-placeholder="Модель" data-select2-depends-on="#cpu-vendor-{n}" required>
                            <option value=""></option>
                            @foreach($cpus as $key=>$vendor)
                                    @foreach($vendor as $model)
                                        <option value="{{$model}}" data-depend-value="{{$key}}">{{$model}}</option>
                                    @endforeach
                                @endforeach
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
                                @foreach($videoCards as $key=>$vendor)
                                    <option value="{{$key}}">{{$key}}</option>
                                @endforeach
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="video-model-{n}" name="configuration[{n}][video_model]" data-placeholder="Модель" data-select2-depends-on="#video-vendor-{n}" required>
                            <option value=""></option>
                            @foreach($videoCards as $key=>$vendor)
                                    @foreach($vendor as $model)
                                        <option value="{{$model}}" data-depend-value="{{$key}}">{{$model}}</option>
                                    @endforeach
                                @endforeach
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
                            <option value="4 Gb">4 Gb</option>
                            <option value="6 Gb">6 Gb</option>
                            <option value="8 Gb">8 Gb</option>
                            <option value="16 Gb">16 Gb</option>
                            <option value="32 Gb">32 Gb</option>
                            <option value="64 Gb">64 Gb</option>
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="memory-type-{n}" name="configuration[{n}][memory_type]" data-placeholder="Тип" required>
                            <option value=""></option>
                                <option value="DDR3">DDR3</option>
                                <option value="DDR4">DDR4</option>
                                <option value="DDR5">DDR5</option>
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
                        <option value="HDD">HDD</option>
                        <option value="SSD">SSD</option>
                        <option value="SSD+HDD">SSD+HDD</option>
                        <option value="Бездисковая система">Бездисковая система</option>
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
                            @foreach ($keybords as $vendor)
                                <option value="{{$vendor}}">{{$vendor}}</option>
                            @endforeach
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
                            @foreach ($mouses as $vendor)
                                <option value="{{$vendor}}">{{$vendor}}</option>
                            @endforeach
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
                            @foreach ($headphones as $vendor)
                                <option value="{{$vendor}}">{{$vendor}}</option>
                            @endforeach
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
                            @foreach ($chairs as $vendor)
                                <option value="{{$vendor}}">{{$vendor}}</option>
                            @endforeach
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
                            @foreach ($monitors as $vendor)
                            <option value="{{$vendor}}">{{$vendor}}</option>
                            @endforeach
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="monitor-type-{n}" name="configuration[{n}][monitor_type]" data-placeholder="Тип" required>
                            <option value=""></option>
                            @foreach ($monitor_types as $vendor)
                            <option value="{{$vendor}}">{{$vendor}}</option>
                            @endforeach
                        </select>
                        <div class="error"></div>
                    </div>
                    <div class="select2_wrapper">
                        <select id="monitor-hertz-{n}" name="configuration[{n}][monitor_hertz]" data-placeholder="Гц" required>
                            <option value=""></option>
                            @foreach ($monitor_hertz as $vendor)
                            <option value="{{$vendor}}">{{$vendor}}</option>
                            @endforeach
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
                        <option value="<100 Мбит">&lt;100 Мбит</option>
                            <option value=">100 Мбит">&gt;100 Мбит</option>
                            <option value=">1 Гбит">&gt;1 Гбит</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
</script>
