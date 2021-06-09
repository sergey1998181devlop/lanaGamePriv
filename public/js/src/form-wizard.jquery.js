jQuery(function() {
    let $form = jQuery('#add-club-form'),
        $save_draft = $form.find('.save_draft'),
        $club_photo_hidden_input = jQuery('#club_photos_input'),
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
            url: '',
            data: $form.serialize(),
            success: function() {
                jQuery('[data-remodal-id="success_modal"]').remodal().open();
            }
        });
    });

    $form.on('submit', function(e) {
        e.preventDefault();

        jQuery.ajax({
            type: 'POST',
            url: '',
            data: $form.serialize(),
            success: function() {
                jQuery('[data-remodal-id="success_modal"]').remodal().open();
            }
        });
    });

    $club_price_file_input.on('change', function(e) {
        if (this.files.length === 0) {
            $club_price_hidden_input.val('');
            $club_price_file_text.text('Загрузить файл');
            return;
        }

        upload_file(this.files[0]).then(data => {
            $club_price_hidden_input.val(data);
            $club_price_file_text.text('Файл загружен');
        });
    });

    //upload photo gallery
    (() => {
        let files = $club_photo_hidden_input.val().split(':').filter(x => !!x),
            main_file = $main_preview_photo_hidden_input.val();

        $club_photo_file_input.on('change', function() {
            let current_gallery_image_count = files.length;

            for (let file of this.files) {
                if (current_gallery_image_count >= max_image_count) {
                    break;
                }

                ++current_gallery_image_count;

                upload_file(file).then((data) => {
                    addFile(data);
                });
            }

            setTimeout(() => $club_photo_file_input.attr('type', 'hidden'), 0);
            setTimeout(() => $club_photo_file_input.attr('type', 'file'), 50);
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
            $club_photo_hidden_input.val(files.join(':'));
            $main_preview_photo_hidden_input.val(main_file || '');

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
    })();

    function upload_file(file) {
        return new Promise((resolve, reject) => {
            let formData = new FormData();

            formData.append('file', file, file.name);

            jQuery.ajax({
                url: '/upload.php',
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function({data, error}) {
                    if (error) {
                        return reject(error);
                    }

                    resolve(data);
                }
            });
        });
    }

    // schedule validation
    (() => {
        let $tab = jQuery('.form_tab_04_schedule'),
            $input_week_schedule = jQuery('input[data-week-schedule]'),
            $input_day_schedule = jQuery('input[data-day-schedule]');

        $tab.on('change', 'input', function(e) {
            if ($input_day_schedule.filter(':checked').length === 0 && $input_week_schedule.is(':checked')) {
                jQuery('.next_btn, .prev_btn').prop('disabled', true);
                jQuery('.work_time_wrapper .error').text('Необходимо заполнить хотя бы один день');
            } else {
                jQuery('.next_btn, .prev_btn').prop('disabled', false);
                jQuery('.work_time_wrapper .error').text('');
            }
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

                blockToggle(selector, state);
            })
            .trigger('init');

        jQuery('input[type="radio"][data-activate-block]')
            .on('change init', function(e) {
                let $this = jQuery(this),
                    selector = $this.data('activate-block');

                blockToggle(selector, true);
            })
            .filter(':checked')
            .trigger('init');

        jQuery('input[type="radio"][data-disable-block]')
            .on('change init', function(e) {
                let $this = jQuery(this),
                    selector = $this.data('disable-block');

                blockToggle(selector, false);
            })
            .filter(':checked')
            .trigger('init');

        /**
         * @param {String} selector
         * @param {Boolean} state
         */
        function blockToggle(selector, state) {
            jQuery(selector).each(function() {
                let $block = jQuery(this);

                $block.toggleClass('block_active', state);
                $block.toggleClass('block_disabled', !state);

                $block.find('input, select, textarea').each(function() {
                    let $input = jQuery(this);

                    $input.prop('disabled', !state);
                });
            });
        }
    })();

    /**
     * Configuration tabs
     */
    (() => {
        let $configuration = jQuery('[data-role="pc-configuration"]'),
            $navs = $configuration.find('[data-role="pc-configuration-nav"]'),
            $tabs = $configuration.find('[data-role="pc-configuration-tabs"]'),
            $tab_tpl = jQuery('#configuration-tab-template'),
            $create_tab_button = $configuration.find('[data-role="pc-configuration-create-tab"]'),
            tab_tpl_html = $tab_tpl.html(),
            tab_count = $tabs.find('[data-role="pc-configuration-tab"]').length,
            last_tab_index = tab_count - 1,
            active_tab_index = last_tab_index;

        if ($configuration.length === 0) {
            return;
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
     * Scroll page handlers
     */
    (() => {
        jQuery(window).on('scroll resize', function() {
            jQuery('[data-track-sticky]').each(function() {
                let $this = jQuery(this),
                    y = this.getBoundingClientRect().y;

                $this
                    .toggleClass('sticky', y === 0)
                    .toggleClass('not-sticky', y !== 0);
            });
        });
    })();

});