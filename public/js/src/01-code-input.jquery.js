(() => {
    // use strict

    const KEY_BACKSPACE = 8,
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

    jQuery.fn.extend({
        codeInput(options = {}) {
            let inputCount = options.inputCount || 4,
                inputWrapperClass = options.inputWrapperClass || 'code_input_wrapper';

            jQuery(this).each(function() {
                let $self = jQuery(this),
                    $wrapper = jQuery(`<div class="${inputWrapperClass}"></div>`);

                for (let i = 0; i < inputCount; ++i) {
                    let $input = jQuery('<input type="text" maxlength="1">');

                    $input.on('keydown', function(e) {
                        let key = e.keyCode || e.which;

                        if (CODE_ALLOWED_KEYBOARD_KEYS.indexOf(key) === -1) {
                            e.preventDefault();
                        }
                    });

                    $input.on('keyup input', function(e) {
                        let $this = jQuery(this),
                            key = e.keyCode || e.which,
                            value = '';

                        $wrapper.find('input').each(function() {
                            value += jQuery(this).val();
                        });

                        $self.val(value);

                        if (key === KEY_BACKSPACE || key === KEY_DELETE) {
                            $this.val('').prev('input').trigger('focus');

                            return;
                        }

                        if (e.type === 'input') {
                            $self.trigger('input');
                        }

                        if ($this.val().length === 1) {
                            if ($this.next('input').length > 0) {
                                $this.next('input').trigger('focus');
                            } else {
                                if (e.type === 'input') {
                                    setTimeout(() => {
                                        $self.trigger('change');
                                    }, 50);
                                }
                            }
                        }
                    });

                    $wrapper.append($input);
                }

                $self.hide();
                $self.after($wrapper);
            });
        }
    });

    jQuery(function() {
        jQuery('[data-input-code]').codeInput();
    });
})();