(() => {
    // use strict

    jQuery.fn.extend({
        formWizard(options = {}) {
            let self = this,
                inputWrapperSelector = options.inputWrapperSelector || '.form-group',
                inputErrorSelector = options.inputErrorSelector || '.error',
                submitButtonSelector = options.submitButtonSelector || '[type="submit"]',
                prevButtonSelector = options.prevButtonSelector || '[data-role="prev-tab-button"]',
                prevButtonText = options.prevButtonText || 'Назад',
                nextButtonSelector = options.nextButtonSelector || '[data-role="next-tab-button"]',
                nextButtonText = options.nextButtonText || 'Вперед',
                tabSelector = options.tabSelector || '[data-role="tabs"]',
                activeTab = options.activeTab || 0;

            let $submitButton = self.find(submitButtonSelector),
                $prevButton = self.find(prevButtonSelector),
                $nextButton = self.find(nextButtonSelector),
                $tabs = self.find(tabSelector);

            if ($tabs.length <= 1) {
                return self;
            }

            showTab(activeTab);

            $nextButton.on('click', goToNextTab);
            $prevButton.on('click', goToPrevTab);

            this.on('input change', 'input, textarea, select', function() {
                setInputError(this, '');
            });

            function showTab(index) {
                let $activeTab = $tabs.hide().eq(index).show(),
                    activeTabPrevButtonText = $activeTab.data('prev-button-text') || prevButtonText,
                    activeTabNextButtonText = $activeTab.data('next-button-text') || nextButtonText;

                $submitButton.toggle(index === $tabs.length - 1);
                $prevButton.toggle(index > 0).text(activeTabPrevButtonText);
                $nextButton.toggle(index < $tabs.length - 1).text(activeTabNextButtonText);

                activeTab = index;

                self.trigger('show-tab', [activeTab]);
            }

            function goToNextTab() {
                if (activeTab >= $tabs.length - 1) {
                    return;
                }

                if (validateActiveTab() === false) {
                    self.trigger('error-tab');
                    return;
                }

                showTab(activeTab + 1);
            }

            function goToPrevTab() {
                if (activeTab === 0) {
                    return;
                }

                showTab(activeTab - 1);
            }

            function validateActiveTab() {
                let $activeTab = $tabs.eq(activeTab),
                    hasErrors = false;

                $activeTab.find('input, select, textarea').each(function() {
                    setInputError(this, '');
                });

                $activeTab.find(
                    'input[required][type="text"]:not(:disabled),' +
                    'input[required][type="password"]:not(:disabled),' +
                    'input[required][type="email"]:not(:disabled),' +
                    'input[required][type="tel"]:not(:disabled),' +
                    'input[required][type="url"]:not(:disabled),' +
                    'input[required][type="number"]:not(:disabled),' +
                    'select[required]:not(:disabled),' +
                    'textarea[required]:not(:disabled)'
                ).each(function() {
                    let $input = jQuery(this),
                        value = $input.val();

                    if (!value) {
                        hasErrors = true;
                        setInputError(this, 'Необходимо заполнить данное поле');
                    }
                });

                $activeTab.find('input[type="email"]:not(:disabled)').each(function() {
                    let $input = jQuery(this),
                        value = $input.val();

                    if (value && /^.+@.+\..+$/.test(value) === false) {
                        hasErrors = true;
                        setInputError(this, 'Необходимо ввести валидный e-mail');
                    }
                });

                $activeTab.find('input[type="url"]:not(:disabled)').each(function() {
                    let $input = jQuery(this),
                        value = $input.val();

                    if (value && /^.+\..+$/.test(value) === false) {
                        hasErrors = true;
                        setInputError(this, 'Необходимо ввести валидный url');
                    }
                });

                return hasErrors === false;
            }

            function setInputError(input, error) {
                let $formGroup = jQuery(input).closest(inputWrapperSelector),
                    $error = $formGroup.find(inputErrorSelector);

                $formGroup.toggleClass('has-error', !!error);

                $error.text(error || '');
            }

            return self;
        }
    });
})();
