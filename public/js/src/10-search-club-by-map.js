jQuery(function() {
    let map = document.getElementById('search_club_by_map'),
        clubs = [],
        activeClub = null;

    if (!map) {
        return;
    }

    if (!window.ymaps) {
        return;
    }

    ymaps.ready(() => {
        let scrollParent = jQuery('[data-search-club-by-map] .simplebar-content-wrapper'),
            wrapper = document.querySelector('[data-search-club-by-map]');

        let $firstClub = jQuery('[data-role-club]').eq(0),
            center = [
                $firstClub.data('lat'),
                $firstClub.data('lon')
            ];

        let myMap = new ymaps.Map(map, {
            center: fixCoordinatesCenter(center, 11),
            zoom: 11,
            behaviors: ['drag', 'dblClickZoom', 'ruler', 'routeEditor', 'leftMouseButtonMagnifier']
        });

        jQuery('[data-role-club]').each(function() {
            let $club = jQuery(this);

            let placemark = new ymaps.Placemark([$club.data('lat'), $club.data('lon')], {}, {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#image',
                // Своё изображение иконки метки.
                iconImageHref: '/img/ballon.svg',
                // Размеры метки.
                iconImageSize: [28, 40],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [-14, -40],
                zIndex: 1
            });

            placemark.events.add('click', function() {
                let clubId = $club.data('id');

                jQuery('[data-role-club]').removeClass('active');

                activateClubById(clubId);
                scrollToElement(wrapper, scrollParent, jQuery(`[data-id='${clubId}']`));

                jQuery(`[data-id='${clubId}']`).addClass('active');
            });

            myMap.geoObjects.add(placemark);

            clubs.push({id: $club.data('id'), placemark});
        });

        jQuery(document).on('mouseover', '[data-search-club-by-map] [data-role-club][data-id]', function(e) {
            let $this = jQuery(this);
            activateClubById($this.data('id'));
        });

        function activateClubById(id) {
            if (activeClub && activeClub.id === id) {
                return;
            }

            let club = clubs.find((item) => item.id === id);

            if (!club) {
                return;
            }

            if (activeClub) {
                activeClub.placemark.options.set('iconImageHref', '/img/ballon.svg');
                activeClub.placemark.options.set('zIndex', 1);
            }

            club.placemark.options.set('iconImageHref', '/img/active_ballon.svg');
            club.placemark.options.set('zIndex', 2);

            myMap.setCenter(
                fixCoordinatesCenter(club.placemark.geometry.getCoordinates(), myMap.getZoom()),
                myMap.getZoom(),
                {
                    duration: 800,
                    timingFunction: 'ease'
                }
            );

            activeClub = club;
        }

        function fixCoordinatesCenter(coords, zoom) {
            let [x, y] = coords;

            if (window.matchMedia('(max-width: 760px)').matches) {
                x -= 0.025 * 8 / zoom;
            } else if (window.matchMedia('(max-width: 1500px)').matches) {
                x -= 0.05 * 8 / zoom;
            } else {
                y -= 0.15 * 8 / zoom;
            }

            return [x, y];
        }

        function scrollToElement(wrapper, list, element) {
            let style = getComputedStyle(wrapper),
                listOffsetTop = list.offset().top,
                elementOffsetTop = element.offset().top,
                listScrollTop = list[0].scrollTop,
                wrapperPaddingTop = parseFloat(style.paddingTop ? style.paddingTop.replace('px', '') : '0'),

                listOffsetLeft = list.offset().left,
                elementOffsetLeft = element.offset().left,
                listScrollLeft = list[0].scrollLeft,
                wrapperPaddingLeft = parseFloat(style.paddingTop ? style.paddingTop.replace('px', '') : '0');

            list[0].scrollTop = elementOffsetTop - listOffsetTop + listScrollTop - wrapperPaddingTop;
            list[0].scrollLeft = elementOffsetLeft - listOffsetLeft + listScrollLeft - wrapperPaddingLeft;
        }
    });
});


