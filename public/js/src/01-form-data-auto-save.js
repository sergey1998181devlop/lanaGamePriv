// jQuery(function() {
//     jQuery('[data-auto-save]').each(function() {
//         let $form = jQuery(this),
//             form_name = $form.data('auto-save');
//
//         $form.on('change input', 'input:not([type="file"]):not([type="radio"]):not([type="checkbox"]), textarea, select', function(e) {
//             let $input = jQuery(this),
//                 input_name = $input.attr('name');
//             storageSet(form_name, input_name, $input.val());
//         });
//
//         $form.on('change', 'input[type="radio"], input[type="checkbox"]', function(e) {
//             let $input = jQuery(this),
//                 input_name = $input.attr('name');
//             storageSet(form_name, input_name, this.checked ? $input.val() : null);
//         });
//
//         $form.find('input:not([type="file"]):not([type="radio"]):not([type="checkbox"]), select, textarea').each(function() {
//             let $input = jQuery(this),
//                 input_name = $input.attr('name');
//
//             if ($input.val() === '') {
//                 $input.val(storageGet(form_name, input_name) || '');
//             }
//         });
//
//         $form.find('input[type="checkbox"], input[type="radio"]').each(function() {
//             let $input = jQuery(this),
//                 input_name = $input.attr('name'),
//                 value = storageGet(form_name, input_name);
//
//             if(value !== null){
//                 this.checked = $input.val() === value;
//             }
//         });
//
//         $form[0].addEventListener(
//             'submit',
//             () => localStorage.removeItem(form_name),
//             {capture: true}
//         );
//
//         $form[0].addEventListener(
//             'reset',
//             () => localStorage.removeItem(form_name),
//             {capture: true}
//         );
//     });
//
//     function storageGetAll(form_name) {
//         let data = {};
//
//         try {
//             data = JSON.parse(localStorage.getItem(form_name) || '{}');
//         } catch (e) {
//
//         }
//
//         return data;
//     }
//
//     function storageGet(form_name, input_name) {
//         let data = storageGetAll(form_name);
//
//         return data[input_name] || null;
//     }
//
//     function storageSet(form_name, input_name, value = null) {
//         let data = storageGetAll(form_name);
//
//         if(value !== null){
//             data[input_name] = value;
//         }else{
//             delete data[input_name];
//         }
//
//         localStorage.setItem(form_name, JSON.stringify(data));
//     }
// });
