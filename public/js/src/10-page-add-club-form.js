jQuery(function() {
    const is_admin = jQuery('meta[name="is-admin"]').attr('content') === '1';

    let $form = jQuery('#add-club-form'),
        $city_input = jQuery('#select-сity'),
        $save_draft = $form.find('.save_draft'),
        $club_photo_hidden_input = jQuery('#club_photos_input'),
        $club_select_metro_input = jQuery('#select-subway'),
        $main_preview_photo_hidden_input = jQuery('#main_preview_photo_input'),
        $club_photo_file_input = jQuery('#add-photo-input'),
        $club_price_file_input = jQuery('#add-price-file-input'),
        $club_price_hidden_input = jQuery('#add-price-file-hidden-input'),
        $club_price_file_text = jQuery('#add-price-file-text'),
        $add_photo_preview = jQuery('#add_photo_preview'),
        $add_photo_list = jQuery('#add_photo_list'),
        max_image_count = 10;


    if ($form.length === 0) {
        return;
    }

    let formWizard = $form.formWizard({
        inputWrapperSelector: '.form-group',
        inputErrorSelector: '.error',
        submitButtonSelector: '[type="submit"]',
        prevButtonSelector: '[data-role="prev-tab-button"]',
        prevButtonText: 'Назад',
        nextButtonSelector: '[data-role="next-tab-button"]',
        nextButtonText: 'Продолжить',
        tabSelector: '.form_tab'
    });

    if (is_admin) {
        $form.find('input[required], select[required], textarea[required]')
            .prop('required', false)
            .attr('required', null);

        $form.find('.form_tab').append('<button type="submit" class="save_for_admin">Сохранить</button>')
    }

    $form.on('keydown', 'input', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();

            formWizard.goToNextTab();
        }
    });

    $form.on('show-tab', function(e, tabIndex) {
        jQuery('.person_add_club_modal_wrapper .remodal-wrapper').stop().animate({scrollTop: 0}, 300);
    });

    $save_draft.on('click', function(e) {
        jQuery.ajax({
            type: 'POST',
            url: $form.attr('draft-action'),
            data: $form.serialize(),
            success: function() {
                location.href = '/personal/clubs?status=success';
            }
        });
    });

    $form.on('submit', function(e) {
        e.preventDefault();

        $form.find('button[type="submit"]').addClass('disabled');

        jQuery.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function() {
                $form.find('button[type="submit"]').removeClass('disabled');
                location.href = '/personal/clubs?status=success';
            }
        });
    });

    // common info validation

    (() => {
        let $tab = jQuery('.form_tab_01_common_info'),
            $address_input = $tab.find('#club-address-input'),
            $lat = jQuery('#lat'),
            $lon = jQuery('#lon');

        if (jQuery.fn.autocomplete) {
            $address_input.autocomplete({

                lookup: function(query, done) {
                    let cityName = $city_input.find('option:selected').text();

                    jQuery.ajax({
                        method: 'GET',
                        url: 'https://geocode-maps.yandex.ru/1.x/',
                        data: {
                            apikey: window.YANDEX_API_KEY,
                            format: 'json',
                            results: '5',
                            geocode: `Россия, ${cityName}, ${query}`
                        },
                        success: function(json) {
                            let suggestions = $.map(json.response.GeoObjectCollection.featureMember, function(dataItem) {
                                let name = '',
                                    coord,
                                    quma = '',
                                    address = '';

                                if (dataItem.GeoObject.Point.pos != null) {
                                    coord = dataItem.GeoObject.Point.pos;

                                    if (dataItem.GeoObject.name != null) {
                                        name = dataItem.GeoObject.name;
                                        address = dataItem.GeoObject.name;
                                        quma = ', ';
                                    }

                                    if (dataItem.GeoObject.description != null) {
                                        name += quma + dataItem.GeoObject.description;
                                    }

                                    if (name) {
                                        return {value: name, data: coord, address: address};
                                    }
                                }
                            });

                            done({suggestions});
                        }
                    });
                },

                onSelect: function(suggestion) {

                    var coor = suggestion.data.split(' ');
                    $('#add-club-form #lat').val(coor[1]);
                    $('#add-club-form #lon').val(coor[0]);
                    $('#add-club-form #club_address').val(suggestion.address);
                    $('#add-club-form #club_full_address').val(suggestion.value);
                    jQuery('.error.address_error').text('');
                }
            });
        }

        $address_input.on('input', function() {
            $lat.val('');
            $lon.val('');
        });

        $tab.data('form-wizard-tab-validation', function() {
            return new Promise((resolve, reject) => {
                let hasErrors = false;

                jQuery('.error.address_error').text('');

                if ($lat.val() === '' || $lon.val() === '') {
                    jQuery('.error.address_error').text('Необходимо выбрать адрес из списка');
                    hasErrors = true;
                }

                return hasErrors ? reject() : resolve();
            });
        });

        jQuery('#rating-input').on('input change', function(e) {
            let $this = jQuery(this);

            if ($this.length === 0) {
                return;
            }

            if ($this.val() < 0 || $this.val() > 5) {
                $this.val('');
            }
        });

    })();

    // basic services validation

    (() => {
        let $tab = jQuery('.form_tab_02_basic_services');


        $tab.data('form-wizard-tab-validation', function() {
            return new Promise((resolve, reject) => {
                let hasErrors = false,
                    $qty_pc_val = jQuery('[name="qty_pc"]').val(),
                    $qty_vip_pc_val = jQuery('[name="qty_vip_pc"]').val();

                jQuery('.error.qty_error').text('');

                if ($qty_vip_pc_val > $qty_pc_val) {
                    jQuery('.error.qty_error').text('Количество VIP ПК превышает общее количество ПК');
                    hasErrors = true;
                }

                return hasErrors ? reject() : resolve();
            });
        });
    })();

    // url validation

    (() => {
        let $tab = jQuery('.form_tab_07_contact_information');

        $tab.data('form-wizard-tab-validation', function() {
            return new Promise((resolve, reject) => {
                let hasErrors = false;

                if (is_admin) {
                    return resolve();
                }

                $tab.find('.form-group .error').text('');

                $tab.find('input[data-type="url"]').each(function() {
                    let $input = jQuery(this),
                        value = $input.val();
                    if (value && !/^(https?:\/\/)?([-_a-z0-9а-яё]+\.)+[-_a-z0-9а-яё]/mugi.test(value)) {

                        $input.closest('.form-group').find('.error').text('Необходимо ввести валидный url');
                        hasErrors = true;
                    }
                });

                return hasErrors ? reject() : resolve();
            });
        });
    })();

    // price list validation

    $club_price_file_input.on('change', function(e) {
        if (this.files.length === 0) {
            $club_price_hidden_input.val('');
            $club_price_file_text.text('Загрузить файл');
            jQuery('button[data-role-remove-price-list-event]').remove();
            return;
        }

        upload_file(this.files[0], 'price_list').then(data => {
            $club_price_hidden_input.val(data);
            $club_price_file_text.text('Файл загружен');
            jQuery('.add_file_wrapper').append('<button type="button" data-role-remove-price-list-event></button>');
        });
    });

    jQuery('.add_file_wrapper').on('click', '[data-role-remove-price-list-event]', function(e) {
        $club_price_file_input.val('');
        $club_price_file_input.trigger('change');
    });

    (() => {
        let $tab = jQuery('.form_tab_06_price');

        $tab.on('open', function() {
            if ($club_price_hidden_input.val() !== '') {
                $club_price_file_text.text('Файл загружен');
                jQuery('.add_file_wrapper').append('<button type="button" data-role-remove-price-list-event></button>');
            }
        });
    })();

    //upload photo gallery
    (() => {
        let $tab = jQuery('.form_tab_08_club_formalization'),
            $photo_error = $tab.find('.add_photo_error'),
            $progressbar = $tab.find('.upload-progress'),
            files = $club_photo_hidden_input.val().split(',').filter(x => !!x),
            main_file = $main_preview_photo_hidden_input.val(),
            is_uploading = false;

        $club_photo_file_input.on('change', function() {
            let promises = [],
                sizes = new Map();

            $photo_error.text('');
            $progressbar.css({width: 0});

            is_uploading = true;
            $tab.addClass('uploading');

            if ((files.length + this.files.length) > max_image_count) {
                $photo_error.text(`Возможно загрузить только ${max_image_count} изображений`);

                return;
            }

            // File validation
            for (let file of this.files) {
                if (['image/jpeg', 'image/png'].includes(file.type) === false) {
                    $photo_error.text(`Файл "${file.name}" имеет недопустимый формат`);

                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    $photo_error.text(`Файл "${file.name}" превышает допустимый размер`);

                    return;
                }
            }

            // File upload
            for (let file of this.files) {
                promises.push(upload_file(
                    file,
                    'image',
                    (uploaded, total) => sizes.set(file, {uploaded, total})
                ));
            }

            setTimeout(() => $club_photo_file_input.attr('type', 'hidden'), 0);
            setTimeout(() => $club_photo_file_input.attr('type', 'file'), 50);

            let renderProgressBarInterval = setInterval(() => {
                let uploadedPercents = getTotalUploadedPercent() * 100;

                $progressbar.css({width: `${uploadedPercents}%`});
            }, 50);

            Promise.all(promises)
                .then((results) => {
                    for (let img_url of results) {
                        addFile(img_url);
                    }
                })
                .finally(() => {
                    is_uploading = false;
                    $tab.removeClass('uploading');

                    clearInterval(renderProgressBarInterval);
                });

            function getTotalUploadedPercent() {
                let uploadedAll = 0,
                    totalAll = 0;

                for (let {uploaded, total} of sizes.values()) {
                    uploadedAll += uploaded;
                    totalAll += total;
                }

                return uploadedAll / totalAll;
            }
        });

        $form.on('click', '.add_photo_item .remove_photo', function(e) {
            e.preventDefault();

            let $this = jQuery(this),
                $item = $this.closest('.add_photo_item'),
                $img = $item.find('img'),
                path = $img.attr('src');

            removeFile(path);
        });

        $form.on('click', '.add_photo_item img', function(e) {
            e.preventDefault();

            let $img = jQuery(this),
                path = $img.attr('src');

            selectMainFile(path);
            renderFiles();
        });

        renderFiles();

        function addFile(path) {
            files.push(path);

            if (!main_file) {
                selectMainFile(path);
            }

            renderFiles();
        }

        function removeFile(path) {
            files.splice(files.indexOf(path), 1);

            if (path === main_file) {
                selectMainFile(files.length > 0 ? files[0] : null);
            }

            renderFiles();
        }

        function renderFiles() {
            $photo_error.text('');
            $club_photo_hidden_input.val(files.join(','));
            $main_preview_photo_hidden_input.val(main_file || '').trigger('change');
            if (main_file) {
                $add_photo_preview.html(`<img src="${main_file}"/>`);
            } else {
                $add_photo_preview.empty();
            }

            $add_photo_list.empty();

            files.forEach((path) => {
                $add_photo_list.append(`
<div class="add_photo_item">
    <img src="${path}"/>
    <a href="#" class="remove_photo"></a>
</div>
`);
            });
        }

        function selectMainFile(path) {
            main_file = path;
        }

        $tab.data('form-wizard-tab-validation', function() {
            return new Promise((resolve, reject) => {
                let hasErrors = false;

                $photo_error.text('');

                if (is_uploading) {
                    $photo_error.text('Необходимо дождаться загрузки фотографий');

                    return reject();
                }

                if (is_admin) {
                    return resolve();
                }

                if (!main_file) {
                    $photo_error.text('Необходимо загрузить хотя бы одну фотографию');
                    hasErrors = true;
                }

                return hasErrors ? reject() : resolve();
            });
        });
    })();

    function upload_file(file, type, onprogress) {
        let url = type === 'price_list' ? $form.attr('list-action') : $form.attr('image-action');
        return Layout.fileUpload(file, url, onprogress);
    }

    // schedule validation
    (() => {
        let $tab = jQuery('.form_tab_04_schedule'),
            $input_week_schedule = jQuery('input[data-week-schedule]'),
            $input_day_schedule = jQuery('input[data-day-schedule]');

        $tab.data('form-wizard-tab-validation', function() {
            return new Promise((resolve, reject) => {
                let hasErrors = false;

                if (is_admin) {
                    return resolve();
                }

                jQuery('.work_time_wrapper_error').text('');

                if ($input_day_schedule.filter(':checked').length === 0 && $input_week_schedule.is(':checked')) {
                    jQuery('.work_time_wrapper_error').text('Необходимо заполнить хотя бы один день');
                    hasErrors = true;
                }

                return hasErrors ? reject() : resolve();
            });
        });
    })();

    // payment method validation
    (() => {
        let $tab = jQuery('.form_tab_06_price'),
            $input_payment = jQuery('input[data-payment-method]');

        $tab.on('change', 'input', function(e) {
            if ($input_payment.filter(':checked').length === 0) {
                jQuery('.next_btn, .prev_btn').prop('disabled', true);
                jQuery('.payment_method_wrapper .error').text('Необходимо выбрать хотя бы один способ оплаты');
            } else {
                jQuery('.next_btn, .prev_btn').prop('disabled', false);
                jQuery('.payment_method_wrapper .error').text('');
            }
        });
    })();

    /**
     * Toggle blocks by checkbox and radio buttons
     */
    (() => {
        jQuery('input[type="checkbox"][data-toggle-block]')
            .on('change init', function(e) {
                let $this = jQuery(this),
                    selector = $this.data('toggle-block'),
                    state = this.checked;

                blockToggle($this, selector, state);
            })
            .trigger('init');

        jQuery('input[type="radio"][data-activate-block]')
            .on('change init', function(e) {
                let $this = jQuery(this),
                    selector = $this.data('activate-block');

                blockToggle($this, selector, true);
            })
            .filter(':checked')
            .trigger('init');

        jQuery('input[type="radio"][data-disable-block]')
            .on('change init', function(e) {
                let $this = jQuery(this),
                    selector = $this.data('disable-block');

                blockToggle($this, selector, false);
            })
            .filter(':checked')
            .trigger('init');

        /**
         * @param {jQuery} $input
         * @param {String} selector
         * @param {Boolean} state
         */
        function blockToggle($input, selector, state) {
            jQuery(selector).each(function() {
                let $block = jQuery(this);

                $block.toggleClass('block_active', state);
                $block.toggleClass('block_disabled', !state);


                $block.find('input:not([type="radio"]):not([type="checkbox"]), select, textarea').each(function() {
                    let $input = jQuery(this);

                    // if (!state) {
                    //     $input.val('').trigger('change');
                    // }

                    $input.prop('disabled', $input.is('.block_disabled *'));
                });

            });
        }
    })();

    /**
     * Configuration tabs
     */
    (() => {
        let $tab = jQuery('.form_tab_05_configuration'),
            $configuration = jQuery('[data-role="pc-configuration"]'),
            $navs = $configuration.find('[data-role="pc-configuration-nav"]'),
            $tabs = $configuration.find('[data-role="pc-configuration-tabs"]'),
            $tab_tpl = jQuery('#configuration-tab-template'),
            $create_tab_button = $configuration.find('[data-role="pc-configuration-create-tab"]'),
            tab_tpl_html = $tab_tpl.html(),
            tab_count = $tabs.find('[data-role="pc-configuration-tab"]').length,
            last_tab_index = tab_count - 1,
            active_tab_index = last_tab_index,
            $input_common_area_qty_pc = jQuery('[data-common-area-qty-pc]'),
            $input_vip_area_qty_pc = jQuery('[data-vip-area-qty-pc]');


        if ($configuration.length === 0) {
            return;
        }

        $tab.on('open', function() {
            recalc_qty_pc();
        });


        $tab.on('change', '[data-new-area-qty-pc]', function (e) {
            recalc_qty_pc();
        });

        let KEY_BACKSPACE = 8,
            KEY_TAB = 9,
            KEY_DELETE = 46,
            KEY_ENTER = 13,
            CODE_ALLOWED_KEYBOARD_KEYS = [
                112, /* F1 */  48, /* 0 main keyboard */ 96,  /* 0 side keyboard */
                113, /* F2 */  49, /* 1 main keyboard */ 97,  /* 1 side keyboard */
                114, /* F3 */  50, /* 2 main keyboard */ 98,  /* 2 side keyboard */
                115, /* F4 */  51, /* 3 main keyboard */ 99,  /* 3 side keyboard */
                116, /* F5 */  52, /* 4 main keyboard */ 100, /* 4 side keyboard */
                117, /* F6 */  53, /* 5 main keyboard */ 101, /* 5 side keyboard */
                118, /* F7 */  54, /* 6 main keyboard */ 102, /* 6 side keyboard */
                119, /* F8 */  55, /* 7 main keyboard */ 103, /* 7 side keyboard */
                120, /* F9 */  56, /* 8 main keyboard */ 104, /* 8 side keyboard */
                121, /* F10 */ 57, /* 9 main keyboard */ 105, /* 9 side keyboard */
                122, /* F11 */
                123, /* F12 */

                KEY_BACKSPACE,
                KEY_TAB,
                KEY_DELETE,
                KEY_ENTER
            ];

        $tab.on('keydown', '[data-new-area-qty-pc]', function(e) {
            let key = e.keyCode || e.which;

            if (CODE_ALLOWED_KEYBOARD_KEYS.indexOf(key) === -1) {
                e.preventDefault();
            }
        });

        function recalc_qty_pc() {
            let $qty_pc_val = jQuery('[name="qty_pc"]').val(),
                $qty_vip_pc_val = jQuery('[name="qty_vip_pc"]').val(),
                $input_new_area = jQuery('[data-new-area-qty-pc]'),
                $qty_common_val = $qty_pc_val - $qty_vip_pc_val;

            $input_new_area.each(function() {
                $qty_common_val = $qty_common_val - this.value;

                if($qty_common_val < 1){
                    jQuery(this)
                        .closest(jQuery('[data-role="pc-configuration-tab"]'))
                            .find(jQuery('.main-error'))
                            .addClass('active')
                            .text('Проверьте правильность введенных данных, вы превысили общее количество ПК');

                    $qty_common_val = +$qty_common_val + (+this.value);
                    this.value = '';
                } else{
                    jQuery(this)
                        .closest(jQuery('[data-role="pc-configuration-tab"]'))
                            .find(jQuery('.main-error'))
                            .removeClass('active')
                            .text('Заполните всю информацию об оборудовании в дополнительной зоне или удалите ее');
                }
            });

            $input_common_area_qty_pc.val(`${$qty_common_val} ПК`);
            $input_vip_area_qty_pc.val(`${$qty_vip_pc_val} ПК`);
        }

        $create_tab_button.on('click', function(e) {
            e.preventDefault();

            add_tab();
        });

        $configuration.on('click', '[data-show-tab]', function(e) {
            e.preventDefault();

            let $this = jQuery(this),
                tab = $this.data('show-tab');

            show_tab(tab);
        });

        $configuration.on('click', '[data-remove-tab]', function(e) {
            e.preventDefault();

            let $this = jQuery(this),
                tab = $this.data('remove-tab');

            remove_tab(tab);
        });

        function add_tab() {
            let tab_index = last_tab_index + 1,
                tab_html = generate_tab_html(tab_index);

            $tabs.append(tab_html);
            $navs.append(`
                <li data-nav-tab="${tab_index}">
                    <a href="#" data-show-tab="${tab_index}"></a>
                    <button type="button" data-remove-tab="${tab_index}"></button>
                </li>
            `);

            Layout.initSelect2();

            show_tab(tab_index);

            last_tab_index = tab_index;

            ++tab_count;

            $create_tab_button.prop('disabled', tab_count >= 5);
        }

        function remove_tab(index) {
            $navs.find(`[data-nav-tab="${index}"]`).remove();
            $tabs.find(`[data-tab="${index}"]`).remove();

            if (active_tab_index === index) {
                show_tab(0);
            }

            --tab_count;

            $create_tab_button.prop('disabled', tab_count >= 5);
        }

        function show_tab(index) {
            $tabs
                .find('[data-tab]')
                .removeClass('active')
                .filter(`[data-tab="${index}"]`)
                .addClass('active');

            $navs
                .find('[data-show-tab]')
                .removeClass('active')
                .filter(`[data-show-tab="${index}"]`)
                .addClass('active');

            active_tab_index = index;
        }

        function generate_tab_html(index) {
            return tab_tpl_html.replace(/\{n\}/g, `${index}`);
        }

        $form.on('error-tab', function() {
            if ($configuration.is(':visible')) {
                let $tabWithError = $configuration.find('.tab .form-group.has-error').eq(0).closest('.tab');


                show_tab($tabWithError.data('tab'));
            }
        });
    })();

    /**
     * Add marketing event
     */
    (() => {
        let add_button = jQuery('[data-role="marketing-event-add-tab"]'),
            parent_list = jQuery('.marketing_event .marketing_event_list'),
            index = parent_list.find('.form-group').length;


        add_button.on('click', function(e) {
            ++index;
            parent_list.append(`
             <div class="form-group" >
                <label for="marketing-event-input[${index}]">Акция №</label>
                <div class="input_wrapper" >
                    <input id="marketing-event-input[${index}]" name="marketing_event_descr[]" type="text" placeholder="Описание акции" required>
                    <div class="error"></div>
                </div>
                <button type="button" data-role-remove-marketing-event></button>
            </div>
            `);
            add_button.prop('disabled', index >= 5);
        });

        parent_list.on('click', '[data-role-remove-marketing-event]', function(e) {
            e.preventDefault();
            jQuery(this).closest('.form-group').remove();
            --index;
            add_button.prop('disabled', index >= 5);
        });
    })();

    /**
     * Preview tab
     */

    (() => {
        let $tab = jQuery('.form_tab_09_club_preview');

        $tab.on('open', function() {
            let clubName = jQuery('#club-name-input').val(),
                clubAddress = jQuery('#club-address-input').val(),
                clubPrice = jQuery('#min-price-input').val(),
                clubSubway = $club_select_metro_input.find('option:selected').text(),
                clubSubwayLineColor = $club_select_metro_input.find('option:selected').data('line-color') || 'black',
                totalPc = jQuery('#qty_pc-input').val(),
                consoleQty = jQuery('#qty_console-input').val(),
                vr = jQuery('#qty_vr-input').val(),
                autosim = jQuery('#qty_simulator-input').val(),
                marketingInput = jQuery('.marketing_event_wrapper .checkbox_wrapper input[type="checkbox"]'),
                main_file = $main_preview_photo_hidden_input.val() || '/img/default-club-preview-image.svg';

            $tab.find('.sc_info .club_name span').text(clubName);
            $tab.find('.club_address_wrapper .club_address').text(clubAddress);
            $tab.find('.club_subway_wrapper .subway_station').text(clubSubway);
            $tab.find('.club_subway_wrapper .subway_img_wrapper')[0].style.setProperty('--subway-color', clubSubwayLineColor);
            $tab.find('.club_price_wrapper .club_price span').text(clubPrice);

            $tab.find('.cf_item .cf_qty.total_pc').text(totalPc);

            if (consoleQty === '') {
                jQuery('.cf_qty.console').closest('.cf_item').hide();
            } else {
                jQuery('.cf_qty.console').closest('.cf_item').show();
                $tab.find('.cf_item .cf_qty.console').text(consoleQty);
            }

            if (vr === '') {
                jQuery('.cf_qty.vr').closest('.cf_item').hide();
            } else {
                jQuery('.cf_qty.vr').closest('.cf_item').show();
                $tab.find('.cf_item .cf_qty.vr').text(vr);
            }

            if (autosim === '') {
                jQuery('.cf_qty.autosim').closest('.cf_item').hide();
            } else {
                jQuery('.cf_qty.autosim').closest('.cf_item').show();
                $tab.find('.cf_item .cf_qty.autosim').text(autosim);
            }

            $tab.find('.sc_img_wrapper .sc_img img').attr('src', main_file);

            if (jQuery('input[data-food-service]').filter(':checked').length > 0) {
                $tab.find('.club_services .food_services').show();
            } else {
                $tab.find('.club_services .food_services').hide();
            }

            $tab.find('.club_services .drink__services').toggle(jQuery('input[data-alcohol-service]').prop('checked'));
            $tab.find('.club_services .hookah_services').toggle(jQuery('input[data-hookah-service]').prop('checked'));
            $tab.find('.club_services .vip_services').toggle(jQuery('input[data-vip-service]').prop('checked'));
            $tab.find('.club_promotion').toggle(marketingInput.prop('checked'));
            if (!jQuery('input[data-alcohol-service]').prop('checked')
                && !jQuery('input[data-hookah-service]').prop('checked')
                && !jQuery('input[data-vip-service]').prop('checked')
                && !jQuery('input[data-food-service]').filter(':checked').length > 0) {
                $tab.find('.club_services').hide();
            } else {
                $tab.find('.club_services').show();
            }
            jQuery('.club_subway_wrapper').toggle($club_select_metro_input.val() !== '');
        });
    })();
});

