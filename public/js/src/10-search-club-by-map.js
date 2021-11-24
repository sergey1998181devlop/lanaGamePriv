jQuery(function() {
    let $map = document.getElementById('sc_by_map'),
        clubGeoList = window.clubGeoList || [],
        clubPlacemarks = {},
        activeClubId = null,
        zoomTop = 400;

    if (window.matchMedia('(max-width: 760px)').matches) {
        zoomTop = 100;
    }


    if (!$map) {
        return;
    }

    if (!window.ymaps) {
        return;
    }

    ymaps.ready(() => {
        let scrollParent = jQuery('[data-search-club-by-map]'),
            wrapper = document.querySelector('[data-search-club-by-map]'),
            map = new ymaps.Map($map, {
                center: fixCoordinatesCenter([window.CITY_LAT, window.CITY_LON], window.MAP_ZOOM),
                zoom: window.MAP_ZOOM,
                behaviors: ['drag', 'dblClickZoom'],
                controls: []
            }),
            /**
             * Создадим кластеризатор, вызвав функцию-конструктор.
             * Список всех опций доступен в документации.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#constructor-summary
             */
            clusterer = new ymaps.Clusterer({
                clusterIcons: [
                    {
                        href: '/img/icon-red-border.svg',
                        size: [40, 40],
                        offset: [-20, -20],
                        color: 'red'
                    },
                    {
                        href: '/img/icon-red-border.svg',
                        size: [60, 60],
                        offset: [-30, -30], textColor: 'red'
                    }],

                /**
                 * Через кластеризатор можно указать только стили кластеров,
                 * стили для меток нужно назначать каждой метке отдельно.
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
                 */
                // preset: 'islands#redClusterIcons',
                /**
                 * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
                 */
                groupByCoordinates: false,
                /**
                 * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
                 */
                clusterDisableClickZoom: false,
                clusterHideIconOnBalloonOpen: false,
                geoObjectHideIconOnBalloonOpen: false,
                hasBalloon: false,
                minClusterSize: 4,
                textColor: 'red'
            });

        let zoomControl = new ymaps.control.ZoomControl({
            options: {
                position: {left: 'auto', right: 10, top: zoomTop}
            }
        });

        map.controls.add(zoomControl);

        map.events.add('boundschange', function(e) {
            renderMapPlacemarks();
        });

        map.geoObjects.add(clusterer);

        jQuery(document).on('mouseover', '[data-search-club-by-map] [data-role-club][data-id]', function(e) {
            let $this = jQuery(this);
            jQuery('[data-role-club]').removeClass('active');
            activateClubById($this.data('id'), Math.min(14, map.getZoom()));
            $this.addClass('active');
        });

        function activateClubById(id, zoom) {
            zoom = zoom || map.getZoom();

            if (activeClubId === id) {
                return;
            }

            if (!clubPlacemarks[id]) {
                return;
            }

            if (clubPlacemarks[activeClubId]) {
                clubPlacemarks[activeClubId].options.set('iconImageHref', '/img/ballon.svg');
                clubPlacemarks[activeClubId].options.set('zIndex', 1);
            }

            clubPlacemarks[id].options.set('iconImageHref', '/img/active_ballon.svg');
            clubPlacemarks[id].options.set('zIndex', 2);

            if (!window.IS_GLOBAL_MAP) {
                map.setCenter(
                    fixCoordinatesCenter(clubPlacemarks[id].geometry.getCoordinates(), zoom),
                    zoom,
                    {
                        duration: 800,
                        timingFunction: 'ease'
                    }
                );
            }

            activeClubId = id;
        }

        function fixCoordinatesCenter(coords, zoom) {
            let [x, y] = coords;

            if (zoom > 12) {
                return coords;
            }

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
                styleElem = getComputedStyle(element[0]),
                listOffsetTop = list.offset().top,
                elementOffsetTop = element.offset().top,
                listScrollTop = list[0].scrollTop,
                wrapperHeight = parseFloat(style.height ? style.height.replace('px', '') : '0'),
                elemHeight = parseFloat(styleElem.height ? styleElem.height.replace('px', '') : '0'),

                listOffsetLeft = list.offset().left,
                elementOffsetLeft = element.offset().left,
                listScrollLeft = list[0].scrollLeft,
                wrapperPaddingLeft = parseFloat(style.paddingTop ? style.paddingTop.replace('px', '') : '0');

            list[0].scrollTop = elementOffsetTop - listOffsetTop + listScrollTop - wrapperHeight / 2 + elemHeight / 2;
            list[0].scrollLeft = elementOffsetLeft - listOffsetLeft + listScrollLeft - wrapperPaddingLeft;
        }

        function renderMapPlacemarks() {
            let bounds = map.getBounds(),
                latMin = bounds[0][0],
                latMax = bounds[1][0],
                lonMin = bounds[0][1],
                lonMax = bounds[1][1];

            for (let {id, lon, lat} of clubGeoList) {
                if (lat >= latMin && lat <= latMax && lon >= lonMin && lon <= lonMax) {
                    // placemark in visible area
                    clubPlacemarks[id] = clubPlacemarks[id] || createClubPlacemark(id, lon, lat);

                    clubPlacemarks[id].options.set('visible', true);
                } else if (clubPlacemarks[id]) {
                    // placemark exists, but not in visible area
                    clubPlacemarks[id].options.set('visible', false);
                }
            }
        }

        function createClubPlacemark(id, lon, lat) {
            let placemark = new ymaps.Placemark([lat, lon], {}, {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#image',
                // Своё изображение иконки метки.
                iconImageHref: '/img/ballon.svg',
                // Размеры метки.
                iconImageSize: [42, 60],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [-14, -40],
                zIndex: 1
            });

            placemark.events.add('click', function() {
                let $club = jQuery(`.sc_list [data-id='${id}']`);

                jQuery('.active[data-role-club]').removeClass('active');
                jQuery('.sc_list .sc_item.another_city').hide();

                if ($club.hasClass('another_city')) {
                    $club.show();
                }

                activateClubById(id);
                scrollToElement(wrapper, scrollParent, $club);

                $club.addClass('active');
            });

            clusterer.add(placemark);

            return placemark;
        }

        setTimeout(renderMapPlacemarks, 150);

        // myMap.setBounds(clusterer.getBounds(), {
        //     checkZoomRange: true
        // });
    });

});


