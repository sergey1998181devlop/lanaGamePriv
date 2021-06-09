window.Layout = (() => {
    return {
        initSelect2() {
            jQuery('.select2_wrapper select:not([data-select2-id])').each(function() {
                let $this = jQuery(this);



                $this.select2({
                    minimumResultsForSearch: Infinity,
                    placeholder: $this.data('placeholder'),
                    dropdownParent: $this.closest('.select2_wrapper'),
                    width: '100%'
                });
            });

            jQuery('.pc_configuration_content_wrapper .select2_wrapper select').each(function() {
                let $this = jQuery(this);

                $this.select2({
                    minimumResultsForSearch: 1,
                    placeholder: $this.data('placeholder'),
                    dropdownParent: $this.closest('.select2_wrapper'),
                    width: '100%'
                }).on('select2:opening', function(e) {
                    $(this).data('select2').$dropdown.find(':input.select2-search__field').attr('placeholder', 'Поиск...')
                })
            });
        }
    };
})();