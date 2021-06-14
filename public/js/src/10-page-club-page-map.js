jQuery(function() {
    let map = document.getElementById('club_page_map');

    if (!map) {
        return;
    }

    if (!window.ymaps) {
        return;
    }

    ymaps.ready(() => {
        new ymaps.Map(map, {
            center: [55.76, 37.64],
            zoom: 7
        });
    });
});