// jQuery(function() {
//     let $form = jQuery('#cities-list-form'),
//         $gamesList = jQuery('.cities_list'),
//         $search = $form.find('[name="search"]');
//
//     if ($form.length === 0) {
//         return;
//     }
//
//     jQuery('[data-city-link]').each((elem) => {
//       console.log(elem[0]);
//     });
//
//     let cities = [],
//         timeout;
//
//     // jQuery('[data-games-group] ul li a').each(function() {
//     //     var $link = jQuery(this),
//     //         text = $link.text();
//     //
//     //     cities.push({
//     //         text: convertTextForSearch(text),
//     //         element: $link.closest('li')
//     //     });
//     // });
//
//     $form.on('input change reset', function(e) {
//         let groups = [];
//             // search = convertTextForSearch($search.val());
//
//         clearTimeout(timeout);
//
//         timeout = setTimeout(function() {
//             // Group filter
//             (function() {
//                 $form.find('input[name="group"]:checked').each(function() {
//                     groups.push(this.value);
//                 });
//
//                 if (groups.length > 0) {
//                     groups.forEach((elem) => {
//                         // if (elem[0] === jQuery('[data-city-link]')[0])
//                     });
//                     // jQuery('[data-games-group]').each(function() {
//                     //     var $group = jQuery(this),
//                     //         group = $group.data('games-group');
//                     //
//                     //     $group.toggleClass('hidden', groups.indexOf(group) === -1);
//                     // });
//                 } else {
//                     jQuery('[data-games-group]').removeClass('hidden');
//                 }
//             })();
//
//             // Search filter
//             // (function() {
//             //     if (search) {
//             //         for (let i in games) {
//             //             let text = games[i].text,
//             //                 $li = games[i].element,
//             //                 $group = $li.closest('[data-games-group]');
//             //
//             //             $li.toggleClass('hidden', text.indexOf(search) === -1);
//             //             $group.toggle($group.find('ul li:not(.hidden)').length !== 0);
//             //         }
//             //     } else {
//             //         jQuery('[data-games-group]').show();
//             //         jQuery('[data-games-group] ul li').removeClass('hidden');
//             //     }
//             // })();
//
//             // jQuery('.sliders_wrapper').toggleClass('hidden', !!search || (groups.length > 0));
//             // jQuery('[data-role="search-by-input-count"]').text(jQuery('[data-games-group] ul li:visible').length);
//             //
//             // $gamesList.toggleClass('search_by_group', groups.length > 0);
//             // $gamesList.toggleClass('search_by_input', !!search);
//         }, 150);
//     });
//
//     // $form.on('click', 'input[name="group"]', function(e) {
//     //     var clickedInput = this;
//     //
//     //     setTimeout(function() {
//     //         if (clickedInput.checked) {
//     //             $form
//     //                 .find('input[name="group"][value!="' + clickedInput.value + '"]:checked')
//     //                 .prop('checked', false)
//     //                 .trigger('change');
//     //         }
//     //     }, 25);
//     // });
//
//     function convertTextForSearch(input) {
//         return ('' + input).replace(/[^a-zа-яё0-9]/igm, '').toLowerCase();
//     }
// });
