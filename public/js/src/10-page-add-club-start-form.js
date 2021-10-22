jQuery(function() {
    let $firstForm = jQuery('#add-club-start-form'),
        $secondForm = jQuery('#add-club-code-confirm-form'),
        $step_back = $secondForm.find('.step_back'),
        $lastForm = jQuery('#personal_info_register'),
        codeFormInterval,
        phoneNumber = null;

    if ($firstForm.length === 0) {
        return;
    }

    jQuery('[data-btn-club-owner-reg]').on('click', function(e) {
        if(Layout.isGuest()){
            jQuery(this).closest('.main_reg_wrapper').find('.form_reg_wrapper').show().find('.page_title').text('Регистрация представителя компьютерного клуба');
            $lastForm.find('input[name="user_type"]').val('owner');
            $lastForm.find('.form-group.owner').show().find('select').prop('disabled', false);
            $lastForm.find('.form-group.player').hide().find('select').prop('disabled', true);
        }else{
            Layout.showInfoModal('Вы уже авторизованы.');
        }
    });

    jQuery('[data-btn-club-gamer-reg]').on('click', function(e) {
        if(Layout.isGuest()){
            jQuery(this).closest('.main_reg_wrapper').find('.form_reg_wrapper').show().find('.page_title').text('Регистрация ланнера');
            $lastForm.find('input[name="user_type"]').val('player');
            $lastForm.find('.form-group.owner').hide().find('select').prop('disabled', true);
            $lastForm.find('.form-group.player').show().find('select').prop('disabled', false);
            $lastForm.find('.club_list_link').hide();
        } else{
            Layout.showInfoModal('Вы уже авторизованы.');
        }
    });

    $secondForm.find('input[name="code"]').codeInput();

    $firstForm.on('submit', function(e) {
        e.preventDefault();

        if(!Layout.isGuest()){
            Layout.showInfoModal('Вы уже авторизованы.');
            return;
        }

        phoneNumber = $firstForm.find('input[name="phone"]').val();

        jQuery.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: {
                'phone': $('#add-club-start-input').inputmask('unmaskedvalue'),
                '_token': $('#add-club-start-form [name="_token"]').val()
            },
            success: function(data) {
                if (data.status == 'false') {
                    $firstForm.find('.forma .form-group').addClass('error');
                    $firstForm.find('.forma .form-group .error').text(data.msg);
                } else {
                    $firstForm.find('.forma .form-group.error').removeClass('error');
                    $firstForm.find('.forma .form-group .error').text('');
                    $firstForm.hide();
                    $secondForm.find('.user_phone').text(phoneNumber);
                    $secondForm.show();
                    clearInterval(codeFormInterval);
                    startCountDown();
                }

            },
            error: function(errors) {
                $firstForm.find('.forma .form-group').addClass('error');
                $.each(errors.responseJSON.errors, function(key, item) {
                    $firstForm.find('.forma .form-group [name="' + key + '"]').closest('.form-group').find('.error').text(item);
                });
            }
        });
    });

    $secondForm.on('submit', function(e) {
        e.preventDefault();
        jQuery('.code_wrapper .error').text('');
        var confirm_code = '', phone = $('#add-club-start-input').inputmask('unmaskedvalue');
        $secondForm.find('.code_input_wrapper input').each(function() {
            confirm_code = confirm_code + $(this).val();
        });
        if (confirm_code.length != 4) {
            return false;
        }

        jQuery.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: {
                'phone': phone,
                'confirm_code': confirm_code,
                '_token': $secondForm.find('[name="_token"]').val()
            },
            success: function(json) {
                if (json.error) {
                    // ошибка
                    jQuery('.code_wrapper .error').text(json.error);

                } else {
                    $lastForm.find('#user-phone-input').val($('#add-club-start-input').inputmask('unmaskedvalue'));
                    $lastForm.find('[name="phone"]').val($('#add-club-start-input').inputmask('unmaskedvalue'));
                    $lastForm.find('[name="conf_code"]').val(confirm_code);
                    $('.add_club_page_start_wrapper').hide();
                    $lastForm.show();
                    // успех
                    // location.href = '/';
                }
            }
        });
    });
    $lastForm.find('form').on('submit', function(e) {
        e.preventDefault();
        $lastForm.find('.forma .form-group').removeClass('error');
        $lastForm.find('.forma .error').remove();
        jQuery.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $lastForm.find('form').serialize(),
            success: function(json) {
                if (typeof json.errors !== 'undefined') {
                    // ошибка
                    jQuery('.code_wrapper .error').text(json.error);

                } else {
                    // успех
                    location.href = '/personal/clubs?action=add_club';
                }
            },
            error: function(errors) {
                $.each(errors.responseJSON.errors, function(key, item) {
                    $lastForm.find('.forma .form-group [name="' + key + '"]').closest('.form-group').addClass('error').append('<div class="error">' + item + '</div>');
                });

            }
        });
    });

    $step_back.on('click', function(e) {
        $secondForm.trigger('reset');
        $secondForm.hide();
        $firstForm.show();
    });

    jQuery('#reSendCode').on('click', function(e) {
        $firstForm.trigger('submit');
    });

    function startCountDown() {
        clearInterval(codeFormInterval);

        let $countdown = jQuery('#countdown'),
            $reSendCode = jQuery('#reSendCode'),
            time = 180;

        $countdown.text(getTimeText(time));

        $reSendCode.addClass('disabled');

        codeFormInterval = setInterval(function() {
            time--;
            $countdown.text(getTimeText(time));
            if (time === 0) {
                $reSendCode.removeClass('disabled');
                $countdown.text(' ');

                clearInterval(codeFormInterval);
            }
        }, 1000);
    }

    function getTimeText(time) {
        var minutes = '' + Math.floor(time / 60),
            seconds = '' + time % 60;

        seconds = seconds.length === 1 ? '0' + seconds : seconds;

        return minutes + ':' + seconds;
    }
});
