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

    $secondForm.find('input[name="code"]').codeInput();

    $firstForm.on('submit', function(e) {
        e.preventDefault();

        phoneNumber = $firstForm.find('input[name="phone"]').val();

        jQuery.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: {
                'phone' : $('#add-club-start-input').inputmask('unmaskedvalue'),
                '_token':$('#add-club-start-form [name="_token"]').val()
            },
            success: function() {
                $firstForm.hide();
                $secondForm.find('.user_phone').text(phoneNumber);
                $secondForm.show();
                clearInterval(codeFormInterval);
                startCountDown();
            }
        });
    });

    $secondForm.on('submit', function(e) {
        e.preventDefault();
        jQuery('.code_wrapper .error').text('');
        var confirm_code ='',phone = $('#add-club-start-input').inputmask('unmaskedvalue');
        $secondForm.find('.code_input_wrapper input').each(function(){
             confirm_code = confirm_code+$(this).val();
        })
        if(confirm_code.length != 4){return false;}

        jQuery.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: {
                'phone':phone,
                'confirm_code': confirm_code,
                '_token':$secondForm.find('[name="_token"]').val()
            },
            success: function(json) {
                if (json.error) {
                    // ошибка
                    jQuery('.code_wrapper .error').text(json.error);

                } else {
                    $lastForm.find('#user-phone-input').val($('#add-club-start-input').inputmask('unmaskedvalue'));
                    $lastForm.find('[name="code"]').val(confirm_code);
                    $('.add_club_page_start_wrapper').hide();
                    $lastForm.show();
                    // успех
                    // location.href = '/';
                }
            }
        });
    });
    // $lastForm.find('form').on('submit', function(e) {
    //     e.preventDefault();
    //     jQuery.ajax({
    //         type: 'POST',
    //         url: $(this).attr('action'),
    //         data:$lastForm.find('form').serialize(),
    //         success: function(json) {
    //             if (json.errors) {
    //                 // ошибка
    //                 jQuery('.code_wrapper .error').text(json.error);

    //             } else {
    //                 alert('success');
    //                 // успех
    //                 // location.href = '/';
    //             }
    //         }
    //     });
    // })

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