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
        }
    };
})();
