jQuery(function() {

//    in header
    $('#city_selector').on('select2:select', function(e) {
        var url = $('meta[name="site"]').attr('content');
        window.location.href = url + '/' + e.params.data.data;
    });

    $('#city_selector').select2({
        ajax: {
            url: $('meta[name="site"]').attr('content') + '/searchCities',
            dataType: 'json'
        },
        cache: true
    });

// in club add modal
    $('#add-club-form #select-сity').select2({
        ajax: {
            url: $('meta[name="site"]').attr('content') + '/searchCities',
            dataType: 'json',
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page,
                    selected: $('#add-club-form #select-сity').val()
                };
            }
        },
        cache: true
    });
// in club add modal
    $('#add-club-form #select-сity').on('select2:select', function(e) {
        $('#add-club-form #select-subway').val('').change();
        if (e.params.data.has_metro == 1) {
            $('#add-club-form #select-subway').attr('disabled', false);
        } else {
            $('#add-club-form #select-subway').attr('disabled', true);
        }

    });

// in club add modal
    $('#add-club-form #select-subway').select2({
        ajax: {
            url: $('meta[name="site"]').attr('content') + '/searchMetro',
            dataType: 'json',
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page,
                    city_id: $('#add-club-form #select-сity').val()
                };
            }
        },
        cache: true
    });
    $('#add-club-form #select-subway').on('select2:select', function(e) {
        $('#add-club-form #select-subway option[value="' + e.params.data.id + '"]').attr('data-line-color', '#' + e.params.data.color);
    });

});
