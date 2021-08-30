jQuery(function() {
    let map = document.getElementById('search_club_by_map'),
        clubs = [],
        activeClub = null,
        zoomTop = 400;

    if (window.matchMedia('(max-width: 760px)').matches){
        zoomTop = 100;
    }


    if (!map) {
        return;
    }

    if (!window.ymaps) {
        return;
    }

    ymaps.ready(() => {
        let scrollParent = jQuery('[data-search-club-by-map]'),
            wrapper = document.querySelector('[data-search-club-by-map]');

        let center = [
                window.CITY_LAT,
                window.CITY_LON
            ];

        let myMap = new ymaps.Map(map, {
            center: fixCoordinatesCenter(center, 11),
            zoom: 11,
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
                        color :'red',
                    },
                    {
                        href: '/img/icon-red-border.svg',
                        size: [60, 60],
                        offset: [-30, -30],textColor :'red',
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
            hasBalloon:false,
            minClusterSize:4,
            textColor :'red',
            
        })

        let zoomControl = new ymaps.control.ZoomControl({
            options: {
                position: {left: 'auto', right: 10, top: zoomTop}
            }
        });
        myMap.controls.add(zoomControl);

        jQuery('[data-role-club]').each(function() {
            let $club = jQuery(this);

            let placemark = new ymaps.Placemark([$club.data('lat'), $club.data('lon')], {}, {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#image',
                // Своё изображение иконки метки.
                iconImageHref: '/img/ballon.svg',
                // Размеры метки.
                iconImageSize: [42,60],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [-14, -40],
                zIndex: 1
            });

            placemark.events.add('click', function() {
                let clubId = $club.data('id');

                jQuery('[data-role-club]').removeClass('active');
                $('.search_club_list .search_club_item.another_city').hide();
                if($('.search_club_list [data-id='+clubId+']').hasClass('another_city')){
                    if( typeof  $('.search_club_list [data-id='+clubId+'] .main_preview_photo').attr('src') == 'undefined'){
                        $('.search_club_list [data-id='+clubId+'] .main_preview_photo').attr('src',$('.search_club_list [data-id='+clubId+'] .main_preview_photo').attr('asrc'))
                    }
                    $('.search_club_list [data-id='+clubId+']').show()
                }
                activateClubById(clubId);
                scrollToElement(wrapper, scrollParent, jQuery(`[data-id='${clubId}']`));

                jQuery(`[data-id='${clubId}']`).addClass('active');
                
            });

            // myMap.geoObjects.add(placemark);
            clusterer.add(placemark);
            myMap.geoObjects.add(clusterer);

            clubs.push({id: $club.data('id'), placemark});
        });

        jQuery(document).on('mouseover', '[data-search-club-by-map] [data-role-club][data-id]', function(e) {
            let $this = jQuery(this);
            jQuery('[data-role-club]').removeClass('active');
            activateClubById($this.data('id'));
            $this.addClass('active');
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

            // if (window.matchMedia('(max-width: 760px)').matches) {
            //     x -= 0.025 * 8 / zoom;
            // } else if (window.matchMedia('(max-width: 1500px)').matches) {
            //     x -= 0.05 * 8 / zoom;
            // } else {
            //     y -= 0.15 * 8 / zoom;
            // }

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

            list[0].scrollTop = elementOffsetTop - listOffsetTop + listScrollTop -wrapperHeight/2 + elemHeight/2;
            list[0].scrollLeft = elementOffsetLeft - listOffsetLeft + listScrollLeft - wrapperPaddingLeft;
        }
        myMap.setBounds(clusterer.getBounds(), {
            checkZoomRange: true
        });
    });
   
});


