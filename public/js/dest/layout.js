function recaptchaCallback(){window.recaptchaForm?.submit()}jQuery(function(){function a(e){let t={};try{t=JSON.parse(localStorage.getItem(e)||"{}")}catch(e){}return t}function n(e,t){return a(e)[t]||null}function i(e,t,r=null){let o=a(e);null!==r?o[t]=r:delete o[t],localStorage.setItem(e,JSON.stringify(o))}jQuery("[data-auto-save]").each(function(){let e=jQuery(this),o=e.data("auto-save");e.on("change input",'input:not([type="file"]):not([type="radio"]):not([type="checkbox"]), textarea, select',function(e){let t=jQuery(this),r=t.attr("name");i(o,r,t.val())}),e.on("change",'input[type="radio"], input[type="checkbox"]',function(e){let t=jQuery(this),r=t.attr("name");i(o,r,this.checked?t.val():null)}),e.find('input:not([type="file"]):not([type="radio"]):not([type="checkbox"]), select, textarea').each(function(){let e=jQuery(this),t=e.attr("name");""===e.val()&&e.val(n(o,t)||"")}),e.find('input[type="checkbox"], input[type="radio"]').each(function(){let e=jQuery(this),t=e.attr("name"),r=n(o,t);null!==r&&(this.checked=e.val()===r)}),e[0].addEventListener("submit",()=>localStorage.removeItem(o),{capture:!0}),e[0].addEventListener("reset",()=>localStorage.removeItem(o),{capture:!0})})}),(()=>{const o=[112,48,96,113,49,97,114,50,98,115,51,99,116,52,100,117,53,101,118,54,102,119,55,103,120,56,104,121,57,105,122,123,8,9,46,13];jQuery.fn.extend({codeInput(e={}){let t=e.inputCount||4,r=e.inputWrapperClass||"code_input_wrapper";jQuery(this).each(function(){let a=jQuery(this),n=jQuery(`<div class="${r}"></div>`);for(let e=0;e<t;++e){let e=jQuery('<input type="text" maxlength="1">');e.on("keydown",function(e){var t=e.keyCode||e.which;-1===o.indexOf(t)&&e.preventDefault()}),e.on("keyup input",function(e){let t=jQuery(this),r=e.keyCode||e.which,o="";n.find("input").each(function(){o+=jQuery(this).val()}),a.val(o),8!==r&&46!==r?("input"===e.type&&a.trigger("input"),1===t.val().length&&(0<t.next("input").length?t.next("input").trigger("focus"):"input"===e.type&&setTimeout(()=>{a.trigger("change")},50))):t.val("").prev("input").trigger("focus")}),n.append(e)}a.hide(),a.after(n)})}}),jQuery(function(){jQuery("[data-input-code]").codeInput()})})(),jQuery.fn.extend({formWizard(e={}){let n=this,a=e.inputWrapperSelector||".form-group",i=e.inputErrorSelector||".error",t=e.submitButtonSelector||'[type="submit"]',r=e.prevButtonSelector||'[data-role="prev-tab-button"]',l=e.prevButtonText||"Назад",o=e.nextButtonSelector||'[data-role="next-tab-button"]',u=e.nextButtonText||"Вперед",c=e.tabSelector||'[data-role="tabs"]',s=e.activeTab||0,d=n.find(t),p=n.find(r),f=n.find(o),m=n.find(c);return m.length<=1?null:(y(s),f.on("click",h),p.on("click",_),this.on("input change","input, textarea, select",function(){b(this,"")}),{showTab:y,goToNextTab:h,goToPrevTab:_,validateActiveTab:g});function y(e){let t=s!==e?m.eq(s):jQuery(),r=m.eq(e),o=r.data("prev-button-text")||l,a=r.data("next-button-text")||u;t.trigger("close"),r.trigger("open"),m.hide(),r.show(),d.toggle(e===m.length-1),p.toggle(0<e).text(o),f.toggle(e<m.length-1).text(a),s=e,n.trigger("show-tab",[s])}function h(){s>=m.length-1||g().then(function(){y(s+1)}).catch(function(){n.trigger("error-tab")})}function _(){0!==s&&y(s-1)}function g(){let e=m.eq(s),t=function(){let o=m.eq(s);return new Promise((e,t)=>{let r=!1;return o.find("input, select, textarea").each(function(){b(this,"")}),o.find('input[required][type="text"]:not(:disabled),input[required][type="password"]:not(:disabled),input[required][type="email"]:not(:disabled),input[required][type="tel"]:not(:disabled),input[required][type="url"]:not(:disabled),input[required][type="number"]:not(:disabled),select[required]:not(:disabled),textarea[required]:not(:disabled)').each(function(){let e=jQuery(this),t=e.val();t||(r=!0,b(this,"Необходимо заполнить данное поле"))}),o.find('input[type="email"]:not(:disabled)').each(function(){let e=jQuery(this),t=e.val();t&&!1===/^.+@.+\..+$/.test(t)&&(r=!0,b(this,"Необходимо ввести валидный e-mail"))}),(r?t:e)()})}(),r="function"!=typeof e.data("form-wizard-tab-validation")||e.data("form-wizard-tab-validation")();return Promise.all([t,r])}function b(e,t){let r=jQuery(e).closest(a),o=r.find(i);r.toggleClass("has-error",!!t),o.text(t||"")}}}),$(document).on("change",'.hide-from-search-form input[type="checkbox"]',function(){jQuery.ajax({type:"get",url:$(this).closest("form").attr("action"),success:function(){},error:function(){}})}),jQuery(function(){let t=jQuery("body");jQuery(".mobile_menu_btn").on("click",function(e){e.preventDefault(),t.toggleClass("mobile-menu-opened")}),jQuery(".mobile_menu_bg").on("click",function(){t.removeClass("mobile-menu-opened")})}),jQuery(function(){jQuery.fn.select2.amd.define("select2/data/dependsOnSelectAdapter",["select2/data/array","select2/utils"],function(e,t){function r(e,t){r.__super__.constructor.call(this,e,t)}return t.Extend(r,e),r.prototype.current=function(e){let t=this.$element,r=t.find(`option[value="${t.val()}"]`),o=[];0<r.length&&o.push({id:r.val(),text:r.text()}),e(o)},r.prototype.query=function(e,t){let r=this.$element,o=jQuery(r.data("select2-depends-on")),a=[];if(r.find("option[data-depend-value]").each(function(){let e=jQuery(this),t=e.data("depend-value");t===o.val()&&a.push({id:e.val(),text:e.text()})}),e?.term){let r=e.term.toLowerCase().replaceAll(/[^а-яёa-z0-9]/gimu,"");a=a.filter(({text:e})=>{let t=e.toLowerCase().replaceAll(/[^а-яёa-z0-9]/gimu,"");return t.includes(r)})}t({results:a})},r})}),window.Layout={initSelect2(){jQuery(".select2_wrapper select:not([data-select2-id]):not([data-select2-skip-auto-init])").each(function(){let t=jQuery(this),r={minimumResultsForSearch:1,placeholder:t.data("placeholder"),dropdownParent:t.closest(".select2_wrapper"),width:"100%"};if(t.is("[data-select2-without-search]")&&(r.minimumResultsForSearch=1/0),t.is("[data-select2-depends-on]")){let e=jQuery(t.data("select2-depends-on"));r.dataAdapter=jQuery.fn.select2.amd.require("select2/data/dependsOnSelectAdapter"),e.on("change",function(){t.val("").trigger("change")})}t.select2(r).on("select2:opening",function(e){t.data("select2").$dropdown.find(":input.select2-search__field").attr("placeholder","Поиск...")})})},fileUpload(a,n="/clubs/add-image",i=null){return new Promise((t,r)=>{let o=new XMLHttpRequest,e=new FormData;e.append("file",a,a.name),e.append("_token",$('[name="_token"]').val()),"function"==typeof i&&i(0,a.size),o.upload.onprogress=function(e){"function"==typeof i&&i(e.loaded,e.total)},o.onload=o.onerror=function(){try{var e=JSON.parse(o.responseText);if(e.error)return r(e.error);if(e?.errors?.file)return r(e?.errors?.file);if(400<=o.status)return r("Произошла непредвиденная ошибка");t(e.data)}catch(e){return r("Произошла непредвиденная ошибка")}},o.open("POST",n,!0),o.send(e)})}},jQuery(function(){let t=jQuery("#add-offer-form"),e=jQuery("#add-photo-offer-input"),r=jQuery("#offer_photos_input"),o=jQuery(".offer_img_wrapper"),a=jQuery(".add-offer-photo-text");function n(e){o.toggle(!!e).find("img").attr("src",e),r.val(e)}t.on("submit",function(e){e.preventDefault(),jQuery.ajax({type:"POST",url:t.attr("action"),data:t.serialize(),success:function(){t.text("Объявление успешно отправлено. Ожидайте обратной связи.")}})}),e.on("change",function(e){if(0===this.files.length)return a.text("Загрузить"),void n("");var t=this.files[0];Layout.fileUpload(t).then(e=>{a.text("Фото загружено"),o.append('<button type="button" data-role-remove-price-list-event></button>'),n(e)})}),o.on("click","[data-role-remove-price-list-event]",function(e){a.text("Загрузить"),n("")})}),jQuery(function(){const p="1"===jQuery('meta[name="is-admin"]').attr("content");let m=jQuery("#add-club-form"),n=jQuery("#select-сity"),e=m.find(".save_draft"),r=jQuery("#club_photos_input"),f=jQuery("#select-subway"),y=jQuery("#main_preview_photo_input"),h=jQuery("#add-photo-input"),o=jQuery("#add-price-file-input"),a=jQuery("#add-price-file-hidden-input"),i=jQuery("#add-price-file-text"),_=jQuery("#add_photo_preview"),g=jQuery("#add_photo_list"),l=m.attr("draft-action"),u;if(0!==m.length){let t=m.formWizard({inputWrapperSelector:".form-group",inputErrorSelector:".error",submitButtonSelector:'[type="submit"]',prevButtonSelector:'[data-role="prev-tab-button"]',prevButtonText:"Назад",nextButtonSelector:'[data-role="next-tab-button"]',nextButtonText:"Продолжить",tabSelector:".form_tab"});function b(e,t,r){t="price_list"===t?m.attr("list-action"):m.attr("image-action");return Layout.fileUpload(e,t,r)}function c(e,t,r){jQuery(t).each(function(){let e=jQuery(this);e.toggleClass("block_active",r),e.toggleClass("block_disabled",!r),e.find('input:not([type="radio"]):not([type="checkbox"]), select, textarea').each(function(){let e=jQuery(this);e.prop("disabled",e.is(".block_disabled *"))})})}p&&(m.find("input[required], select[required], textarea[required]").prop("required",!1).attr("required",null),m.find(".form_tab").append('<button type="submit" class="save_for_admin">Сохранить</button>')),m.on("keydown","input",function(e){"Enter"===e.key&&(e.preventDefault(),t.goToNextTab())}),m.on("show-tab",function(e,t){jQuery(".person_add_club_modal_wrapper .remodal-wrapper").stop().animate({scrollTop:0},300),m.hasClass("edit_club_form")||jQuery.ajax({type:"POST",url:l,data:m.serialize(),success(e){e.club_id&&(u=e.club_id),l=`/personal/club/${u}/update-draft`}})}),e.on("click",function(e){jQuery.ajax({type:"POST",url:m.attr("draft-action"),data:m.serialize(),success:function(){location.href="/personal/clubs?status=success"}})}),m.on("submit",function(e){e.preventDefault(),m.find('button[type="submit"]').addClass("disabled"),jQuery.ajax({type:"POST",url:m.attr("action"),data:m.serialize(),success:function(){m.find('button[type="submit"]').removeClass("disabled"),location.href="/personal/clubs?status=success"}})}),(()=>{let e=jQuery(".form_tab_01_common_info"),t=e.find("#club-address-input"),o=jQuery("#lat"),a=jQuery("#lon");jQuery.fn.autocomplete&&t.autocomplete({lookup:function(e,t){var r=n.find("option:selected").text();jQuery.ajax({method:"GET",url:"https://geocode-maps.yandex.ru/1.x/",data:{apikey:window.YANDEX_API_KEY,format:"json",results:"5",geocode:`Россия, ${r}, ${e}`},success:function(e){e=$.map(e.response.GeoObjectCollection.featureMember,function(e){let t="",r,o="",a="";if(null!=e.GeoObject.Point.pos&&(r=e.GeoObject.Point.pos,null!=e.GeoObject.name&&(t=e.GeoObject.name,a=e.GeoObject.name,o=", "),null!=e.GeoObject.description&&(t+=o+e.GeoObject.description),t))return{value:t,data:r,address:a}});t({suggestions:e})}})},onSelect:function(e){var t=e.data.split(" ");$("#add-club-form #lat").val(t[1]).trigger("change"),$("#add-club-form #lon").val(t[0]).trigger("change"),$("#add-club-form #club_address").val(e.address).trigger("change"),$("#add-club-form #club_full_address").val(e.value).trigger("change"),jQuery(".error.address_error").text("")}}),t.on("input",function(){o.val(""),a.val("")}),e.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1;return jQuery(".error.address_error").text(""),""!==o.val()&&""!==a.val()||(jQuery(".error.address_error").text("Необходимо выбрать адрес из списка"),r=!0),(r?t:e)()})}),jQuery("#rating-input").on("input change",function(e){let t=jQuery(this);0!==t.length&&(t.val()<0||5<t.val())&&t.val("")})})(),(()=>{let e=jQuery(".form_tab_02_basic_services");e.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1,o=+jQuery('[name="qty_pc"]').val(),a=+jQuery('[name="qty_vip_pc"]').val();return jQuery(".error.qty_error").text(""),o<a&&(jQuery(".error.qty_error").text("Количество VIP ПК превышает общее количество ПК"),r=!0),(r?t:e)()})})})(),(()=>{let o=jQuery(".form_tab_07_contact_information");o.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1;return p?e():(o.find(".form-group .error").text(""),o.find('input[data-type="url"]').each(function(){let e=jQuery(this),t=e.val();t&&!/^(https?:\/\/)?([-_a-z0-9а-яё]+\.)+[-_a-z0-9а-яё]/gimu.test(t)&&(e.closest(".form-group").find(".error").text("Необходимо ввести валидный url"),r=!0)}),(r?t:e)())})})})(),o.on("change",function(e){return 0===this.files.length?(a.val(""),i.text("Загрузить файл"),void jQuery("button[data-role-remove-price-list-event]").remove()):void b(this.files[0],"price_list").then(e=>{a.val(e),i.text("Файл загружен"),jQuery(".add_file_wrapper").append('<button type="button" data-role-remove-price-list-event></button>')})}),jQuery(".add_file_wrapper").on("click","[data-role-remove-price-list-event]",function(e){o.val(""),o.trigger("change")}),(()=>{let e=jQuery(".form_tab_06_price");e.on("open",function(){""!==a.val()&&(i.text("Файл загружен"),jQuery(".add_file_wrapper").append('<button type="button" data-role-remove-price-list-event></button>'))})})(),(()=>{let o=jQuery(".form_tab_08_club_formalization"),n=o.find(".add_photo_error"),i=o.find(".upload-progress"),l=r.val().split(",").filter(e=>!!e),u=y.val(),c=!1;function s(){n.text(""),r.val(l.join(",")),y.val(u||"").trigger("change"),u?_.html(`<img src="${u}"/>`):_.empty(),g.empty(),l.forEach(e=>{g.append(`
<div class="add_photo_item">
    <img src="${e}"/>
    <a href="#" class="remove_photo"></a>
</div>
`)})}function d(e){u=e}h.on("change",function(){let t=[],a=new Map;if(n.text(""),i.css({width:0}),c=!0,o.addClass("uploading"),10<l.length+this.files.length)n.text("Возможно загрузить только 10 изображений");else{for(var r of this.files){if(!1===["image/jpeg","image/png"].includes(r.type))return void n.text(`Файл "${r.name}" имеет недопустимый формат`);if(5242880<r.size)return void n.text(`Файл "${r.name}" превышает допустимый размер`)}for(let r of this.files)t.push(b(r,"image",(e,t)=>a.set(r,{uploaded:e,total:t})));setTimeout(()=>h.attr("type","hidden"),0),setTimeout(()=>h.attr("type","file"),50);let e=setInterval(()=>{var e=100*function(){let e=0,t=0;for(var{uploaded:r,total:o}of a.values())e+=r,t+=o;return e/t}();i.css({width:`${e}%`})},50);Promise.all(t).then(e=>{for(var t of e)!function(e){l.push(e),u||d(e);s()}(t)}).catch(e=>{n.text(e)}).finally(()=>{c=!1,o.removeClass("uploading"),clearInterval(e)})}}),m.on("click",".add_photo_item .remove_photo",function(e){e.preventDefault();let t=jQuery(this),r=t.closest(".add_photo_item"),o=r.find("img"),a=o.attr("src");!function(e){l.splice(l.indexOf(e),1),e===u&&d(0<l.length?l[0]:null);s()}(a)}),m.on("click",".add_photo_item img",function(e){e.preventDefault();let t=jQuery(this),r=t.attr("src");d(r),s()}),s(),o.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1;return n.text(""),c?(n.text("Необходимо дождаться загрузки фотографий"),t()):p?e():(u||(n.text("Необходимо загрузить хотя бы одну фотографию"),r=!0),(r?t:e)())})})})(),(()=>{let e=jQuery(".form_tab_04_schedule"),o=jQuery("input[data-week-schedule]"),a=jQuery("input[data-day-schedule]");e.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1;return p?e():(jQuery(".work_time_wrapper_error").text(""),0===a.filter(":checked").length&&o.is(":checked")&&(jQuery(".work_time_wrapper_error").text("Необходимо заполнить хотя бы один день"),r=!0),(r?t:e)())})})})(),(()=>{let e=jQuery(".form_tab_06_price"),t=jQuery("input[data-payment-method]");e.on("change","input",function(e){0===t.filter(":checked").length?(jQuery(".next_btn, .prev_btn").prop("disabled",!0),jQuery(".payment_method_wrapper .error").text("Необходимо выбрать хотя бы один способ оплаты")):(jQuery(".next_btn, .prev_btn").prop("disabled",!1),jQuery(".payment_method_wrapper .error").text(""))})})(),jQuery('input[type="checkbox"][data-toggle-block]').on("change init",function(e){let t=jQuery(this),r=t.data("toggle-block"),o=this.checked;c(t,r,o)}).trigger("init"),jQuery('input[type="radio"][data-activate-block]').on("change init",function(e){let t=jQuery(this),r=t.data("activate-block");c(t,r,!0)}).filter(":checked").trigger("init"),jQuery('input[type="radio"][data-disable-block]').on("change init",function(e){let t=jQuery(this),r=t.data("disable-block");c(t,r,!1)}).filter(":checked").trigger("init"),(()=>{let e=jQuery(".form_tab_05_configuration"),t=jQuery('[data-role="pc-configuration"]'),o=t.find('[data-role="pc-configuration-nav"]'),a=t.find('[data-role="pc-configuration-tabs"]'),r=jQuery("#configuration-tab-template"),n=t.find('[data-role="pc-configuration-create-tab"]'),i=r.html(),l=a.find('[data-role="pc-configuration-tab"]').length,u=l-1,c=u,s=jQuery("[data-common-area-qty-pc]"),d=jQuery("[data-vip-area-qty-pc]");if(0!==t.length){e.on("open",function(){p()}),e.on("change","[data-new-area-qty-pc]",function(e){p()});let r=[112,48,96,113,49,97,114,50,98,115,51,99,116,52,100,117,53,101,118,54,102,119,55,103,120,56,104,121,57,105,122,123,8,9,46,13];function p(){let e=jQuery('[name="qty_pc"]').val(),t=jQuery('[name="qty_vip_pc"]').val(),r=jQuery("[data-new-area-qty-pc]"),o=e-t;r.each(function(){o-=this.value,o<1?(jQuery(this).closest(jQuery('[data-role="pc-configuration-tab"]')).find(jQuery(".main-error")).addClass("active").text("Проверьте правильность введенных данных, вы превысили общее количество ПК"),o=+o+ +this.value,this.value=""):jQuery(this).closest(jQuery('[data-role="pc-configuration-tab"]')).find(jQuery(".main-error")).removeClass("active").text("Заполните всю информацию об оборудовании в дополнительной зоне или удалите ее")}),s.val(`${o} ПК`),d.val(`${t} ПК`)}function f(e){a.find("[data-tab]").removeClass("active").filter(`[data-tab="${e}"]`).addClass("active"),o.find("[data-show-tab]").removeClass("active").filter(`[data-show-tab="${e}"]`).addClass("active"),c=e}e.on("keydown","[data-new-area-qty-pc]",function(e){var t=e.keyCode||e.which;-1===r.indexOf(t)&&e.preventDefault()}),n.on("click",function(e){var t;e.preventDefault(),t=u+1,e=function(e){return i.replace(/\{n\}/g,`${e}`)}(t),a.append(e),o.append(`
                <li data-nav-tab="${t}">
                    <a href="#" data-show-tab="${t}"></a>
                    <button type="button" data-remove-tab="${t}"></button>
                </li>
            `),Layout.initSelect2(),f(t),u=t,++l,n.prop("disabled",5<=l)}),t.on("click","[data-show-tab]",function(e){e.preventDefault();let t=jQuery(this),r=t.data("show-tab");f(r)}),t.on("click","[data-remove-tab]",function(e){e.preventDefault();let t=jQuery(this),r=t.data("remove-tab");!function(e){o.find(`[data-nav-tab="${e}"]`).remove(),a.find(`[data-tab="${e}"]`).remove(),c===e&&f(0);--l,n.prop("disabled",5<=l)}(r)}),m.on("error-tab",function(){if(t.is(":visible")){let e=t.find(".tab .form-group.has-error").eq(0).closest(".tab");f(e.data("tab"))}})}})(),(()=>{let t=jQuery('[data-role="marketing-event-add-tab"]'),r=jQuery(".marketing_event .marketing_event_list"),o=r.find(".form-group").length;t.on("click",function(e){r.append(`
             <div class="form-group" >
                <label for="marketing-event-input_${o}">Акция №</label>
                <div class="input_wrapper" >
                    <input id="marketing-event-input_${o}" name="marketing_event_descr[${o}]" type="text" placeholder="Описание акции" required>
                    <div class="error"></div>
                </div>
                <button type="button" data-role-remove-marketing-event></button>
            </div>
            `),++o,t.prop("disabled",5<=o)}),r.on("click","[data-role-remove-marketing-event]",function(e){e.preventDefault(),jQuery(this).closest(".form-group").remove(),--o,t.prop("disabled",5<=o)})})(),(()=>{let d=jQuery(".form_tab_09_club_preview");d.on("open",function(){let e=jQuery("#club-name-input").val(),t=jQuery("#club-address-input").val(),r=jQuery("#min-price-input").val(),o=f.find("option:selected").text(),a=f.find("option:selected").data("line-color")||"black",n=jQuery("#qty_pc-input").val(),i=jQuery("#qty_console-input").val(),l=jQuery("#qty_vr-input").val(),u=jQuery("#qty_simulator-input").val(),c=jQuery('.marketing_event_wrapper .checkbox_wrapper input[type="checkbox"]'),s=y.val()||"/img/default-club-preview-image.svg";d.find(".sc_info .club_name span").text(e),d.find(".club_address_wrapper .club_address").text(t),d.find(".club_subway_wrapper .subway_station").text(o),d.find(".club_subway_wrapper .subway_img_wrapper")[0].style.setProperty("--subway-color",a),d.find(".club_price_wrapper .club_price span").text(r),d.find(".cf_item .cf_qty.total_pc").text(n),""===i?jQuery(".cf_qty.console").closest(".cf_item").hide():(jQuery(".cf_qty.console").closest(".cf_item").show(),d.find(".cf_item .cf_qty.console").text(i)),""===l?jQuery(".cf_qty.vr").closest(".cf_item").hide():(jQuery(".cf_qty.vr").closest(".cf_item").show(),d.find(".cf_item .cf_qty.vr").text(l)),""===u?jQuery(".cf_qty.autosim").closest(".cf_item").hide():(jQuery(".cf_qty.autosim").closest(".cf_item").show(),d.find(".cf_item .cf_qty.autosim").text(u)),d.find(".sc_img_wrapper .sc_img img").attr("src",s),0<jQuery("input[data-food-service]").filter(":checked").length?d.find(".club_services .food_services").show():d.find(".club_services .food_services").hide(),d.find(".club_services .drink__services").toggle(jQuery("input[data-alcohol-service]").prop("checked")),d.find(".club_services .hookah_services").toggle(jQuery("input[data-hookah-service]").prop("checked")),d.find(".club_services .vip_services").toggle(jQuery("input[data-vip-service]").prop("checked")),d.find(".club_promotion").toggle(c.prop("checked")),!jQuery("input[data-alcohol-service]").prop("checked")&&!jQuery("input[data-hookah-service]").prop("checked")&&!jQuery("input[data-vip-service]").prop("checked")&&0<!jQuery("input[data-food-service]").filter(":checked").length?d.find(".club_services").hide():d.find(".club_services").show(),jQuery(".club_subway_wrapper").toggle(""!==f.val())})})()}}),jQuery(function(){let r=jQuery("#add-club-start-form"),o=jQuery("#add-club-code-confirm-form"),e=o.find(".step_back"),a=jQuery("#personal_info_register"),n,t;function i(e){var t=""+e%60;return""+Math.floor(e/60)+":"+(t=1===t.length?"0"+t:t)}0!==r.length&&(jQuery("[data-btn-club-owner-reg]").on("click",function(e){jQuery(this).closest(".main_reg_wrapper").find(".form_reg_wrapper").show().find(".page_title").text("Регистрация представителя компьютерного клуба"),a.find('input[name="user_type"]').val("owner"),a.find(".form-group.owner").show().find("select").prop("disabled",!1),a.find(".form-group.player").hide().find("select").prop("disabled",!0)}),jQuery("[data-btn-club-gamer-reg]").on("click",function(e){jQuery(this).closest(".main_reg_wrapper").find(".form_reg_wrapper").show().find(".page_title").text("Регистрация ланнера"),a.find('input[name="user_type"]').val("player"),a.find(".form-group.owner").hide().find("select").prop("disabled",!0),a.find(".form-group.player").show().find("select").prop("disabled",!1),a.find(".club_list_link").hide()}),o.find('input[name="code"]').codeInput(),r.on("submit",function(e){e.preventDefault(),t=r.find('input[name="phone"]').val(),jQuery.ajax({type:"POST",url:$(this).attr("action"),data:{phone:$("#add-club-start-input").inputmask("unmaskedvalue"),_token:$('#add-club-start-form [name="_token"]').val()},success:function(e){"false"==e.status?(r.find(".forma .form-group").addClass("error"),r.find(".forma .form-group .error").text(e.msg)):(r.find(".forma .form-group.error").removeClass("error"),r.find(".forma .form-group .error").text(""),r.hide(),o.find(".user_phone").text(t),o.show(),clearInterval(n),function(){clearInterval(n);let e=jQuery("#countdown"),t=jQuery("#reSendCode"),r=180;e.text(i(r)),t.addClass("disabled"),n=setInterval(function(){r--,e.text(i(r)),0===r&&(t.removeClass("disabled"),e.text(" "),clearInterval(n))},1e3)}())},error:function(e){r.find(".forma .form-group").addClass("error"),$.each(e.responseJSON.errors,function(e,t){r.find('.forma .form-group [name="'+e+'"]').closest(".form-group").find(".error").text(t)})}})}),o.on("submit",function(e){e.preventDefault(),jQuery(".code_wrapper .error").text("");var t="",e=$("#add-club-start-input").inputmask("unmaskedvalue");if(o.find(".code_input_wrapper input").each(function(){t+=$(this).val()}),4!=t.length)return!1;jQuery.ajax({type:"POST",url:$(this).attr("action"),data:{phone:e,confirm_code:t,_token:o.find('[name="_token"]').val()},success:function(e){e.error?jQuery(".code_wrapper .error").text(e.error):(a.find("#user-phone-input").val($("#add-club-start-input").inputmask("unmaskedvalue")),a.find('[name="phone"]').val($("#add-club-start-input").inputmask("unmaskedvalue")),a.find('[name="conf_code"]').val(t),$(".add_club_page_start_wrapper").hide(),a.show())}})}),a.find("form").on("submit",function(e){e.preventDefault(),a.find(".forma .form-group").removeClass("error"),a.find(".forma .error").remove(),jQuery.ajax({type:"POST",url:$(this).attr("action"),data:a.find("form").serialize(),success:function(e){void 0!==e.errors?jQuery(".code_wrapper .error").text(e.error):location.href="/personal/clubs?action=add_club"},error:function(e){$.each(e.responseJSON.errors,function(e,t){a.find('.forma .form-group [name="'+e+'"]').closest(".form-group").addClass("error").append('<div class="error">'+t+"</div>")})}})}),e.on("click",function(e){o.trigger("reset"),o.hide(),r.show()}),jQuery("#reSendCode").on("click",function(e){r.trigger("submit")}))}),jQuery(function(){let e=jQuery("#cities-list-form"),t=e.find('[name="city_letter"]'),r=jQuery(".cities_list_checkbox_wrapper .title"),o=[],a="",n=[],i={},l={};function u(){if(n.forEach(e=>e.style.display=""),0<o.length)for(var e in l)!1===o.includes(e)&&l[e].forEach(e=>e.style.display="none");if(0<a.length)for(var t in i)-1===t.indexOf(a)&&i[t].forEach(e=>e.style.display="none")}function c(e){return`${e}`.trim().toLowerCase()}0!==e.length&&(document.querySelectorAll(".cities_list a").forEach(function(e){let t=c(e.textContent),r=t.substr(0,1);i[t]=i[t]||[],l[r]=l[r]||[],n.push(e),i[t].push(e),l[r].push(e)}),e.on("change",'[name="city_letter"]',function(e){o=t.filter(":checked").map(function(){return this.value.toLowerCase()}).toArray(),u()}),e.on("input change",'[name="search"]',function(e){a=c(this.value),u()}),r.on("click",function(e){for(let e=0;e<t.length;e++)t[e].checked=!1;o=t.filter(":checked").map(function(){return this.value.toLowerCase()}).toArray(),u()}))}),jQuery(function(){let e=jQuery('[data-remodal-id="club_photo_modal"]'),r=jQuery(".club_photo_modal_wrapper"),o=jQuery("#show_club_photo_counter_slide");if(0!==e.length){let t=r.find(".slide_item").length;function a(e){o.text(`${e+1} / ${t}`)}a(0),e.on("opened",function(){r.slick({infinite:!0,slidesToShow:1,slidesToScroll:1,prevArrow:'<button type="button" class="slick-prev slick-arrow"><img src="/img/left.svg" alt="arrow"></button>',nextArrow:'<button type="button" class="slick-next slick-arrow"><img src="/img/right.svg" alt="arrow"></button>'}),r.on("beforeChange",function(e,t,r,o){a(o)})}),e.on("closed",function(){jQuery(".club_photo_modal_wrapper").slick("unslick")})}}),jQuery(function(){let r=jQuery("#user-profile-form"),o,a=r.find('input[name="phone"]'),n=r.find(".confirm_mobile_wrapper"),i=n.find(".confirm_mobile_descr"),t,l=r.find("#oldPhone").val();function u(){r.find(".user_profile_submit").addClass("disabled"),jQuery.ajax({type:"POST",url:r.attr("action"),data:r.serialize(),success:function(e){"false"==e.status||(jQuery(".user_profile_submit").removeClass("disabled"),jQuery('[data-remodal-id="success_modal"]').remodal().open())},error:function(e){jQuery(".user_profile_submit").removeClass("disabled"),$.each(e.responseJSON.errors,function(e,t){r.find('.form-group [name="'+e+'"]').closest(".form-group").addClass("error").append('<div class="error">'+t+"</div>")})}})}function c(e){var t=""+e%60;return""+Math.floor(e/60)+":"+(t=1===t.length?"0"+t:t)}0!==r.length&&(r.find('input[name="code"]').codeInput(),r.on("submit",function(e){e.preventDefault(),r.find(".forma .form-group").removeClass("error"),r.find(".forma .error").remove(),t=a.val(),a.inputmask("unmaskedvalue")!==l?(r.find(".code_input_wrapper input").val(""),jQuery.ajax({type:"POST",url:$(this).attr("phone-action"),data:{phone:a.inputmask("unmaskedvalue"),_token:r.find('[name="_token"]').val()},success:function(e){"false"==e.status?jQuery("#user-profile-form").find("#user-phone-input").closest(".form-group").addClass("error").append('<div class="error">'+e.msg+"</div>"):(jQuery(".user_profile_submit").addClass("disabled"),a.hide(),i.text(`Код отправлен на номер ${t}`).removeClass("error"),n.show(),clearInterval(o),function(){let e=jQuery("#countdown"),t=jQuery("#reSendCodeProfile"),r=180;e.text(c(r)),t.addClass("disabled"),o=setInterval(function(){r--,e.text(c(r)),0===r&&(t.removeClass("disabled"),e.text(" "),clearInterval(o))},1e3)}())}})):u()}),jQuery("#reSendCodeProfile").on("click",function(e){r.trigger("submit")}),r.on("change",'input[name="code"]',function(e){let t=jQuery(this);jQuery.ajax({type:"POST",url:r.attr("verify-action"),data:{confirm_code:t.val(),phone:a.inputmask("unmaskedvalue"),_token:r.find('[name="_token"]').val()},success:function(e){void 0!==e.error?i.text(e.error).addClass("error"):(l=a.inputmask("unmaskedvalue"),u(),a.show(),n.hide(),clearInterval(o),jQuery(".user_profile_submit").removeClass("disabled"))}})}))}),jQuery(function(){let o=document.getElementById("sc_by_map"),f=window.clubGeoList||[],m={},a=null,n=400;window.matchMedia("(max-width: 760px)").matches&&(n=100),o&&window.ymaps&&ymaps.ready(()=>{let u=jQuery("[data-search-club-by-map]"),c=document.querySelector("[data-search-club-by-map]"),s=new ymaps.Map(o,{center:r([window.CITY_LAT,window.CITY_LON],11),zoom:11,behaviors:["drag","dblClickZoom"],controls:[]}),d=new ymaps.Clusterer({clusterIcons:[{href:"/img/icon-red-border.svg",size:[40,40],offset:[-20,-20],color:"red"},{href:"/img/icon-red-border.svg",size:[60,60],offset:[-30,-30],textColor:"red"}],groupByCoordinates:!1,clusterDisableClickZoom:!1,clusterHideIconOnBalloonOpen:!1,geoObjectHideIconOnBalloonOpen:!1,hasBalloon:!1,minClusterSize:4,textColor:"red"});var e=new ymaps.control.ZoomControl({options:{position:{left:"auto",right:10,top:n}}});function p(e,t){t=t||s.getZoom(),a!==e&&m[e]&&(m[a]&&(m[a].options.set("iconImageHref","/img/ballon.svg"),m[a].options.set("zIndex",1)),m[e].options.set("iconImageHref","/img/active_ballon.svg"),m[e].options.set("zIndex",2),s.setCenter(r(m[e].geometry.getCoordinates(),t),t,{duration:800,timingFunction:"ease"}),a=e)}function r(e,t){let[r,o]=e;return 12<t?e:(window.matchMedia("(max-width: 760px)").matches?r-=.2/t:window.matchMedia("(max-width: 1500px)").matches?r-=.4/t:o-=1.2/t,[r,o])}function t(){var e,t,r,o=s.getBounds(),a=o[0][0],n=o[1][0],i=o[0][1],l=o[1][1];for({id:e,lon:t,lat:r}of f)r>=a&&r<=n&&t>=i&&t<=l?(m[e]=m[e]||function(t,e,r){let o=new ymaps.Placemark([r,e],{},{iconLayout:"default#image",iconImageHref:"/img/ballon.svg",iconImageSize:[42,60],iconImageOffset:[-14,-40],zIndex:1});return o.events.add("click",function(){let e=jQuery(`.sc_list [data-id='${t}']`);jQuery(".active[data-role-club]").removeClass("active"),jQuery(".sc_list .sc_item.another_city").hide(),e.hasClass("another_city")&&e.show(),p(t),function(e,t,r){let o=getComputedStyle(e),a=getComputedStyle(r[0]),n=t.offset().top,i=r.offset().top,l=t[0].scrollTop,u=parseFloat(o.height?o.height.replace("px",""):"0"),c=parseFloat(a.height?a.height.replace("px",""):"0"),s=t.offset().left,d=r.offset().left,p=t[0].scrollLeft,f=parseFloat(o.paddingTop?o.paddingTop.replace("px",""):"0");t[0].scrollTop=i-n+l-u/2+c/2,t[0].scrollLeft=d-s+p-f}(c,u,e),e.addClass("active")}),d.add(o),o}(e,t,r),m[e].options.set("visible",!0)):m[e]&&m[e].options.set("visible",!1)}s.controls.add(e),s.events.add("boundschange",function(e){t()}),s.geoObjects.add(d),jQuery(document).on("mouseover","[data-search-club-by-map] [data-role-club][data-id]",function(e){let t=jQuery(this);jQuery("[data-role-club]").removeClass("active"),p(t.data("id"),Math.min(14,s.getZoom())),t.addClass("active")}),setTimeout(t,150)})}),jQuery(function(){$("#city_selector").on("select2:select",function(e){var t=$('meta[name="site"]').attr("content");window.location.href=t+"/"+e.params.data.data}),$("#city_selector").select2({ajax:{url:$('meta[name="site"]').attr("content")+"/searchCities",dataType:"json"},cache:!0}),$("#add-club-form #select-сity").select2({ajax:{url:$('meta[name="site"]').attr("content")+"/searchCities",dataType:"json",data:function(e){return{q:e.term,page:e.page,selected:$("#add-club-form #select-сity").val()}}},cache:!0}),$("#add-club-form #select-сity").on("select2:select",function(e){$("#add-club-form #select-subway").val("").change(),1==e.params.data.has_metro?$("#add-club-form #select-subway").attr("disabled",!1):$("#add-club-form #select-subway").attr("disabled",!0)}),$("#add-club-form #select-subway").select2({ajax:{url:$('meta[name="site"]').attr("content")+"/searchMetro",dataType:"json",data:function(e){return{q:e.term,page:e.page,city_id:$("#add-club-form #select-сity").val()}}},cache:!0}),$("#add-club-form #select-subway").on("select2:select",function(e){$('#add-club-form #select-subway option[value="'+e.params.data.id+'"]').attr("data-line-color","#"+e.params.data.color)})}),jQuery(function(){Layout.initSelect2(),jQuery(".club_page_services_list .club_services_mobile_toggle").on("click",function(e){jQuery(this).toggleClass("active").closest(".club_page_services_list").toggleClass("mob_toggle").find(".mob_hide").toggleClass("active")}),jQuery('input[type="tel"]').inputmask({mask:"+7 (999) 999-99-99",removeMaskOnSubmit:!0,onincomplete:function(){this.value=""},oncomplete:function(){"log-in-phone-input"==$(this).attr("id")&&$("#log-in-password-input").focus()}}),jQuery('input[type="number"]').on("input change",function(e){var t=+jQuery(this).val();(t<=0||isNaN(t))&&jQuery(this).val("")}),jQuery("ul.club_list_navigation_tabs li a").on("click",function(e){e.preventDefault();let t=jQuery(this),r=jQuery(t.attr("href"));t.is(".active")||(jQuery("ul.club_list_navigation_tabs li a.active").removeClass("active"),t.addClass("active"),r.show(),jQuery(".club_list_content_tabs .tab").not(r).hide())}),jQuery(".club_page_toggle_content").on("click",function(e){jQuery(this).closest(".toggle_block_wrapper").find(".toggle_block").toggle(),jQuery(this).toggleClass("active")}),jQuery(".review_content_wrapper").scrollbar(),jQuery(".person_add_club_modal").remodal({appendTo:jQuery(".person_add_club_modal_wrapper"),hashTracking:!1,closeOnOutsideClick:!1}),jQuery(".tariffs_modal").remodal({appendTo:jQuery(".tariffs_modal_wrapper"),hashTracking:!1}),jQuery(".club_page_reviews_list").slick({infinite:!1,slidesToShow:4,slidesToScroll:1,variableWidth:!0,prevArrow:'<button type="button" class="slick-prev slick-arrow"><img src="../../img/left1.svg" alt="arrow"></button>',nextArrow:'<button type="button" class="slick-next slick-arrow"><img src="../../img/right1.svg" alt="arrow"></button>',responsive:[{breakpoint:700,settings:{slidesToShow:1,slidesToScroll:1}}]}),jQuery(".our_team_list").slick({infinite:!0,slidesToShow:5,slidesToScroll:1,variableWidth:!0,prevArrow:'<button type="button" class="slick-prev slick-arrow"><img src="../../img/left1.svg" alt="arrow"></button>',nextArrow:'<button type="button" class="slick-next slick-arrow"><img src="../../img/right1.svg" alt="arrow"></button>',responsive:[{breakpoint:700,settings:{slidesToShow:1,slidesToScroll:1}}]});let r=0,o=jQuery(".club_page_photo_list .club_page_photo_item").length;jQuery(".club_page_photo_list").on("scroll",function(e){var t=this.scrollLeft>=r?"right":"left";r=this.scrollLeft;t=function(e,t,r){let o=[];jQuery(e).find(t).each(function(e,t){o.push({index:e,x:t.getBoundingClientRect().x})});t=o.filter(({x:e})=>"right"===r?0<=e:e<=0).sort((e,t)=>Math.abs(e.x)-Math.abs(t.x));return t?.[0]?.index||0}(this,".club_page_photo_item",t);jQuery(this).closest(".club_page_photo_wrapper").find(".counter").text(`${t+1} / ${o}`)}),jQuery(window).on("resize",function(e){jQuery(".club_page_photo_list").trigger("scroll")}),jQuery(".club_page_photo_list").trigger("scroll"),jQuery(".log_in_form_toggle").on("click",function(e){e.preventDefault(),jQuery(".header_menu .log_in_block_wrapper").toggle(),jQuery(this).toggleClass("active")}),jQuery(document).on("click",function(e){jQuery(".header_menu .log_in_block_wrapper").is(":visible")&&0===jQuery(e.target).closest(".log_in_block_wrapper").length&&!jQuery(e.target).is(".log_in_form_toggle")&&(jQuery(".header_menu .log_in_block_wrapper").hide(),jQuery(".log_in_form_toggle").removeClass("active"))}),jQuery("#open_search_form").on("click",function(e){ym(82365286,"reachGoal","search"),gtag("event","send",{event_category:"search",event_action:"click"}),jQuery(".search .search_form").addClass("active"),jQuery(".search .search_form #search-text").focus()}),jQuery("#close_search_form").on("click",function(e){jQuery(".search .search_form").removeClass("active")}),jQuery(".langame_software_options .option").on("click",function(e){jQuery(this).closest(".option_item").toggleClass("active")}),jQuery(window).on("scroll resize",function(){jQuery("[data-track-sticky]").each(function(){let e=jQuery(this),t=this.getBoundingClientRect().y;e.toggleClass("sticky",0===t).toggleClass("not-sticky",0!==t)})}),jQuery('a[href^="#block-"]').on("click",function(e){e.preventDefault();e=jQuery(this).attr("href");jQuery("html, body").animate({scrollTop:jQuery(e).offset().top+"px"})}),jQuery("#gamer-mailing-form,#owner-mailing-form").on("submit",function(e){e.preventDefault();let t=jQuery(this);jQuery.ajax({type:"POST",url:t.attr("action"),data:t.serialize(),success:function(){jQuery('[data-remodal-id="mailing_success_modal"]').remodal().open()}})}),jQuery(".remodal.mailing_modal").on("opening",function(e){jQuery(this).find('form input[name="email"]').val("")}),jQuery(".offer_content_wrapper").on("click",".show_offer_contacts",function(e){jQuery(this).closest(jQuery(".offer_content_wrapper")).find(".contacts_wrapper").show(),jQuery(this).hide()}),jQuery(".offer_instr_toggle_mobile").on("click",function(e){jQuery(this).toggleClass("active"),jQuery(this).closest(".attention_text_wrapper").find(".instr").toggle()}),jQuery("[data-open-select-city]").on("click",function(e){$("#city_selector").select2("open"),e.preventDefault();e=jQuery(this).attr("href");jQuery("html, body").animate({scrollTop:jQuery(e).offset().top+"px"})}),jQuery("[data-recaptcha-form]").on("submit",function(e){let t=jQuery(this),r=window.grecaptcha.getResponse();r||(e.preventDefault(),window.recaptchaForm=this,t.find(".recaptcha-holder").addClass("active"),t.find('[type="submit"]').hide())}),jQuery("#report-club-form").on("submit",function(e){e.preventDefault(),jQuery.ajax({type:"POST",url:jQuery(this).attr("action"),data:jQuery(this).serialize(),success:function(){jQuery('[data-remodal-id="success_modal"]').remodal().open()}})})});
//# sourceMappingURL=layout.js.map
