jQuery(function() {
    let $form = jQuery('#user-profile-form'),
        codeFormInterval,
        $inputPhone = $form.find('input[name="phone"]'),
        $codeWrapper = $form.find('.confirm_mobile_wrapper'),
        $codeDescription = $codeWrapper.find('.confirm_mobile_descr'),
        newPhoneNumber = null,
        oldPhoneNumber = $form.find('input[name="phone"]').val();

    if ($form.length === 0) {
        return;
    }

    $form.find('input[name="code"]').codeInput();

    $form.on('submit', function(e) {
        e.preventDefault();

        newPhoneNumber = $inputPhone.val();

        if (newPhoneNumber !== oldPhoneNumber) {
            jQuery.ajax({
                type: 'POST',
                url: '',
                data: {phone: newPhoneNumber},
                success: function() {
                    jQuery('.user_profile_submit').addClass('disabled');
                    $inputPhone.hide();
                    $codeDescription.text(`Код отправлен на номер ${newPhoneNumber}`).removeClass('error');
                    $codeWrapper.show();
                    clearInterval(codeFormInterval);
                    startCountDown();
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
            url: '',
            data: {code: $this.val()},
            success: function(json) {
                if (json.error) {
                    // ошибка
                    $codeDescription.text(json.error).addClass('error');
                } else {
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
        jQuery.ajax({
            type: 'POST',
            url: '',
            data: $form.serialize(),
            success: function() {
                jQuery('[data-remodal-id="success_modal"]').remodal().open();
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