(()=>{const a=[112,48,96,113,49,97,114,50,98,115,51,99,116,52,100,117,53,101,118,54,102,119,55,103,120,56,104,121,57,105,122,123,8,9,46,13];jQuery.fn.extend({codeInput(e={}){let t=e.inputCount||4,r=e.inputWrapperClass||"code_input_wrapper";jQuery(this).each(function(){let o=jQuery(this),n=jQuery(`<div class="${r}"></div>`);for(let e=0;e<t;++e){let e=jQuery('<input type="text" maxlength="1">');e.on("keydown",function(e){var t=e.keyCode||e.which;-1===a.indexOf(t)&&e.preventDefault()}),e.on("keyup input",function(e){let t=jQuery(this),r=e.keyCode||e.which,a="";n.find("input").each(function(){a+=jQuery(this).val()}),o.val(a),8!==r&&46!==r?("input"===e.type&&o.trigger("input"),1===t.val().length&&(0<t.next("input").length?t.next("input").trigger("focus"):"input"===e.type&&setTimeout(()=>{o.trigger("change")},50))):t.val("").prev("input").trigger("focus")}),n.append(e)}o.hide(),o.after(n)})}}),jQuery(function(){jQuery("[data-input-code]").codeInput()})})(),jQuery.fn.extend({formWizard(e={}){let n=this,o=e.inputWrapperSelector||".form-group",i=e.inputErrorSelector||".error",t=e.submitButtonSelector||'[type="submit"]',r=e.prevButtonSelector||'[data-role="prev-tab-button"]',l=e.prevButtonText||"Назад",a=e.nextButtonSelector||'[data-role="next-tab-button"]',u=e.nextButtonText||"Вперед",s=e.tabSelector||'[data-role="tabs"]',c=e.activeTab||0,d=n.find(t),p=n.find(r),f=n.find(a),m=n.find(s);return m.length<=1?null:(_(c),f.on("click",h),p.on("click",y),this.on("input change","input, textarea, select",function(){g(this,"")}),{showTab:_,goToNextTab:h,goToPrevTab:y,validateActiveTab:b});function _(e){let t=c!==e?m.eq(c):jQuery(),r=m.eq(e),a=r.data("prev-button-text")||l,o=r.data("next-button-text")||u;t.trigger("close"),r.trigger("open"),m.hide(),r.show(),d.toggle(e===m.length-1),p.toggle(0<e).text(a),f.toggle(e<m.length-1).text(o),c=e,n.trigger("show-tab",[c])}function h(){c>=m.length-1||b().then(function(){_(c+1)}).catch(function(){n.trigger("error-tab")})}function y(){0!==c&&_(c-1)}function b(){let e=m.eq(c),t=function(){let a=m.eq(c);return new Promise((e,t)=>{let r=!1;return a.find("input, select, textarea").each(function(){g(this,"")}),a.find('input[required][type="text"]:not(:disabled),input[required][type="password"]:not(:disabled),input[required][type="email"]:not(:disabled),input[required][type="tel"]:not(:disabled),input[required][type="url"]:not(:disabled),input[required][type="number"]:not(:disabled),select[required]:not(:disabled),textarea[required]:not(:disabled)').each(function(){let e=jQuery(this),t=e.val();t||(r=!0,g(this,"Необходимо заполнить данное поле"))}),a.find('input[type="email"]:not(:disabled)').each(function(){let e=jQuery(this),t=e.val();t&&!1===/^.+@.+\..+$/.test(t)&&(r=!0,g(this,"Необходимо ввести валидный e-mail"))}),(r?t:e)()})}(),r="function"!=typeof e.data("form-wizard-tab-validation")||e.data("form-wizard-tab-validation")();return Promise.all([t,r])}function g(e,t){let r=jQuery(e).closest(o),a=r.find(i);r.toggleClass("has-error",!!t),a.text(t||"")}}}),$(document).on("change",'.hide-from-search-form input[type="checkbox"]',function(){jQuery.ajax({type:"get",url:$(this).closest("form").attr("action"),success:function(){},error:function(){}})}),jQuery(function(){let t=jQuery("body");jQuery(".mobile_menu_btn").on("click",function(e){e.preventDefault(),t.toggleClass("mobile-menu-opened")}),jQuery(".mobile_menu_bg").on("click",function(){t.removeClass("mobile-menu-opened")})}),jQuery(function(){jQuery.fn.select2.amd.define("select2/data/dependsOnSelectAdapter",["select2/data/array","select2/utils"],function(e,t){function r(e,t){r.__super__.constructor.call(this,e,t)}return t.Extend(r,e),r.prototype.current=function(e){let t=this.$element,r=t.find(`option[value="${t.val()}"]`),a=[];0<r.length&&a.push({id:r.val(),text:r.text()}),e(a)},r.prototype.query=function(e,t){let r=this.$element,a=jQuery(r.data("select2-depends-on")),o=[];if(r.find("option[data-depend-value]").each(function(){let e=jQuery(this),t=e.data("depend-value");t===a.val()&&o.push({id:e.val(),text:e.text()})}),e?.term){let r=e.term.toLowerCase().replaceAll(/[^а-яёa-z0-9]/gimu,"");o=o.filter(({text:e})=>{let t=e.toLowerCase().replaceAll(/[^а-яёa-z0-9]/gimu,"");return t.includes(r)})}t({results:o})},r})}),window.Layout={initSelect2(){jQuery(".select2_wrapper select:not([data-select2-id]):not([data-select2-skip-auto-init])").each(function(){let t=jQuery(this),r={minimumResultsForSearch:1,placeholder:t.data("placeholder"),dropdownParent:t.closest(".select2_wrapper"),width:"100%"};if(t.is("[data-select2-without-search]")&&(r.minimumResultsForSearch=1/0),t.is("[data-select2-depends-on]")){let e=jQuery(t.data("select2-depends-on"));r.dataAdapter=jQuery.fn.select2.amd.require("select2/data/dependsOnSelectAdapter"),e.on("change",function(){t.val("").trigger("change")})}t.select2(r).on("select2:opening",function(e){t.data("select2").$dropdown.find(":input.select2-search__field").attr("placeholder","Поиск...")})})}},jQuery(function(){const s="1"===jQuery('meta[name="is-admin"]').attr("content");let c=jQuery("#add-club-form"),n=jQuery("#select-сity"),e=c.find(".save_draft"),r=jQuery("#club_photos_input"),p=jQuery("#select-subway"),f=jQuery("#main_preview_photo_input"),o=jQuery("#add-photo-input"),a=jQuery("#add-price-file-input"),i=jQuery("#add-price-file-hidden-input"),l=jQuery("#add-price-file-text"),d=jQuery("#add_photo_preview"),m=jQuery("#add_photo_list");if(0!==c.length){let t=c.formWizard({inputWrapperSelector:".form-group",inputErrorSelector:".error",submitButtonSelector:'[type="submit"]',prevButtonSelector:'[data-role="prev-tab-button"]',prevButtonText:"Назад",nextButtonSelector:'[data-role="next-tab-button"]',nextButtonText:"Продолжить",tabSelector:".form_tab"});function _(o,n){return new Promise((r,a)=>{let e=new FormData;var t;t="price_list"==n?c.attr("list-action"):c.attr("image-action"),e.append("file",o,o.name),e.append("_token",$('[name="_token"]').val()),jQuery.ajax({url:t,method:"post",data:e,processData:!1,contentType:!1,success:function({data:e,error:t}){if(t)return a(t);r(e)}})})}function u(e,t,r){jQuery(t).each(function(){let e=jQuery(this);e.toggleClass("block_active",r),e.toggleClass("block_disabled",!r),e.find('input:not([type="radio"]):not([type="checkbox"]), select, textarea').each(function(){let e=jQuery(this);e.prop("disabled",e.is(".block_disabled *"))})})}s&&(c.find("input[required], select[required], textarea[required]").prop("required",!1).attr("required",null),c.find(".form_tab").append('<button type="submit" class="save_for_admin">Сохранить</button>')),c.on("keydown","input",function(e){"Enter"===e.key&&(e.preventDefault(),t.goToNextTab())}),c.on("show-tab",function(e,t){jQuery(".person_add_club_modal_wrapper .remodal-wrapper").stop().animate({scrollTop:0},300)}),e.on("click",function(e){jQuery.ajax({type:"POST",url:c.attr("draft-action"),data:c.serialize(),success:function(){location.href="/personal/clubs?status=success"}})}),c.on("submit",function(e){e.preventDefault(),jQuery.ajax({type:"POST",url:c.attr("action"),data:c.serialize(),success:function(){location.href="/personal/clubs?status=success"}})}),(()=>{let e=jQuery(".form_tab_01_common_info"),t=e.find("#club-address-input"),a=jQuery("#lat"),o=jQuery("#lon");jQuery.fn.autocomplete&&t.autocomplete({lookup:function(e,t){var r=n.find("option:selected").text();jQuery.ajax({method:"GET",url:"https://geocode-maps.yandex.ru/1.x/",data:{apikey:window.YANDEX_API_KEY,format:"json",results:"5",geocode:`Россия, ${r}, ${e}`},success:function(e){e=$.map(e.response.GeoObjectCollection.featureMember,function(e){let t="",r,a="",o="";if(null!=e.GeoObject.Point.pos&&(r=e.GeoObject.Point.pos,null!=e.GeoObject.name&&(t=e.GeoObject.name,o=e.GeoObject.name,a=", "),null!=e.GeoObject.description&&(t+=a+e.GeoObject.description),t))return{value:t,data:r,address:o}});t({suggestions:e})}})},onSelect:function(e){var t=e.data.split(" ");$("#add-club-form #lat").val(t[1]),$("#add-club-form #lon").val(t[0]),$("#add-club-form #club_address").val(e.address),$("#add-club-form #club_full_address").val(e.value),jQuery(".error.address_error").text("")}}),t.on("input",function(){a.val(""),o.val("")}),e.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1;return jQuery(".error.address_error").text(""),""!==a.val()&&""!==o.val()||(jQuery(".error.address_error").text("Необходимо выбрать адрес из списка"),r=!0),(r?t:e)()})}),jQuery("#rating-input").on("input change",function(e){let t=jQuery(this);0!==t.length&&(t.val()<0||5<t.val())&&t.val("")})})(),(()=>{let a=jQuery(".form_tab_07_contact_information");a.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1;return s?e():(a.find(".form-group .error").text(""),a.find('input[data-type="url"]').each(function(){let e=jQuery(this),t=e.val();t&&!/^(https?:\/\/)?([-_a-z0-9а-яё]+\.)+[-_a-z0-9а-яё]/gimu.test(t)&&(e.closest(".form-group").find(".error").text("Необходимо ввести валидный url"),r=!0)}),(r?t:e)())})})})(),a.on("change",function(e){return 0===this.files.length?(i.val(""),l.text("Загрузить файл"),void jQuery("button[data-role-remove-price-list-event]").remove()):void _(this.files[0],"price_list").then(e=>{i.val(e),l.text("Файл загружен"),jQuery(".add_file_wrapper").append('<button type="button" data-role-remove-price-list-event></button>')})}),jQuery(".add_file_wrapper").on("click","[data-role-remove-price-list-event]",function(e){a.val(""),a.trigger("change")}),(()=>{let e=jQuery(".form_tab_06_price");e.on("open",function(){""!==i.val()&&(l.text("Файл загружен"),jQuery(".add_file_wrapper").append('<button type="button" data-role-remove-price-list-event></button>'))})})(),(()=>{let e=jQuery(".form_tab_08_club_formalization"),a=e.find(".add_photo_error"),n=r.val().split(",").filter(e=>!!e),i=f.val();function l(){a.text(""),r.val(n.join(",")),f.val(i||"").trigger("change"),i?d.html(`<img src="${i}"/>`):d.empty(),m.empty(),n.forEach(e=>{m.append(`
<div class="add_photo_item">
    <img src="${e}"/>
    <a href="#" class="remove_photo"></a>
</div>
`)})}function u(e){i=e}o.on("change",function(){let e=n.length;for(var t of this.files){if(10<=e)break;++e,_(t,"image").then(e=>{!function(e){n.push(e),i||u(e);l()}(e)})}setTimeout(()=>o.attr("type","hidden"),0),setTimeout(()=>o.attr("type","file"),50)}),c.on("click",".add_photo_item .remove_photo",function(e){e.preventDefault();let t=jQuery(this),r=t.closest(".add_photo_item"),a=r.find("img"),o=a.attr("src");!function(e){n.splice(n.indexOf(e),1),e===i&&u(0<n.length?n[0]:null);l()}(o)}),c.on("click",".add_photo_item img",function(e){e.preventDefault();let t=jQuery(this),r=t.attr("src");u(r),l()}),l(),e.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1;return s?e():(a.text(""),i||(a.text("Необходимо загрузить хотя бы одну фотографию"),r=!0),(r?t:e)())})})})(),(()=>{let e=jQuery(".form_tab_04_schedule"),a=jQuery("input[data-week-schedule]"),o=jQuery("input[data-day-schedule]");e.data("form-wizard-tab-validation",function(){return new Promise((e,t)=>{let r=!1;return s?e():(jQuery(".work_time_wrapper_error").text(""),0===o.filter(":checked").length&&a.is(":checked")&&(jQuery(".work_time_wrapper_error").text("Необходимо заполнить хотя бы один день"),r=!0),(r?t:e)())})})})(),(()=>{let e=jQuery(".form_tab_06_price"),t=jQuery("input[data-payment-method]");e.on("change","input",function(e){0===t.filter(":checked").length?(jQuery(".next_btn, .prev_btn").prop("disabled",!0),jQuery(".payment_method_wrapper .error").text("Необходимо выбрать хотя бы один способ оплаты")):(jQuery(".next_btn, .prev_btn").prop("disabled",!1),jQuery(".payment_method_wrapper .error").text(""))})})(),jQuery('input[type="checkbox"][data-toggle-block]').on("change init",function(e){let t=jQuery(this),r=t.data("toggle-block"),a=this.checked;u(t,r,a)}).trigger("init"),jQuery('input[type="radio"][data-activate-block]').on("change init",function(e){let t=jQuery(this),r=t.data("activate-block");u(t,r,!0)}).filter(":checked").trigger("init"),jQuery('input[type="radio"][data-disable-block]').on("change init",function(e){let t=jQuery(this),r=t.data("disable-block");u(t,r,!1)}).filter(":checked").trigger("init"),(()=>{let t=jQuery('[data-role="pc-configuration"]'),a=t.find('[data-role="pc-configuration-nav"]'),o=t.find('[data-role="pc-configuration-tabs"]'),e=jQuery("#configuration-tab-template"),n=t.find('[data-role="pc-configuration-create-tab"]'),r=e.html(),i=o.find('[data-role="pc-configuration-tab"]').length,l=i-1,u=l;function s(e){o.find("[data-tab]").removeClass("active").filter(`[data-tab="${e}"]`).addClass("active"),a.find("[data-show-tab]").removeClass("active").filter(`[data-show-tab="${e}"]`).addClass("active"),u=e}0!==t.length&&(n.on("click",function(e){var t;e.preventDefault(),t=l+1,e=function(e){return r.replace(/\{n\}/g,`${e}`)}(t),o.append(e),a.append(`
                <li data-nav-tab="${t}">
                    <a href="#" data-show-tab="${t}"></a>
                    <button type="button" data-remove-tab="${t}"></button>
                </li>
            `),Layout.initSelect2(),s(t),l=t,++i,n.prop("disabled",5<=i)}),t.on("click","[data-show-tab]",function(e){e.preventDefault();let t=jQuery(this),r=t.data("show-tab");s(r)}),t.on("click","[data-remove-tab]",function(e){e.preventDefault();let t=jQuery(this),r=t.data("remove-tab");!function(e){a.find(`[data-nav-tab="${e}"]`).remove(),o.find(`[data-tab="${e}"]`).remove(),u===e&&s(0);--i,n.prop("disabled",5<=i)}(r)}),c.on("error-tab",function(){if(t.is(":visible")){let e=t.find(".tab .form-group.has-error").eq(0).closest(".tab");s(e.data("tab"))}}))})(),(()=>{let t=jQuery('[data-role="marketing-event-add-tab"]'),r=jQuery(".marketing_event .marketing_event_list"),a=r.find(".form-group").length;t.on("click",function(e){++a,r.append(`
             <div class="form-group" >
                <label for="marketing-event-input[${a}]">Акция №</label>
                <div class="input_wrapper" >
                    <input id="marketing-event-input[${a}]" name="marketing_event_descr[]" type="text" placeholder="Описание акции" required>
                    <div class="error"></div>
                </div>
                <button type="button" data-role-remove-marketing-event></button>
            </div>
            `),t.prop("disabled",5<=a)}),r.on("click","[data-role-remove-marketing-event]",function(e){e.preventDefault(),jQuery(this).closest(".form-group").remove(),--a,t.prop("disabled",5<=a)})})(),(()=>{let d=jQuery(".form_tab_09_club_preview");d.on("open",function(){let e=jQuery("#club-name-input").val(),t=jQuery("#club-address-input").val(),r=jQuery("#min-price-input").val(),a=p.find("option:selected").text(),o=p.find("option:selected").data("line-color")||"black",n=jQuery("#qty_pc-input").val(),i=jQuery("#qty_console-input").val(),l=jQuery("#qty_vr-input").val(),u=jQuery("#qty_simulator-input").val(),s=jQuery('.marketing_event_wrapper .checkbox_wrapper input[type="checkbox"]'),c=f.val()||"/img/default-club-preview-image.svg";d.find(".search_club_info .club_name span").text(e),d.find(".club_address_wrapper .club_address").text(t),d.find(".club_subway_wrapper .subway_station").text(a),d.find(".club_subway_wrapper .subway_img_wrapper")[0].style.setProperty("--subway-color",o),d.find(".club_price_wrapper .club_price span").text(r),d.find(".club_features_item .club_features_qty.total_pc").text(n),""===i?jQuery(".club_features_qty.console").closest(".club_features_item").hide():(jQuery(".club_features_qty.console").closest(".club_features_item").show(),d.find(".club_features_item .club_features_qty.console").text(i)),""===l?jQuery(".club_features_qty.vr").closest(".club_features_item").hide():(jQuery(".club_features_qty.vr").closest(".club_features_item").show(),d.find(".club_features_item .club_features_qty.vr").text(l)),""===u?jQuery(".club_features_qty.autosim").closest(".club_features_item").hide():(jQuery(".club_features_qty.autosim").closest(".club_features_item").show(),d.find(".club_features_item .club_features_qty.autosim").text(u)),d.find(".search_club_img_wrapper .search_club_img img").attr("src",c),0<jQuery("input[data-food-service]").filter(":checked").length?d.find(".club_services .food_services").show():d.find(".club_services .food_services").hide(),d.find(".club_services .drink__services").toggle(jQuery("input[data-alcohol-service]").prop("checked")),d.find(".club_services .hookah_services").toggle(jQuery("input[data-hookah-service]").prop("checked")),d.find(".club_services .vip_services").toggle(jQuery("input[data-vip-service]").prop("checked")),d.find(".club_promotion").toggle(s.prop("checked")),!jQuery("input[data-alcohol-service]").prop("checked")&&!jQuery("input[data-hookah-service]").prop("checked")&&!jQuery("input[data-vip-service]").prop("checked")&&0<!jQuery("input[data-food-service]").filter(":checked").length?d.find(".club_services").hide():d.find(".club_services").show(),jQuery(".club_subway_wrapper").toggle(""!==p.val())})})()}}),jQuery(function(){let r=jQuery("#add-club-start-form"),a=jQuery("#add-club-code-confirm-form"),e=a.find(".step_back"),o=jQuery("#personal_info_register"),n,t;function i(e){var t=""+e%60;return""+Math.floor(e/60)+":"+(t=1===t.length?"0"+t:t)}0!==r.length&&(a.find('input[name="code"]').codeInput(),r.on("submit",function(e){e.preventDefault(),t=r.find('input[name="phone"]').val(),jQuery.ajax({type:"POST",url:$(this).attr("action"),data:{phone:$("#add-club-start-input").inputmask("unmaskedvalue"),_token:$('#add-club-start-form [name="_token"]').val()},success:function(e){"false"==e.status?(r.find(".forma .form-group").addClass("error"),r.find(".forma .form-group .error").text(e.msg)):(r.find(".forma .form-group.error").removeClass("error"),r.find(".forma .form-group .error").text(""),r.hide(),a.find(".user_phone").text(t),a.show(),clearInterval(n),function(){clearInterval(n);let e=jQuery("#countdown"),t=jQuery("#reSendCode"),r=180;e.text(i(r)),t.addClass("disabled"),n=setInterval(function(){r--,e.text(i(r)),0===r&&(t.removeClass("disabled"),e.text(" "),clearInterval(n))},1e3)}())},error:function(e){r.find(".forma .form-group").addClass("error"),$.each(e.responseJSON.errors,function(e,t){r.find('.forma .form-group [name="'+e+'"]').closest(".form-group").find(".error").text(t)})}})}),a.on("submit",function(e){e.preventDefault(),jQuery(".code_wrapper .error").text("");var t="",e=$("#add-club-start-input").inputmask("unmaskedvalue");if(a.find(".code_input_wrapper input").each(function(){t+=$(this).val()}),4!=t.length)return!1;jQuery.ajax({type:"POST",url:$(this).attr("action"),data:{phone:e,confirm_code:t,_token:a.find('[name="_token"]').val()},success:function(e){e.error?jQuery(".code_wrapper .error").text(e.error):(o.find("#user-phone-input").val($("#add-club-start-input").inputmask("unmaskedvalue")),o.find('[name="phone"]').val($("#add-club-start-input").inputmask("unmaskedvalue")),o.find('[name="conf_code"]').val(t),$(".add_club_page_start_wrapper").hide(),o.show())}})}),o.find("form").on("submit",function(e){e.preventDefault(),o.find(".forma .form-group").removeClass("error"),o.find(".forma .error").remove(),jQuery.ajax({type:"POST",url:$(this).attr("action"),data:o.find("form").serialize(),success:function(e){void 0!==e.errors?jQuery(".code_wrapper .error").text(e.error):location.href="/personal/clubs?action=add_club"},error:function(e){$.each(e.responseJSON.errors,function(e,t){o.find('.forma .form-group [name="'+e+'"]').closest(".form-group").addClass("error").append('<div class="error">'+t+"</div>")})}})}),e.on("click",function(e){a.trigger("reset"),a.hide(),r.show()}),jQuery("#reSendCode").on("click",function(e){r.trigger("submit")}))}),jQuery(function(){let e=jQuery('[data-remodal-id="club_photo_modal"]'),r=jQuery(".club_photo_modal_wrapper"),a=jQuery("#show_club_photo_counter_slide");if(0!==e.length){let t=r.find(".slide_item").length;function o(e){a.text(`${e+1} / ${t}`)}o(0),e.on("opened",function(){r.slick({infinite:!0,slidesToShow:1,slidesToScroll:1,prevArrow:'<button type="button" class="slick-prev slick-arrow"><img src="/img/left.svg" alt="arrow"></button>',nextArrow:'<button type="button" class="slick-next slick-arrow"><img src="/img/right.svg" alt="arrow"></button>'}),r.on("beforeChange",function(e,t,r,a){o(a)})}),e.on("closed",function(){jQuery(".club_photo_modal_wrapper").slick("unslick")})}}),jQuery(function(){let r=jQuery("#user-profile-form"),a,o=r.find('input[name="phone"]'),n=r.find(".confirm_mobile_wrapper"),i=n.find(".confirm_mobile_descr"),t,l=r.find("#oldPhone").val();function u(){r.find(".user_profile_submit").addClass("disabled"),jQuery.ajax({type:"POST",url:r.attr("action"),data:r.serialize(),success:function(e){"false"==e.status||(jQuery(".user_profile_submit").removeClass("disabled"),jQuery('[data-remodal-id="success_modal"]').remodal().open())},error:function(e){jQuery(".user_profile_submit").removeClass("disabled"),$.each(e.responseJSON.errors,function(e,t){r.find('.form-group [name="'+e+'"]').closest(".form-group").addClass("error").append('<div class="error">'+t+"</div>")})}})}function s(e){var t=""+e%60;return""+Math.floor(e/60)+":"+(t=1===t.length?"0"+t:t)}0!==r.length&&(r.find('input[name="code"]').codeInput(),r.on("submit",function(e){e.preventDefault(),r.find(".forma .form-group").removeClass("error"),r.find(".forma .error").remove(),t=o.val(),o.inputmask("unmaskedvalue")!==l?(r.find(".code_input_wrapper input").val(""),jQuery.ajax({type:"POST",url:$(this).attr("phone-action"),data:{phone:o.inputmask("unmaskedvalue"),_token:r.find('[name="_token"]').val()},success:function(e){"false"==e.status?jQuery("#user-profile-form").find("#user-phone-input").closest(".form-group").addClass("error").append('<div class="error">'+e.msg+"</div>"):(jQuery(".user_profile_submit").addClass("disabled"),o.hide(),i.text(`Код отправлен на номер ${t}`).removeClass("error"),n.show(),clearInterval(a),function(){let e=jQuery("#countdown"),t=jQuery("#reSendCodeProfile"),r=180;e.text(s(r)),t.addClass("disabled"),a=setInterval(function(){r--,e.text(s(r)),0===r&&(t.removeClass("disabled"),e.text(" "),clearInterval(a))},1e3)}())}})):u()}),jQuery("#reSendCodeProfile").on("click",function(e){r.trigger("submit")}),r.on("change",'input[name="code"]',function(e){let t=jQuery(this);jQuery.ajax({type:"POST",url:r.attr("verify-action"),data:{confirm_code:t.val(),phone:o.inputmask("unmaskedvalue"),_token:r.find('[name="_token"]').val()},success:function(e){void 0!==e.error?i.text(e.error).addClass("error"):(l=o.inputmask("unmaskedvalue"),u(),o.show(),n.hide(),clearInterval(a),jQuery(".user_profile_submit").removeClass("disabled"))}})}))}),jQuery(function(){let t=document.getElementById("search_club_by_map"),u=[],s=null,c=400;window.matchMedia("(max-width: 760px)").matches&&(c=100),t&&window.ymaps&&ymaps.ready(()=>{let r=jQuery("[data-search-club-by-map]"),a=document.querySelector("[data-search-club-by-map]");var e=[window.CITY_LAT,window.CITY_LON];let o=new ymaps.Map(t,{center:l(e),zoom:11,behaviors:["drag","dblClickZoom"],controls:[]}),n=new ymaps.Clusterer({clusterIcons:[{href:"/img/icon-red-border.svg",size:[40,40],offset:[-20,-20],color:"red"},{href:"/img/icon-red-border.svg",size:[60,60],offset:[-30,-30],textColor:"red"}],groupByCoordinates:!1,clusterDisableClickZoom:!1,clusterHideIconOnBalloonOpen:!1,geoObjectHideIconOnBalloonOpen:!1,hasBalloon:!1,minClusterSize:4,textColor:"red"});e=new ymaps.control.ZoomControl({options:{position:{left:"auto",right:10,top:c}}});function i(t){if(!s||s.id!==t){let e=u.find(e=>e.id===t);e&&(s&&(s.placemark.options.set("iconImageHref","/img/ballon.svg"),s.placemark.options.set("zIndex",1)),e.placemark.options.set("iconImageHref","/img/active_ballon.svg"),e.placemark.options.set("zIndex",2),o.setCenter(l(e.placemark.geometry.getCoordinates(),o.getZoom()),o.getZoom(),{duration:800,timingFunction:"ease"}),s=e)}}function l(e){var[t,e]=e;return[t,e]}o.controls.add(e),jQuery("[data-role-club]").each(function(){let t=jQuery(this),e=new ymaps.Placemark([t.data("lat"),t.data("lon")],{},{iconLayout:"default#image",iconImageHref:"/img/ballon.svg",iconImageSize:[42,60],iconImageOffset:[-14,-40],zIndex:1});e.events.add("click",function(){var e=t.data("id");jQuery("[data-role-club]").removeClass("active"),$(".search_club_list .search_club_item.another_city").hide(),$(".search_club_list [data-id="+e+"]").hasClass("another_city")&&(void 0===$(".search_club_list [data-id="+e+"] .main_preview_photo").attr("src")&&$(".search_club_list [data-id="+e+"] .main_preview_photo").attr("src",$(".search_club_list [data-id="+e+"] .main_preview_photo").attr("asrc")),$(".search_club_list [data-id="+e+"]").show()),i(e),function(e,t,r){let a=getComputedStyle(e),o=getComputedStyle(r[0]),n=t.offset().top,i=r.offset().top,l=t[0].scrollTop,u=parseFloat(a.height?a.height.replace("px",""):"0"),s=parseFloat(o.height?o.height.replace("px",""):"0"),c=t.offset().left,d=r.offset().left,p=t[0].scrollLeft,f=parseFloat(a.paddingTop?a.paddingTop.replace("px",""):"0");t[0].scrollTop=i-n+l-u/2+s/2,t[0].scrollLeft=d-c+p-f}(a,r,jQuery(`[data-id='${e}']`)),jQuery(`[data-id='${e}']`).addClass("active")}),n.add(e),o.geoObjects.add(n),u.push({id:t.data("id"),placemark:e})}),jQuery(document).on("mouseover","[data-search-club-by-map] [data-role-club][data-id]",function(e){let t=jQuery(this);jQuery("[data-role-club]").removeClass("active"),i(t.data("id")),t.addClass("active")}),o.setBounds(n.getBounds(),{checkZoomRange:!0})})}),jQuery(function(){$("#city_selector").on("select2:select",function(e){var t=$('meta[name="site"]').attr("content");window.location.href=t+"/"+e.params.data.data}),$("#city_selector").select2({ajax:{url:$('meta[name="site"]').attr("content")+"/searchCities",dataType:"json"},cache:!0}),$("#add-club-form #select-сity").select2({ajax:{url:$('meta[name="site"]').attr("content")+"/searchCities",dataType:"json",data:function(e){return{q:e.term,page:e.page,selected:$("#add-club-form #select-сity").val()}}},cache:!0}),$("#add-club-form #select-сity").on("select2:select",function(e){$("#add-club-form #select-subway").val("").change(),1==e.params.data.has_metro?$("#add-club-form #select-subway").attr("disabled",!1):$("#add-club-form #select-subway").attr("disabled",!0)}),$("#add-club-form #select-subway").select2({ajax:{url:$('meta[name="site"]').attr("content")+"/searchMetro",dataType:"json",data:function(e){return{q:e.term,page:e.page,city_id:$("#add-club-form #select-сity").val()}}},cache:!0}),$("#add-club-form #select-subway").on("select2:select",function(e){$('#add-club-form #select-subway option[value="'+e.params.data.id+'"]').attr("data-line-color","#"+e.params.data.color)})}),jQuery(function(){Layout.initSelect2(),jQuery(".club_page_services_list .club_services_mobile_toggle").on("click",function(e){jQuery(this).toggleClass("active").closest(".club_page_services_list").toggleClass("mob_toggle").find(".mob_hide").toggleClass("active")}),jQuery('input[type="tel"]').inputmask({mask:"+7 (999) 999-99-99",removeMaskOnSubmit:!0,onincomplete:function(){this.value=""},oncomplete:function(){"log-in-phone-input"==$(this).attr("id")&&$("#log-in-password-input").focus()}}),jQuery('input[type="number"]').on("input change",function(e){var t=+jQuery(this).val();(t<=0||isNaN(t))&&jQuery(this).val("")}),jQuery("ul.club_list_navigation_tabs li a").on("click",function(e){e.preventDefault();let t=jQuery(this),r=jQuery(t.attr("href"));t.is(".active")||(jQuery("ul.club_list_navigation_tabs li a.active").removeClass("active"),t.addClass("active"),r.show(),jQuery(".club_list_content_tabs .tab").not(r).hide())}),jQuery(".club_page_toggle_content").on("click",function(e){jQuery(this).closest(".toggle_block_wrapper").find(".toggle_block").toggle(),jQuery(this).toggleClass("active")}),jQuery(".review_content_wrapper").scrollbar(),jQuery(".person_add_club_modal").remodal({appendTo:jQuery(".person_add_club_modal_wrapper"),hashTracking:!1,closeOnOutsideClick:!1}),jQuery(".show_club_price_list_modal").remodal({appendTo:jQuery(".club_page_modals_wrapper"),hashTracking:!1,closeOnOutsideClick:!1}),jQuery(".tariffs_modal").remodal({appendTo:jQuery(".tariffs_modal_wrapper"),hashTracking:!1}),jQuery(".show_club_photo_modal").remodal({appendTo:jQuery(".club_page_modals_wrapper"),hashTracking:!1,closeOnOutsideClick:!1}),jQuery(".club_page_reviews_list").slick({infinite:!1,slidesToShow:4,slidesToScroll:1,variableWidth:!0,prevArrow:'<button type="button" class="slick-prev slick-arrow"><img src="../../img/left1.svg" alt="arrow"></button>',nextArrow:'<button type="button" class="slick-next slick-arrow"><img src="../../img/right1.svg" alt="arrow"></button>',responsive:[{breakpoint:700,settings:{slidesToShow:1,slidesToScroll:1}}]}),jQuery(".our_team_list").slick({infinite:!0,slidesToShow:5,slidesToScroll:1,variableWidth:!0,prevArrow:'<button type="button" class="slick-prev slick-arrow"><img src="../../img/left1.svg" alt="arrow"></button>',nextArrow:'<button type="button" class="slick-next slick-arrow"><img src="../../img/right1.svg" alt="arrow"></button>',responsive:[{breakpoint:700,settings:{slidesToShow:1,slidesToScroll:1}}]});let r=0,a=jQuery(".club_page_photo_list .club_page_photo_item").length;jQuery(".club_page_photo_list").on("scroll",function(e){var t=this.scrollLeft>=r?"right":"left";r=this.scrollLeft;t=function(e,t,r){let a=[];jQuery(e).find(t).each(function(e,t){a.push({index:e,x:t.getBoundingClientRect().x})});t=a.filter(({x:e})=>"right"===r?0<=e:e<=0).sort((e,t)=>Math.abs(e.x)-Math.abs(t.x));return t?.[0]?.index||0}(this,".club_page_photo_item",t);jQuery(this).closest(".club_page_photo_wrapper").find(".counter").text(`${t+1} / ${a}`)}),jQuery(window).on("resize",function(e){jQuery(".club_page_photo_list").trigger("scroll")}),jQuery(".club_page_photo_list").trigger("scroll"),jQuery(".log_in_form_toggle").on("click",function(e){e.preventDefault(),jQuery(".header_menu .log_in_block_wrapper").toggle(),jQuery(this).toggleClass("active")}),jQuery(document).on("click",function(e){jQuery(".header_menu .log_in_block_wrapper").is(":visible")&&0===jQuery(e.target).closest(".log_in_block_wrapper").length&&!jQuery(e.target).is(".log_in_form_toggle")&&(jQuery(".header_menu .log_in_block_wrapper").hide(),jQuery(".log_in_form_toggle").removeClass("active"))}),jQuery("#open_search_form").on("click",function(e){ym(82365286,"reachGoal","search"),gtag("event","send",{event_category:"search",event_action:"click"}),jQuery(".search .search_form").addClass("active")}),jQuery("#close_search_form").on("click",function(e){jQuery(".search .search_form").removeClass("active")}),jQuery(".langame_software_options .option").on("click",function(e){jQuery(this).closest(".option_item").toggleClass("active")}),jQuery(window).on("scroll resize",function(){jQuery("[data-track-sticky]").each(function(){let e=jQuery(this),t=this.getBoundingClientRect().y;e.toggleClass("sticky",0===t).toggleClass("not-sticky",0!==t)})}),jQuery('a[href^="#block-"]').on("click",function(e){e.preventDefault();e=jQuery(this).attr("href");jQuery("html, body").animate({scrollTop:jQuery(e).offset().top+"px"})}),jQuery("#gamer_mailing").on("click",function(e){jQuery(".mailing_form_wrapper").show(),jQuery(this).closest(".btn_wrapper").hide(),jQuery(this).closest(".mailing_modal").find(".title").text("Игрок"),jQuery(this).closest(".mailing_modal").find(".instr").text("Оставь свою почту и получай информацю об акциях, розыгрышах и других интересных предложениях от клубов!")}),jQuery("#owner_mailing").on("click",function(e){jQuery(".mailing_form_wrapper").show(),jQuery(this).closest(".btn_wrapper").hide(),jQuery(this).closest(".mailing_modal").find(".title").text("Представитель клуба"),jQuery(this).closest(".mailing_modal").find(".instr").text("Подпишись на нашу рассылку, и будь в курсе обновлений сервиса, выгодных предложений от брендов и другой полезной информации!")}),jQuery(".remodal.mailing_modal").on("opening",function(e){jQuery(this).find(".mailing_form_wrapper").hide(),jQuery(this).find("form input").val(""),jQuery(this).find(".btn_wrapper").show(),jQuery(this).closest(".mailing_modal").find(".title").text("Подписаться на рассылку"),jQuery(this).closest(".mailing_modal").find(".instr").text("Привет! Ты выбираешь место, где поиграть, или работаешь в компьютерном клубе?")}),jQuery("#mailing-form").on("submit",function(e){jQuery('[data-remodal-id="mailing_success_modal"]').remodal().open()})});
//# sourceMappingURL=layout.js.map
