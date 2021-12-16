jQuery(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery.fn.select2.amd.define('select2/data/dependsOnSelectAdapter', ['select2/data/array', 'select2/utils'], function(ArrayAdapter, Utils) {
        function DependsOnSelectAdapter($element, options) {
            DependsOnSelectAdapter.__super__.constructor.call(this, $element, options);
        }

        Utils.Extend(DependsOnSelectAdapter, ArrayAdapter);

        DependsOnSelectAdapter.prototype.current = function(callback) {
            let $select = this.$element,
                $option = $select.find(`option[value="${$select.val()}"]`),
                results = [];

            if ($option.length > 0) {
                results.push({
                    id: $option.val(),
                    text: $option.text()
                });
            }

            callback(results);
        };

        DependsOnSelectAdapter.prototype.query = function(params, callback) {
            let $select = this.$element,
                $dependOnSelect = jQuery($select.data('select2-depends-on')),
                results = [];

            $select.find('option[data-depend-value]').each(function() {
                let $option = jQuery(this),
                    dependValue = $option.data('depend-value');

                if (dependValue === $dependOnSelect.val()) {
                    results.push({
                        id: $option.val(),
                        text: $option.text()
                    });
                }
            });

            if (params?.term) {
                let filteredTerm = params.term.toLowerCase().replaceAll(/[^а-яёa-z0-9]/muig, '');

                results = results.filter(({text}) => {
                    let filteredText = text.toLowerCase().replaceAll(/[^а-яёa-z0-9]/muig, '');

                    return filteredText.includes(filteredTerm);
                });
            }

            callback({results});
        };

        return DependsOnSelectAdapter;
    });
});

window.Layout = (() => {
    return {
        meta(name) {
            return jQuery(`meta[name="${name}"]`).attr('content') || null;
        },
        isAdmin() {
            return Layout.meta('is_admin') === '1';
        },
        isPlayer() {
            return Layout.meta('user-role') === 'player';
        },
        isOwner() {
            return Layout.meta('user-role') === 'owner';
        },
        isGuest() {
            return Layout.meta('user-role') === 'guest';
        },

        showInfoModal(text) {
            jQuery('[data-remodal-id="success_modal"]')
                .find('.title')
                .html(text);
            jQuery('[data-remodal-id="success_modal"]').remodal().open();
        },

        initSelect2() {
            jQuery('.select2_wrapper select:not([data-select2-id]):not([data-select2-skip-auto-init])').each(function() {
                let $this = jQuery(this),
                    options = {
                        minimumResultsForSearch: 1,
                        placeholder: $this.data('placeholder'),
                        dropdownParent: $this.closest('.select2_wrapper'),
                        width: '100%'
                    };

                if ($this.is('[data-select2-without-search]')) {
                    options.minimumResultsForSearch = Infinity;
                }

                if ($this.is('[data-select2-depends-on]')) {
                    let $dependSelect = jQuery($this.data('select2-depends-on'));

                    options.dataAdapter = jQuery.fn.select2.amd.require('select2/data/dependsOnSelectAdapter');

                    $dependSelect.on('change', function() {
                        $this.val('').trigger('change');
                    });
                }

                $this.select2(options).on('select2:opening', function(e) {
                    $this.data('select2').$dropdown.find(':input.select2-search__field').attr('placeholder', 'Поиск...');
                });
            });
        },

        fileUpload(file, url = '/clubs/add-image', onprogress = null) {
            return new Promise((resolve, reject) => {
                let xhr = new XMLHttpRequest(),
                    formData = new FormData();

                formData.append('file', file, file.name);
                formData.append('_token', $('[name="_token"]').val());

                if (typeof onprogress === 'function') {
                    onprogress(0, file.size);
                }

                xhr.upload.onprogress = function(event) {
                    if (typeof onprogress === 'function') {
                        onprogress(event.loaded, event.total);
                    }
                };

                xhr.onload = xhr.onerror = function() {
                    try {
                        let response = JSON.parse(xhr.responseText);

                        if (response.error) {
                            return reject(response.error);
                        }

                        if (response?.errors?.file) {
                            return reject(response?.errors?.file);
                        }

                        if (xhr.status >= 400) {
                            return reject('Произошла непредвиденная ошибка');
                        } else {
                            resolve(response.data);
                        }
                    } catch (e) {
                        return reject('Произошла непредвиденная ошибка');
                    }
                };

                xhr.open('POST', url, true);
                xhr.send(formData);
            });
        }
    };
})();

