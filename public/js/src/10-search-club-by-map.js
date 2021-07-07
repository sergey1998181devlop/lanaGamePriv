jQuery(function() {
    let map = document.getElementById('search_club_by_map'),
        clubs = [];

    if (!map) {
        return;
    }

    if (!window.ymaps) {
        return;
    }


    jQuery('[data-role-club]').each(function() {
        let $club = jQuery(this);

        clubs.push({lon: $club.data('lon'), lat: $club.data('lat')});
    });

    if (window.matchMedia('(min-width: 1500px)').matches) {
        ymaps.ready(() => {

            let myMap = new ymaps.Map(map, {
                center: [clubs[0].lat, clubs[0].lon - 0.3],
                zoom: 10
            });

            for (let club of clubs) {
                let placemark = new ymaps.Placemark([club.lat, club.lon], {
                    // Опции.
                    // Необходимо указать данный тип макета.
                    iconLayout: 'default#image',
                    // Своё изображение иконки метки.
                    iconImageHref: '/img/ballon.svg',
                    // Размеры метки.
                    iconImageSize: [28, 40],
                    // Смещение левого верхнего угла иконки относительно
                    // её "ножки" (точки привязки).
                    iconImageOffset: [-14, -20]
                });

                myMap.geoObjects.add(placemark);
            }
        });
    }

    if (window.matchMedia('(max-width: 1500px)').matches) {
        ymaps.ready(() => {

            let myMap = new ymaps.Map(map, {
                center: [clubs[0].lat - 0.1, clubs[0].lon],
                zoom: 10
            });

            for (let club of clubs) {
                let placemark = new ymaps.Placemark([club.lat, club.lon], {
                    // Опции.
                    // Необходимо указать данный тип макета.
                    iconLayout: 'default#image',
                    // Своё изображение иконки метки.
                    iconImageHref: '/img/ballon.svg',
                    // Размеры метки.
                    iconImageSize: [28, 40],
                    // Смещение левого верхнего угла иконки относительно
                    // её "ножки" (точки привязки).
                    iconImageOffset: [-14, -20]
                });

                myMap.geoObjects.add(placemark);
            }
        });
    }

    if (window.matchMedia('(max-width: 760px)').matches) {
        ymaps.ready(() => {

            let myMap = new ymaps.Map(map, {
                center: [clubs[0].lat + 0.1, clubs[0].lon],
                zoom: 10
            });

            for (let club of clubs) {
                let placemark = new ymaps.Placemark([club.lat, club.lon], {
                    // Опции.
                    // Необходимо указать данный тип макета.
                    iconLayout: 'default#image',
                    // Своё изображение иконки метки.
                    iconImageHref: '/img/ballon.svg',
                    // Размеры метки.
                    iconImageSize: [28, 40],
                    // Смещение левого верхнего угла иконки относительно
                    // её "ножки" (точки привязки).
                    iconImageOffset: [-14, -20]
                });

                myMap.geoObjects.add(placemark);
            }
        });
    }
});


