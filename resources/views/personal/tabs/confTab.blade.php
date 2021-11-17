<div class="tab" data-tab="{{$tabKey}}" data-role="pc-configuration-tab">
    <div class="form-group">
        <div class="pc_config">Оборудование</div>
        <div class="pc_config">
            <div class="common_info_wrapper new_area">
                <input type="text" value="{{getConf('conf_name',$tabKey)}}" name="configuration[{{$tabKey}}][conf_name]" placeholder="Введите название">
                <input type="text" class="qty" value="{{getConf('pc_quantity',$tabKey)}}" name="configuration[{{$tabKey}}][pc_quantity]" placeholder="| Количество ПК" data-new-area-qty-pc>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="cpu-vendor-{{$tabKey}}">Процессор</label>
        <div class="input_wrapper">
            <div class="pc_config_select">
                <div class="select2_wrapper">
                    <select id="cpu-vendor-{{$tabKey}}" name="configuration[{{$tabKey}}][cpu_vendor]" data-placeholder="Фирма" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('cpu_vendor',$tabKey) == '1') ? 'selected' : null}}>Фирма</option>
                        @foreach($cpus as $key=>$vendor)
                            <option value="{{$key}}" {{(getConf('cpu_vendor',$tabKey) === $key) ? 'selected' : null}}>{{$key}}</option>
                        @endforeach

                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="cpu-model-{{$tabKey}}" name="configuration[{{$tabKey}}][cpu_model]" data-placeholder="Модель" required required>
                        <option value=""></option>
                        @foreach($cpus as $key=>$vendor)
                            @foreach($vendor as $model)
                                <option value="{{$model}}" {{(getConf('cpu_model',$tabKey) === $model) ? 'selected' : null}} data-depend-value="{{$key}}">{{$model}}</option>
                            @endforeach
                        @endforeach
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="video-vendor-{{$tabKey}}">Видеокарта</label>
        <div class="input_wrapper">
            <div class="pc_config_select">
                <div class="select2_wrapper">
                    <select id="video-vendor-{{$tabKey}}" name="configuration[{{$tabKey}}][video_vendor]" data-placeholder="Фирма" required required>
                        <option value=""></option>
                        @foreach($videoCards as $key=>$vendor)
                            <option value="{{$key}}" {{(getConf('video_vendor',$tabKey) === $key) ? 'selected' : null}}>{{$key}}</option>
                        @endforeach
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="video-model-{{$tabKey}}" name="configuration[{{$tabKey}}][video_model]" data-placeholder="Модель" required required>
                        <option value=""></option>
                        @foreach($videoCards as $key=>$vendor)
                            @foreach($vendor as $model)
                                <option value="{{$model}}" {{(getConf('video_model',$tabKey) === $model) ? 'selected' : null}} data-depend-value="{{$key}}">{{$model}}</option>
                            @endforeach
                        @endforeach
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="memory-size-{{$tabKey}}">Оперативная память</label>
        <div class="input_wrapper">
            <div class="pc_config_select">
                <div class="select2_wrapper">
                    <select id="memory-size-{{$tabKey}}" name="configuration[{{$tabKey}}][memory_size]" data-placeholder="Объем" required required>
                        <option value=""></option>
                        <option value="4 Gb" {{(getConf('memory_size',$tabKey) == '4 Gb') ? 'selected' : null}}>4 Gb</option>
                        <option value="6 Gb" {{(getConf('memory_size',$tabKey) == '6 Gb') ? 'selected' : null}}>6 Gb</option>
                        <option value="8 Gb" {{(getConf('memory_size',$tabKey) == '8 Gb') ? 'selected' : null}}>8 Gb</option>
                        <option value="16 Gb" {{(getConf('memory_size',$tabKey) == '16 Gb') ? 'selected' : null}}>16 Gb</option>
                        <option value="32 Gb" {{(getConf('memory_size',$tabKey) == '32 Gb') ? 'selected' : null}}>32 Gb</option>
                        <option value="64 Gb" {{(getConf('memory_size',$tabKey) == '64 Gb') ? 'selected' : null}}>64 Gb</option>
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="memory-type-{{$tabKey}}" name="configuration[{{$tabKey}}][memory_type]" data-placeholder="Тип" required required>
                        <option value=""></option>
                        <option value="DDR3" {{(getConf('memory_type',$tabKey) == 'DDR3') ? 'selected' : null}}>DDR3</option>
                        <option value="DDR4" {{(getConf('memory_type',$tabKey) == 'DDR4') ? 'selected' : null}}>DDR4</option>
                        <option value="DDR5" {{(getConf('memory_type',$tabKey) == 'DDR5') ? 'selected' : null}}>DDR5</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="hard-disc-type-{{$tabKey}}">Жёсткий диск</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="hard-disc-type-{{$tabKey}}" name="configuration[{{$tabKey}}][hard_disc_type]" data-placeholder="Тип" required required>
                    <option value=""></option>
                    <option value="HDD" {{(getConf('hard_disc_type',$tabKey) == 'HDD') ? 'selected' : null}}>HDD</option>
                    <option value="SSD" {{(getConf('hard_disc_type',$tabKey) == 'SSD') ? 'selected' : null}}>SSD</option>
                    <option value="SSD+HDD" {{(getConf('hard_disc_type',$tabKey) == 'SSD+HDD') ? 'selected' : null}}>SSD+HDD</option>
                    <option value="Бездисковая система" {{(getConf('hard_disc_type',$tabKey) == 'Бездисковая система') ? 'selected' : null}}>Бездисковая система</option>
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="keyboard-vendor-{{$tabKey}}">Клавиатура</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="keyboard-vendor-{{$tabKey}}" name="configuration[{{$tabKey}}][keyboard_vendor]" data-placeholder="Фирма" required required>
                    <option value=""></option>
                    @foreach ($keybords as $vendor)
                        <option value="{{$vendor}}" {{(getConf('keyboard_vendor',$tabKey) == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                    @endforeach
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="mouse-vendor-{{$tabKey}}">Мышь</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="mouse-vendor-{{$tabKey}}" name="configuration[{{$tabKey}}][mouse_vendor]" data-placeholder="Фирма" required required>
                    <option value=""></option>
                    @foreach ($mouses as $vendor)
                        <option value="{{$vendor}}" {{(getConf('mouse_vendor',$tabKey) == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                    @endforeach
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="headphone-vendor-{{$tabKey}}">Гарнитура</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="headphone-vendor-{{$tabKey}}" name="configuration[{{$tabKey}}][headphone_vendor]" data-placeholder="Фирма" required required>
                    <option value=""></option>
                    @foreach ($headphones as $vendor)
                        <option value="{{$vendor}}" {{(getConf('headphone_vendor',$tabKey) == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                    @endforeach
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="chair-vendor-{{$tabKey}}">Кресло</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="chair-vendor-{{$tabKey}}" name="configuration[{{$tabKey}}][chair_vendor]" data-placeholder="Фирма" required required>
                    <option value=""></option>
                    @foreach ($chairs as $vendor)
                        <option value="{{$vendor}}" {{(getConf('chair_vendor',$tabKey) == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                    @endforeach
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="monitor-vendor-{{$tabKey}}">Монитор</label>
        <div class="input_wrapper">
            <div class="pc_config_select monitor">
                <div class="select2_wrapper">
                    <select id="monitor-vendor-{{$tabKey}}" name="configuration[{{$tabKey}}][monitor_vendor]" data-placeholder="Фирма" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('monitor_vendor',$tabKey) == '1') ? 'selected' : null}}>Фирма</option>
                        @foreach ($monitors as $vendor)
                            <option value="{{$vendor}}" {{(getConf('monitor_vendor',$tabKey) == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                        @endforeach
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="monitor-type-{{$tabKey}}" name="configuration[{{$tabKey}}][monitor_type]" data-placeholder="Дюймы" required required>
                        <option value=""></option>
                        @foreach ($monitor_types as $vendor)
                            <option value="{{$vendor}}" {{(getConf('monitor_type',$tabKey) == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                        @endforeach
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="monitor-hertz-{{$tabKey}}" name="configuration[{{$tabKey}}][monitor_hertz]" data-placeholder="Гц" required>
                        <option value=""></option>
                        @foreach ($monitor_hertz as $vendor)
                            <option value="{{$vendor}}" {{(getConf('monitor_hertz',$tabKey) == $vendor) ? 'selected' : null}}>{{$vendor}}</option>
                        @endforeach
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="internet-{{$tabKey}}">Интернет</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="internet-{{$tabKey}}" name="configuration[{{$tabKey}}][internet]" data-placeholder="Скорость" required required>
                    <option value=""></option>
                    <option value="<100 Мбит" {{(getConf('internet',$tabKey) == '<100 Мбит') ? 'selected' : null}}>&lt;100 Мбит</option>
                    <option value=">100 Мбит" {{(getConf('internet',$tabKey) == '>100 Мбит') ? 'selected' : null}}>&gt;100 Мбит</option>
                    <option value=">1 Гбит" {{(getConf('internet',$tabKey) == '>1 Гбит') ? 'selected' : null}}>&gt;1 Гбит</option>
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
</div>
