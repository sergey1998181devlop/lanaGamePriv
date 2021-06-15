<div class="tab" data-tab="{{$key}}" data-role="pc-configuration-tab">
    <div class="form-group">
        <div class="pc_config">Оборудование</div>
        <div class="pc_config">
            <input type="text" value="{{getConf('conf_name',$key)}}" name="configuration[{{$key}}][conf_name]" placeholder="Введите название">
        </div>
    </div>
    <div class="form-group">
        <label for="cpu-vendor-{{$key}}">Процессор</label>
        <div class="input_wrapper">
            <div class="pc_config_select">
                <div class="select2_wrapper">
                    <select id="cpu-vendor-{{$key}}" name="configuration[{{$key}}][cpu_vendor]" data-placeholder="Фирма" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('cpu_vendor',$key) == '1') ? 'selected' : null}}>Фирма</option>
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="cpu-model-{{$key}}" name="configuration[{{$key}}][cpu_model]" data-placeholder="Модель" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('cpu_model',$key) == '1') ? 'selected' : null}}>Модель</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="video-vendor-{{$key}}">Видеокарта</label>
        <div class="input_wrapper">
            <div class="pc_config_select">
                <div class="select2_wrapper">
                    <select id="video-vendor-{{$key}}" name="configuration[{{$key}}][video_vendor]" data-placeholder="Фирма" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('video_vendor',$key) == '1') ? 'selected' : null}}>Фирма</option>
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="video-model-{{$key}}" name="configuration[{{$key}}][video_model]" data-placeholder="Модель" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('video_model',$key) == '1') ? 'selected' : null}}>Модель</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="memory-size-{{$key}}">Оперативная память</label>
        <div class="input_wrapper">
            <div class="pc_config_select">
                <div class="select2_wrapper">
                    <select id="memory-size-{{$key}}" name="configuration[{{$key}}][memory_size]" data-placeholder="Объем" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('memory_size',$key) == '1') ? 'selected' : null}}>Объем</option>
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="memory-type-{{$key}}" name="configuration[{{$key}}][memory_type]" data-placeholder="Тип" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('memory_type',$key) == '1') ? 'selected' : null}}>Тип</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="hard-disc-type-{{$key}}">Жёсткий диск</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="hard-disc-type-{{$key}}" name="configuration[{{$key}}][hard_disc_type]" data-placeholder="Тип" required required>
                    <option value=""></option>
                    <option value="1" {{(getConf('hard_disc_type',$key) == '1') ? 'selected' : null}}>Тип</option>
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="keyboard-vendor-{{$key}}">Клавиатура</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="keyboard-vendor-{{$key}}" name="configuration[{{$key}}][keyboard_vendor]" data-placeholder="Фирма" required required>
                    <option value=""></option>
                    <option value="1" {{(getConf('keyboard_vendor',$key) == '1') ? 'selected' : null}}>Фирма</option>
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="mouse-vendor-{{$key}}">Мышь</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="mouse-vendor-{{$key}}" name="configuration[{{$key}}][mouse_vendor]" data-placeholder="Фирма" required required>
                    <option value=""></option>
                    <option value="1" {{(getConf('mouse_vendor',$key) == '1') ? 'selected' : null}}>Фирма</option>
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="headphone-vendor-{{$key}}">Гарнитура</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="headphone-vendor-{{$key}}" name="configuration[{{$key}}][headphone_vendor]" data-placeholder="Фирма" required required>
                    <option value=""></option>
                    <option value="1" {{(getConf('headphone_vendor',$key) == '1') ? 'selected' : null}}>Фирма</option>
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="chair-vendor-{{$key}}">Кресло</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="chair-vendor-{{$key}}" name="configuration[{{$key}}][chair_vendor]" data-placeholder="Фирма" required required>
                    <option value=""></option>
                    <option value="1" {{(getConf('chair_vendor',$key) == '1') ? 'selected' : null}}>Фирма</option>
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="monitor-vendor-{{$key}}">Монитор</label>
        <div class="input_wrapper">
            <div class="pc_config_select">
                <div class="select2_wrapper">
                    <select id="monitor-vendor-{{$key}}" name="configuration[{{$key}}][monitor_vendor]" data-placeholder="Фирма" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('monitor_vendor',$key) == '1') ? 'selected' : null}}>Фирма</option>
                    </select>
                    <div class="error"></div>
                </div>
                <div class="select2_wrapper">
                    <select id="monitor-type-{{$key}}" name="configuration[{{$key}}][monitor_type]" data-placeholder="Тип" required required>
                        <option value=""></option>
                        <option value="1" {{(getConf('monitor_type',$key) == '1') ? 'selected' : null}}>Тип</option>
                    </select>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="internet-{{$key}}">Интернет</label>
        <div class="input_wrapper">
            <div class="select2_wrapper">
                <select id="internet-{{$key}}" name="configuration[{{$key}}][internet]" data-placeholder="Скорость" required required>
                    <option value=""></option>
                    <option value="1" {{(getConf('internet',$key) == '1') ? 'selected' : null}}>Скорость</option>
                </select>
                <div class="error"></div>
            </div>
        </div>
    </div>
</div>