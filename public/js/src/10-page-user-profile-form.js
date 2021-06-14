jQuery(function() {
    let $form = jQuery('#user-profile-form'),
        codeFormInterval,
        $inputPhone = $form.find('input[name="phone"]'),
        $codeWrapper = $form.find('.confirm_mobile_wrapper'),
        $codeDescription = $codeWrapper.find('.confirm_mobile_descr'),
        newPhoneNumber = null,
        oldPhoneNumber = $form.find('#oldPhone').val();

    if ($form.length === 0) {
        return;
    }

    $form.find('input[name="code"]').codeInput();

    $form.on('submit', function(e) {
        e.preventDefault();
        $form.find('.forma .form-group').removeClass('error');
        $form.find('.forma .error').remove();
        newPhoneNumber = $inputPhone.val();

        if ($inputPhone.inputmask('unmaskedvalue') !== oldPhoneNumber) {
            $form.find('.code_input_wrapper input').val('');
            jQuery.ajax({
                type: 'POST',
                url: $(this).attr('phone-action'),
                data: {
                    phone: $inputPhone.inputmask('unmaskedvalue'),
                    '_token': $form.find('[name="_token"]').val()
                },
                success: function(data) {
                    if (data.status == 'false') {
                        jQuery('#user-profile-form').find('#user-phone-input').closest('.form-group').addClass('error').append('<div class="error">' + data.msg + '</div>');
                    } else {
                        jQuery('.user_profile_submit').addClass('disabled');
                        $inputPhone.hide();
                        $codeDescription.text(`Код отправлен на номер ${newPhoneNumber}`).removeClass('error');
                        $codeWrapper.show();
                        clearInterval(codeFormInterval);
                        startCountDown();
                    }

                }
            });
        } else {
            submitForm();
        }
    });

    jQuery('#reSendCodeProfile').on('click', function(e) {
        $form.trigger('submit');
    });

    $form.on('change', 'input[name="code"]', function(e) {
        let $this = jQuery(this);

        jQuery.ajax({
            type: 'POST',
            url: $form.attr('verify-action'),
            data: {
                'confirm_code': $this.val(),
                'phone': $inputPhone.inputmask('unmaskedvalue'),
                '_token': $form.find('[name="_token"]').val()
            },
            success: function(json) {
                if (typeof json.error !== 'undefined') {
                    // ошибка
                    $codeDescription.text(json.error).addClass('error');
                } else {
                    oldPhoneNumber = $inputPhone.inputmask('unmaskedvalue');
                    // успех
                    submitForm();
                    $inputPhone.show();
                    $codeWrapper.hide();
                    clearInterval(codeFormInterval);
                    jQuery('.user_profile_submit').removeClass('disabled');
                }
            }
        });

    });

    function submitForm() {
        $form.find('.user_profile_submit').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            success: function(data) {
                if (data.status == 'false') {

                } else {
                    jQuery('.user_profile_submit').removeClass('disabled');
                    jQuery('[data-remodal-id="success_modal"]').remodal().open();
                }

            },
            error: function(errors) {
                jQuery('.user_profile_submit').removeClass('disabled');
                $.each(errors.responseJSON.errors, function(key, item) {
                    $form.find('.form-group [name="' + key + '"]').closest('.form-group').addClass('error').append('<div class="error">' + item + '</div>');
                });
            }
        });
    }

    function startCountDown() {
        let $countdown = jQuery('#countdown'),
            $reSendCode = jQuery('#reSendCodeProfile'),
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
