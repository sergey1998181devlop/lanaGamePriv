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
                return null;
            }

            showTab(activeTab);

            $nextButton.on('click', goToNextTab);
            $prevButton.on('click', goToPrevTab);

            this.on('input change', 'input, textarea, select', function() {
                setInputError(this, '');
            });

            function showTab(index) {
                let $closingTab = activeTab !== index ? $tabs.eq(activeTab) : jQuery(),
                    $openingTab = $tabs.eq(index),
                    activeTabPrevButtonText = $openingTab.data('prev-button-text') || prevButtonText,
                    activeTabNextButtonText = $openingTab.data('next-button-text') || nextButtonText;

                $closingTab.trigger('close');
                $openingTab.trigger('open');

                $tabs.hide();
                $openingTab.show();

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

                validateActiveTab()
                    .then(function() {
                        showTab(activeTab + 1);
                    })
                    .catch(function() {
                        self.trigger('error-tab');
                    });
            }

            function goToPrevTab() {
                if (activeTab === 0) {
                    return;
                }

                showTab(activeTab - 1);
            }

            function validateStandardInputErrors() {
                let $activeTab = $tabs.eq(activeTab);

                return new Promise((resolve, reject) => {
                    let hasErrors = false;

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

                    return hasErrors ? reject() : resolve();
                });
            }

            function validateActiveTab() {
                let $activeTab = $tabs.eq(activeTab),
                    standardValidation = validateStandardInputErrors(),
                    customTabValidation = typeof $activeTab.data('form-wizard-tab-validation') === 'function' ? $activeTab.data('form-wizard-tab-validation')() : true;

                return Promise.all([
                    standardValidation,
                    customTabValidation
                ]);
            }

            function setInputError(input, error) {
                let $formGroup = jQuery(input).closest(inputWrapperSelector),
                    $error = $formGroup.find(inputErrorSelector);

                $formGroup.toggleClass('has-error', !!error);

                $error.text(error || '');
            }

            return {
                showTab,
                goToNextTab,
                goToPrevTab,
                validateActiveTab
            };

            return {
                showTab,
                goToNextTab,
                goToPrevTab,
                validateActiveTab
            };
        }
    });
})();
