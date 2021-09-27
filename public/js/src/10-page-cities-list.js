jQuery(function() {
    let $form = jQuery('#cities-list-form'),
        $letterCheckboxes = $form.find('[name="city_letter"]'),
        $uncheckFilter = jQuery('.cities_list_checkbox_wrapper .title'),
        filteredLetters = [],
        filterSearchValue = '',
        cityElements = [],
        cityLinksByName = {},
        cityLinksByFirstLetter = {};

    if ($form.length === 0) {
        return;
    }

    document.querySelectorAll('.cities_list a').forEach(function(element) {
        let cityName = convertSearchText(element.textContent),
            firstLetter = cityName.substr(0, 1);

        cityLinksByName[cityName] = cityLinksByName[cityName] || [];
        cityLinksByFirstLetter[firstLetter] = cityLinksByFirstLetter[firstLetter] || [];

        cityElements.push(element);
        cityLinksByName[cityName].push(element);
        cityLinksByFirstLetter[firstLetter].push(element);
    });

    $form.on('change', '[name="city_letter"]', function(e) {
        filteredLetters = $letterCheckboxes
            .filter(':checked')
            .map(function() {
                return this.value.toLowerCase();
            })
            .toArray();

        renderFilteredItems();
    });

    $form.on('input change', '[name="search"]', function(e) {
        filterSearchValue = convertSearchText(this.value);

        renderFilteredItems();
    });

    $uncheckFilter.on('click', function(e) {
        for (let i=0 ;i<$letterCheckboxes.length; i++) {
            $letterCheckboxes[i].checked=false;
        }

        filteredLetters = $letterCheckboxes
            .filter(':checked')
            .map(function() {
                return this.value.toLowerCase();
            })
            .toArray();

        renderFilteredItems();
    });

    function renderFilteredItems() {
        cityElements.forEach(e => e.style.display = '');

        if (filteredLetters.length > 0) {
            for (let firstLetter in cityLinksByFirstLetter) {
                if (filteredLetters.includes(firstLetter) === false) {
                    cityLinksByFirstLetter[firstLetter].forEach(e => e.style.display = 'none');
                }
            }
        }

        if (filterSearchValue.length > 0) {
            for (let cityName in cityLinksByName) {
                if (cityName.indexOf(filterSearchValue) === -1) {
                    cityLinksByName[cityName].forEach(e => e.style.display = 'none');
                }
            }
        }
    }

    function convertSearchText(text) {
        return `${text}`.trim().toLowerCase();
    }
});
