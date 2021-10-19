<!doctype html>
<html lang="ru">
<head>
    @yield('page')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{url('/')}}/favicon.ico" type="image/x-icon">
    <meta name="site" content="{{url('/')}}">
    @if(admin())
        <meta name="is-admin" content="1">
    @endif
    <meta name="yandex-verification" content="32e051951e8b0c78"/>
    <meta name="google-site-verification" content="hxlJwydJQGGNf58k_xhPIcvSaIB1Vb3LplRFOPUyl0g"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
          integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
          integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
          integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.css"
          integrity="sha512-UO+dUiFTr6cCaPZKCzXEGhYsuK8DkGAS5iThyMUrtHsg+INCFyRM3GiqJ4rjuvfEyn81XGjpfmjSwwR1dAjAsw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.css"
          integrity="sha512-xlddSVZtsRE3eIgHezgaKXDhUrdkIZGMeAFrvlpkK0k5Udv19fTPmZFdQapBJnKZyAQtlr3WXEM3Lf4tsrHvSA=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal-default-theme.min.css"
          integrity="sha512-jRxwiuoe3nt8lMSnOzNEuQ7ckDrLl31dwVYFWS6jklXQ6Nzl7b05rrWF9gjSxgOow5nFerdoN6CBB4gY5m5nDw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
          integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.2/simplebar.min.css"
          integrity="sha512-uZTwaYYhJLFXaXYm1jdNiH6JZ1wLCTVnarJza7iZ1OKQmvi6prtk85NMvicoSobylP5K4FCdGEc4vk1AYT8b9Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('/fonts/stylesheet.css') }}?v={{ENV('CSS_VERSION',0)}}">
    <link rel="stylesheet" href="{{ asset('/fonts/PT/stylesheet.css') }}?v={{ENV('CSS_VERSION',0)}}">
    <link rel="stylesheet" href="{{ asset('/css/layout.css') }}?v={{ENV('CSS_VERSION',0)}}">
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments);
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a);
        })
        (window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym');

        ym(82365286, 'init', {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true,
            ecommerce: 'dataLayer'
        });
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-201040515-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-201040515-1');
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-K5ZMWGV');</script>
    <!-- End Google Tag Manager -->

    <!-- /Yandex.Metrika counter -->
    <script type="text/javascript">!function() {
            var t = document.createElement('script');
            t.type = 'text/javascript', t.async = !0, t.src = 'https://vk.com/js/api/openapi.js?169', t.onload = function() {
                VK.Retargeting.Init('VK-RTRG-1054347-dW3vv'), VK.Retargeting.Hit();
            }, document.head.appendChild(t);
        }();</script>
    <noscript><img src="https://vk.com/rtrg?p=VK-RTRG-1054347-dW3vv" style="position:fixed; left:-999px;" alt=""/></noscript>
    <style>
        @media (max-width: 1500px) {
            section.sc_wrapper_by_map .sc_by_map .sc_sort_wrapper {
                padding-top: 10px;
            }

            section.sc_wrapper_by_map .sc_by_map .sc_sort_wrapper .sc_show {
                top: 0;
            }
        }

        .header .header_wrapper .header_menu_wrapper .header_menu .log_in_block_wrapper .log_in_wrapper form .forma .form-group .logmsg .error {
            top: 88%;
        }

    </style>
</head>

<body>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/82365286" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K5ZMWGV"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="svg_icons">
    <svg id="icon-svg-account" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.8684 17C14.8045 17 13.0459 16.2622 11.5925 14.7865C10.1391 13.3108 9.41238 11.5252 9.41238 9.42969C9.41238 7.3342 10.1391 5.54861 11.5925 4.07292C13.0459 2.59722 14.8045 1.85938 16.8684 1.85938C18.9322 1.85938 20.6908 2.59722 22.1442 4.07292C23.5977 5.54861 24.3244 7.3342 24.3244 9.42969C24.3244 11.5252 23.5977 13.3108 22.1442 14.7865C20.6908 16.2622 18.9322 17 16.8684 17ZM16.8684 20.8073C18.6997 20.8073 20.7199 21.0729 22.9291 21.6042C25.1383 22.1354 27.1585 23.0061 28.9898 24.2161C30.8211 25.4262 31.7367 26.7986 31.7367 28.3333V32.1406H2V28.3333C2 26.7986 2.91565 25.4262 4.74694 24.2161C6.57824 23.0061 8.59848 22.1354 10.8077 21.6042C13.0168 21.0729 15.0371 20.8073 16.8684 20.8073Z"
              style="fill: var(--icon-color, black)"/>
    </svg>

    <svg id="icon-svg-file" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M28.3754 9.58574C28.5746 9.78496 28.6875 10.0539 28.6875 10.3361V30.8125C28.6875 31.4002 28.2127 31.875 27.625 31.875H6.375C5.7873 31.875 5.3125 31.4002 5.3125 30.8125V3.1875C5.3125 2.5998 5.7873 2.125 6.375 2.125H20.4764C20.7586 2.125 21.0309 2.23789 21.2301 2.43711L28.3754 9.58574ZM26.2371 10.8242L19.9883 4.57539V10.8242H26.2371ZM10.625 16.0039C10.5546 16.0039 10.487 16.0319 10.4372 16.0817C10.3874 16.1315 10.3594 16.1991 10.3594 16.2695V17.8633C10.3594 17.9337 10.3874 18.0013 10.4372 18.0511C10.487 18.1009 10.5546 18.1289 10.625 18.1289H23.375C23.4454 18.1289 23.513 18.1009 23.5628 18.0511C23.6126 18.0013 23.6406 17.9337 23.6406 17.8633V16.2695C23.6406 16.1991 23.6126 16.1315 23.5628 16.0817C23.513 16.0319 23.4454 16.0039 23.375 16.0039H10.625ZM10.625 20.5195C10.5546 20.5195 10.487 20.5475 10.4372 20.5973C10.3874 20.6471 10.3594 20.7147 10.3594 20.7852V22.3789C10.3594 22.4494 10.3874 22.5169 10.4372 22.5667C10.487 22.6165 10.5546 22.6445 10.625 22.6445H16.7344C16.8048 22.6445 16.8724 22.6165 16.9222 22.5667C16.972 22.5169 17 22.4494 17 22.3789V20.7852C17 20.7147 16.972 20.6471 16.9222 20.5973C16.8724 20.5475 16.8048 20.5195 16.7344 20.5195H10.625Z"
              style="fill: var(--icon-color, black)"/>
    </svg>

    <svg id="icon-svg-offer" viewBox="0 0 24 24"fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.3292 23.9539C11.5558 23.9733 10.6859 23.9515 10.3963 23.9057C10.1066 23.8598 9.60032 23.759 9.27126 23.6814C8.9422 23.6039 8.37764 23.439 8.0167 23.3148C7.65576 23.1907 7.0492 22.9322 6.66885 22.7405C6.28842 22.5487 5.6827 22.1961 5.32279 21.9567C4.66832 21.5215 4.66832 21.5215 4.3221 21.9275C4.0867 22.2036 3.91776 22.3222 3.79392 22.2983C3.69379 22.2791 3.56282 22.1584 3.50292 22.0301C3.44301 21.9019 3.14995 21.0259 2.85173 20.0835C2.34539 18.4836 2.31989 18.3598 2.46595 18.2137C2.61201 18.0677 2.74195 18.0682 4.42889 18.2212C5.42254 18.3113 6.33154 18.4247 6.44901 18.473C6.56648 18.5213 6.68788 18.6269 6.71892 18.7076C6.75192 18.7936 6.65067 19.0279 6.47442 19.2733C6.17357 19.6922 6.17357 19.6922 6.39201 19.872C6.5121 19.9709 7.01123 20.2611 7.50107 20.5169C7.99092 20.7727 8.7382 21.0904 9.16157 21.2227C9.58504 21.3551 10.3173 21.5129 10.7889 21.5734C11.2794 21.6363 12.0531 21.6592 12.597 21.627C13.1201 21.596 13.9065 21.4813 14.3448 21.3722C14.7831 21.2631 15.6066 20.949 16.1748 20.6742C16.743 20.3994 17.4692 19.9782 17.7886 19.7382C18.1079 19.4982 18.6977 18.9501 19.0992 18.5202C19.5007 18.0904 20.0147 17.4284 20.2414 17.0491C20.4681 16.6697 20.775 16.0743 20.9235 15.7259C21.072 15.3774 21.2188 14.9661 21.2496 14.8118C21.3058 14.5312 21.3058 14.5312 20.2973 14.5312C19.4294 14.5312 19.2434 14.5593 18.9631 14.7325C18.6375 14.9338 18.6375 14.9338 18.2865 14.5216C18.0935 14.2949 17.1608 13.161 16.2137 12.0019C15.2667 10.8428 14.0662 9.38737 13.546 8.7675C12.7308 7.79625 12.5621 7.64062 12.3241 7.64081C12.1511 7.641 11.4974 7.94962 10.5734 8.46769C9.39342 9.12919 8.99995 9.30459 8.60395 9.34547C8.26739 9.38016 7.99795 9.35006 7.76151 9.25134C7.52507 9.15253 7.3942 9.02728 7.3521 8.85956C7.31807 8.724 7.32717 8.53322 7.37226 8.43563C7.41735 8.33803 8.21357 7.68084 9.1417 6.97528C10.0698 6.26962 11.0546 5.58797 11.3299 5.46037C11.7124 5.28319 11.9893 5.22778 12.5018 5.22572C13.0838 5.22347 13.3411 5.28637 14.4386 5.69953C15.1347 5.96166 16.4214 6.46069 17.2979 6.8085C18.8917 7.44094 18.8917 7.44094 20.7198 7.47178C22.0748 7.49466 22.627 7.53844 22.8533 7.64072C23.0212 7.71666 23.241 7.91437 23.3418 8.08012C23.4426 8.24578 23.6146 8.74209 23.724 9.18291C23.868 9.76247 23.9373 10.4126 23.9748 11.5312C24.0156 12.7459 23.9929 13.2694 23.8691 13.9687C23.7825 14.4586 23.5634 15.3023 23.3825 15.8437C23.2016 16.3852 22.8674 17.1781 22.64 17.6059C22.4126 18.0337 21.9285 18.7802 21.5641 19.2649C21.1998 19.7496 20.5972 20.4257 20.2248 20.7675C19.8525 21.1092 19.1791 21.6367 18.7285 21.9397C18.2777 22.2427 17.5942 22.6401 17.2094 22.8227C16.8246 23.0052 16.2019 23.2572 15.8257 23.3827C15.4495 23.508 14.8253 23.6799 14.4386 23.7647C14.0272 23.8549 13.1519 23.9333 12.3292 23.9539ZM3.46167 7.45312C6.61045 7.54687 6.61045 7.54687 6.57735 7.82812C6.55917 7.98281 6.53807 8.3625 6.53048 8.67187C6.51951 9.11841 6.55992 9.29494 6.72614 9.52809C6.84135 9.68953 7.1257 9.91106 7.35801 10.0203C7.66692 10.1655 7.96307 10.2187 8.46098 10.2187C9.01701 10.2187 9.24473 10.1693 9.7042 9.94969C10.0136 9.80184 10.6814 9.44006 11.1882 9.14578C11.6951 8.85141 12.1623 8.63081 12.2267 8.65556C12.291 8.68022 12.8999 9.37912 13.5798 10.2086C14.2597 11.0381 15.4947 12.5418 16.3243 13.5501C17.5416 15.0298 17.8416 15.4512 17.8798 15.7354C17.9181 16.0217 17.8798 16.1433 17.6741 16.3878C17.535 16.5531 17.3122 16.7156 17.179 16.7491C17.0458 16.7825 16.8282 16.7664 16.6955 16.7134C16.5628 16.6602 16.3803 16.5861 16.2901 16.5484C16.155 16.492 16.1261 16.5298 16.1261 16.7629C16.1261 16.9638 16.0424 17.1162 15.8376 17.2885C15.641 17.454 15.4387 17.5312 15.2023 17.5312C15.0114 17.5312 14.766 17.4687 14.657 17.3924C14.4686 17.2603 14.4558 17.2693 14.3986 17.5742C14.3626 17.7661 14.2239 17.9914 14.0532 18.135C13.8871 18.2747 13.6514 18.375 13.4893 18.375C13.3359 18.375 13.091 18.3132 12.9449 18.2377C12.6875 18.1045 12.6779 18.1081 12.6264 18.3548C12.5972 18.4948 12.5085 18.6999 12.4293 18.8107C12.3501 18.9213 12.1686 19.0505 12.026 19.0975C11.8834 19.1447 11.6823 19.1677 11.5792 19.1486C11.4761 19.1296 11.3403 19.0972 11.2776 19.0767C11.1905 19.0483 11.1961 18.9613 11.301 18.7102C11.3767 18.5292 11.4386 18.1884 11.4386 17.9531C11.4386 17.7178 11.3807 17.3895 11.31 17.2236C11.2394 17.0576 11.0808 16.8292 10.9578 16.716C10.8347 16.6027 10.6061 16.4551 10.4495 16.3879C10.2929 16.3207 9.9817 16.118 9.75792 15.9375C9.53413 15.757 9.2617 15.5177 9.15257 15.4057C9.04345 15.2936 8.85304 15.0684 8.72939 14.9053C8.60573 14.7422 8.36554 14.5424 8.19557 14.4614C8.0256 14.3803 7.83857 14.1982 7.77998 14.0569C7.72139 13.9155 7.58142 13.7133 7.46882 13.6074C7.35623 13.5017 7.10788 13.3499 6.91682 13.2701C6.72585 13.1902 6.4311 13.1259 6.26189 13.1271C6.09267 13.1282 5.78367 13.2066 5.57517 13.3012C5.36667 13.3959 4.98501 13.7141 4.72692 14.0083C4.25779 14.5432 4.25779 14.5432 2.50598 14.5138C0.75426 14.4844 0.75426 14.4844 0.457728 14.1877C0.247447 13.9772 0.139635 13.7592 0.0867599 13.4377C0.0457912 13.1884 0.00969743 12.5465 0.00669743 12.0112C0.00360368 11.4759 0.0688534 10.6117 0.151728 10.0906C0.23451 9.56953 0.423228 8.77331 0.570978 8.32106C0.718728 7.86881 0.981979 7.19325 1.15588 6.81975C1.32979 6.44625 1.74117 5.73984 2.06995 5.25C2.39882 4.76016 3.0487 3.97856 3.51417 3.51309C3.97964 3.04762 4.76123 2.39775 5.25107 2.06887C5.74092 1.74009 6.44385 1.33031 6.81314 1.15837C7.18242 0.986437 7.85742 0.722344 8.31314 0.5715C8.76885 0.42075 9.53938 0.230437 10.0254 0.148687C10.5115 0.0669374 11.4216 0 12.0479 0C12.6743 0 13.5844 0.0681564 14.0705 0.151406C14.5565 0.23475 15.3326 0.426375 15.7951 0.577313C16.2576 0.72825 17.0803 1.08637 17.6233 1.37325C18.1662 1.66003 18.6737 1.91203 18.7511 1.93322C18.8351 1.95609 18.9979 1.82006 19.1556 1.59516C19.3071 1.37906 19.4958 1.21875 19.5988 1.21875C19.6973 1.21875 19.8398 1.31372 19.9153 1.42969C19.9907 1.54566 20.313 2.31562 20.6314 3.14062C20.9498 3.96562 21.216 4.78828 21.2229 4.96875C21.2354 5.29687 21.2354 5.29687 19.4073 5.27616C18.4019 5.26472 17.4445 5.23163 17.2798 5.20256C17.0932 5.16966 16.9581 5.07966 16.9214 4.96378C16.8814 4.83797 16.9564 4.65 17.1535 4.38206C17.4269 4.01025 17.4344 3.97875 17.2775 3.86269C17.1856 3.79481 16.8995 3.62025 16.6417 3.47484C16.3839 3.32944 15.8782 3.0945 15.5179 2.95275C15.1576 2.811 14.4826 2.61656 14.0179 2.52066C13.4684 2.40722 12.7795 2.34619 12.0479 2.34619C11.3133 2.34619 10.6302 2.40694 10.0792 2.52131C9.61514 2.61759 8.89448 2.82825 8.47785 2.9895C8.06114 3.15075 7.45748 3.44147 7.13648 3.63562C6.81548 3.82969 6.25692 4.21969 5.89523 4.50206C5.53354 4.78453 4.99804 5.30156 4.70526 5.65106C4.41248 6.00047 4.01292 6.54891 3.81726 6.86981L3.46167 7.45312ZM9.63857 19.0253C9.57154 19.0221 9.42023 18.9806 9.30239 18.9334C9.18454 18.886 9.01579 18.7203 8.92739 18.565C8.79079 18.325 8.72451 18.2901 8.48545 18.332C8.2971 18.3649 8.10285 18.3182 7.89717 18.1905C7.69973 18.068 7.57007 17.8995 7.53389 17.7187C7.48279 17.4632 7.44379 17.4375 7.10713 17.4375C6.8226 17.4375 6.67307 17.3738 6.4626 17.1635C6.31054 17.0114 6.18857 16.7884 6.18857 16.6623C6.18857 16.4537 6.15351 16.4359 5.7591 16.4441C5.3841 16.452 5.29363 16.4129 5.04698 16.1369C4.83867 15.9038 4.77454 15.7519 4.80285 15.5587C4.82404 15.4147 5.02673 15.0563 5.25342 14.7626C5.48001 14.4689 5.76182 14.1653 5.87976 14.0881C6.02442 13.9933 6.19973 13.9675 6.41985 14.0089C6.59901 14.0424 6.81014 14.1621 6.88898 14.2746C6.96782 14.3872 7.03232 14.6416 7.03232 14.8401C7.03232 15.1593 7.0567 15.198 7.24326 15.1757C7.35932 15.1618 7.56801 15.1801 7.70704 15.2164C7.84617 15.2527 8.02542 15.3758 8.10548 15.4901C8.18554 15.6045 8.25107 15.8362 8.25107 16.0053C8.25107 16.2899 8.27367 16.3125 8.55829 16.3125C8.72732 16.3125 8.96114 16.3794 9.07795 16.4612C9.19467 16.543 9.31485 16.7329 9.34486 16.8831C9.39407 17.1291 9.43607 17.1562 9.76701 17.1562C10.0323 17.1562 10.1986 17.2203 10.3647 17.3864C10.5099 17.5315 10.5948 17.7235 10.5948 17.9066C10.5948 18.0663 10.5308 18.3205 10.4526 18.4718C10.3744 18.6231 10.1866 18.8108 10.0354 18.889C9.8841 18.9672 9.70551 19.0285 9.63857 19.0253Z"
              style="fill: var(--icon-color, black)"/>
    </svg>

    <svg id="icon-svg-cancel" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 2.83337C9.16587 2.83337 2.83337 9.16587 2.83337 17C2.83337 24.8342 9.16587 31.1667 17 31.1667C24.8342 31.1667 31.1667 24.8342 31.1667 17C31.1667 9.16587 24.8342 2.83337 17 2.83337ZM24.0834 22.0859L22.0859 24.0834L17 18.9975L11.9142 24.0834L9.91671 22.0859L15.0025 17L9.91671 11.9142L11.9142 9.91671L17 15.0025L22.0859 9.91671L24.0834 11.9142L18.9975 17L24.0834 22.0859Z"
              style="fill: var(--icon-color, #DC0000)"/>
    </svg>

    <svg id="icon-svg-subway" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
              clip-rule="evenodd"
              d="M1.7717 19.5045L7.88463 3.90002L13 13.0896L18.0963 3.90002L24.1727 19.5045H26V22.1H16.7877V19.5045H18.0963L16.7877 15.8676L13 22.1L9.1613 15.8676L7.88463 19.5045H9.1613V22.1H0V19.5045H1.7717Z"
              style="fill: var(--subway-color, #4DB762)"/>
    </svg>
</div>
<?if (env('DEV_SERVER', 'false') === true){?>
<div style="
    text-align: center;
    font-size: 20px;
    background: #ffcd00;
    padding: 15px;

">
    этот сервер для разработки
</div>
<?}?>
<!--HEADER START-->
<header class="header">
    <div class="container-fluid">
        <div class="header_wrapper">
            <div class="header_logo_wrapper">
                <a href="{{url('/')}}">
                    <img src="{{ asset('/img/logo.svg')}}" alt="logo">
                </a>
            </div>
            @if(!isset($mainPage))
            <div class="select2_wrapper select_city_wrapper">
                <select class="select_city" id="city_selector">
                    <option>{{city(true)['name']}}</option>
                </select>
                <a href="{{url('cities')}}">Все города</a>
            </div>
            @endif
            <div class="mobile_menu_bg"></div>
            <div class="header_menu_wrapper">
                <a href="#" class="mobile_menu_btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <div class="header_menu">
                    <div class="decor"></div>
                    @if(!Auth::guest())
                        <div class="mob_menu_item">
                            <ul>
                                @if(admin())
                                    <li>
                                        <a href="<?=url('panel')?>">Панель</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{url('personal/profile')}}">Профиль</a>
                                </li>
                                <li>
                                    <a href="{{url('personal/clubs')}}">Список клубов</a>
                                </li>
                                <li>
                                    <a href="<?= Auth::guest() ? url('register_club') : url('personal/clubs') ?>?action=add_club">Добавить клуб</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="exit" class="exit">Выйти</a>
                                </li>
                            </ul>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    @endif

                    @if(Auth::guest())
                        <ul class="mob_main_menu">
                            <li>
                                <a href="<?= Auth::guest() ? url('register_club') : url('personal/clubs') ?>?action=add_club">Добавить клуб</a>
                            </li>
                            <li>
                                <a href="{{url('contacts')}}">Контакты</a>
                            </li>
                            <li>
                                <a href=# class="log_in_form_toggle">Войти</a>
                            </li>
                        </ul>
                    @endif

                    <ul class="main_menu">
                        @if(admin())
                            <li>
                                <a href="<?=url('panel')?>">Панель</a>
                            </li>
                        @endif

                        <li>
                            <a href="<?= Auth::guest() ? url('register_club') : url('personal/clubs') ?>?action=add_club">Добавить клуб</a>
                        </li>
                        <li>
                            <a href="{{url('contacts')}}">Контакты</a>
                        </li>
                        @if(Auth::guest())
                            <li>
                                <a href=# class="log_in_form_toggle">Войти</a>
                            </li>
                        @else
                            <li>
                                <a href="{{url('personal/clubs')}}">Личный кабинет</a>
                            </li>
                        @endif
                    </ul>
                    @if(Auth::guest())
                        <div class="log_in_block_wrapper log_in_page_wrapper" style="display: none;">
                            <div class="log_in_page_title">
                                <span>Вход в личный кабинет</span>
                                <span class="instr">Для представителей компьютерных клубов</span>
                            </div>
                            <div class="log_in_wrapper">
                                <form action="{{ route('login') }}" method="post" id="log-in-form-popup">
                                    @csrf
                                    <div class="forma">
                                        <div class="form-group">
                                            <label for="log-in-phone-input">Номер телефона</label>
                                            <input id="log-in-phone-input" name="phone" type="tel" placeholder="+7 (___) ___-__-__" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="log-in-password-input">Пароль</label>
                                            <div class="input_wrapper">
                                                <input id="log-in-password-input" name="password" type="password" placeholder="" required>
                                                <p class="logmsg"></p>
                                                <a href="{{ route('password.request') }}" class="forgot_password">Забыл пароль</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="btn_wrapper">
                                        <a href="{{url('register_club')}}" class="registration">Регистрация</a>
                                        <button type="submit">Продолжить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="mob_menu_item">

                        <ul>
                            @if(Auth::guest())
                                <li>
                                    <a href="{{url('register_club')}}">Как попасть на LANGAME</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{url('personal/clubs')}}?action=add_club">Как попасть на LANGAME</a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('about-us')}}">О LANGAME</a>
                            </li>

                            <li>
                                <a href="{{url('contacts')}}">Обратная связь</a>
                            </li>

                            @if(!Auth::guest())
                                <li>
                                    <a href="{{url('contacts')}}">Контакты</a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('software')}}">LANGAME Software</a>
                            </li>

                            <li>
                                <a href="{{url('cities')}}">Все города</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mob_menu_item">
                        <ul>
                            <li>
                                <a href="#" data-remodal-target="report_modal">Сообщить об ошибке</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mob_menu_item">
                        <ul>
                            <li>
                                <a href="{{url('policy')}}">Политика конфиденциальности</a>
                            </li>
                            <li>
                                <a href="{{url('user-agreement')}}">Пользовательское соглашение</a>
                            </li>
                        </ul>
                        <div class="rights_wrapper">
                            <p>© ООО «Лангейм», 2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--HEADER END-->
@yield('content')
<!-- MODALS -->

<noindex>
<div class="remodal success_modal" data-remodal-id="success_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="club_phone_wrapper">
            <p class="title">Успешно!</p>
        </div>
    </div>
</div>

<div class="remodal mailing_success_modal" data-remodal-id="mailing_success_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="img_wrapper">
            <img src="{{ asset('/img/mail_success.svg')}}" alt="success">
        </div>
        <div class="title">Готово!</div>
        <div class="instr">
            Вы успешно подписались на рассылку, пожалуйста проверьте почту!
        </div>
    </div>
</div>

<div class="remodal report_modal" data-remodal-id="report_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="title">Экспресс - отчёт об ошибке</div>
        <form action="{{url('report_error')}}" method="post" id="report-form" data-recaptcha-form>
            @csrf
            <input type="hidden" name="url" value="{{url()->current()}}">
            <div class="forma">
                <textarea name="message" id="report-message-input" maxlength="1500" required></textarea>
            </div>
            <div class="recaptcha-holder">
                <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="{{env('RECAPCHA_PUB')}}"></div>
            </div>
            <div class="recaptcha-msg">
                @error('g-recaptcha-response')
                {{ $message }}
                @enderror
            </div>
            <div class="btn_wrapper">
                <button type="submit">Отправить</button>
            </div>
        </form>
        <div class="instr">
            Используйте <a href="{{url('contacts')}}">форму обратной связи,</a> если хотите указать
            контактную информацию и получить ответ.
        </div>
    </div>
</div>

<div class="remodal mailing_modal" data-remodal-id="mailing_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="title">Подписаться на рассылку</div>
        <div class="instr">
            Привет! Ты выбираешь место, где поиграть, или работаешь в компьютерном клубе?
        </div>

        <div class="btn_wrapper">
            <button type="button" class="log_in" data-remodal-target="gamer_mailing_modal">Игрок</button>
            <button type="button" data-remodal-target="owner_mailing_modal">Представитель клуба</button>
        </div>
    </div>
</div>

<div class="remodal mailing_modal" data-remodal-id="gamer_mailing_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="title">Игрок</div>
        <div class="instr">
            Оставь свою почту и получай информацю об акциях, розыгрышах и других интересных предложениях от клубов!
        </div>

        <form action="{{url('subscribe')}}" method="post" id="gamer-mailing-form">
            @csrf
            <input type="hidden" name="type" value="gamer">
            <div class="mailing_form_wrapper">
                <input type="email" name="email" required>
                <div class="btn_wrapper">
                    <button type="submit">Подписаться</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="remodal mailing_modal" data-remodal-id="owner_mailing_modal" data-remodal-options="hashTracking: false">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="title">Представитель клуба</div>
        <div class="instr">
            Подпишись на нашу рассылку, и будь в курсе обновлений сервиса, выгодных предложений от брендов и другой полезной информации!
        </div>

        <form action="{{url('subscribe')}}" method="post" id="owner-mailing-form">
            @csrf
            <div class="mailing_form_wrapper">
                <input type="hidden" name="type" value="owner">
                <input type="email" name="email" required>
                <div class="btn_wrapper">
                    <button type="submit">Подписаться</button>
                </div>
            </div>
        </form>
    </div>
</div>

<a data-remodal-target="get_geo"></a>
<div class="remodal get_geo" data-remodal-id="get_geo">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="remodal-content">
        <div class="club_phone_wrapper">
            <p class="title">Помогите нам найти вас: разрешите сайту определять местоположение в настройках браузера!</p>
        </div>
    </div>
</div>
</noindex>
<div class="club_page_modals_wrapper"></div>

<!-- END OF MODALS -->
<!--FOOTER START-->
<footer class="footer">
    <div class="container-fluid">
        <div class="footer_top">
            <div class="footer_logo_wrapper">
                <div class="logo_wrapper">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('/img/logo.svg')}}" alt="logo">
                    </a>
                </div>
            </div>
            <div class="footer_content_wrapper">
                <div class="footer_content_list">
                    <div class="footer_content_item">
                        <h4>Игрокам</h4>
                        <ul>
                            <li>
                                <a href="{{url('about-us')}}">О LANGAME</a>
                            </li>
                            <li>
                                <a href="{{url('contacts')}}">Обратная связь</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer_content_item">
                        <h4>Владельцам клубов</h4>
                        <ul>
                            <li>
                                <a href="{{url('personal/clubs')}}">Личный кабинет владельца</a>
                            </li>
                            <li>
                                <a href="{{url('register_club')}}">Как попасть на LANGAME</a>
                            </li>
                            <li>
                                <a href="{{url('software')}}">LANGAME Software</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <button type="button" class="report" data-remodal-target="report_modal">Сообщить об ошибке</button>
            @if(false)
            <button class="mailing" type="button" data-remodal-target="mailing_modal"></button>
            @endif
            <div class="social_wrapper">
                <div class="social_list">
                    <a href="https://vk.com/langameru" onclick="gtag('event', 'send', { 'event_category': 'vkontakte', 'event_action': 'click' });" target="_blank">
                        <img src="{{ asset('/img/icons/vk.svg')}}" alt="logo">
                    </a>
                    <a href="https://t.me/langameru" onclick="gtag('event', 'send', { 'event_category': 'telegram', 'event_action': 'click' });" target="_blank">
                        <img src="{{ asset('/img/icons/telegram.svg')}}" alt="logo">
                    </a>
                    @if(false)
                        <a href="#">
                            <img src="{{ asset('/img/icons/inst.svg')}}" alt="logo">
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="footer_rights_wrapper">
                <p>© ООО «Лангейм», 2021</p>
            </div>
            <div class="footer_site_info">
                <a href="{{url('policy')}}">Политика конфиденциальности</a>
                <a href="{{url('user-agreement')}}">Пользовательское соглашение</a>
            </div>
        </div>
    </div>
</footer>
<!--FOOTER END-->

<script>
    window.YANDEX_API_KEY = '{{env('YANDIX_MAPS_KEY','79ca1998-f254-447d-8081-bcd9647a8fb9')}}';
</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.1/remodal.min.js"
        integrity="sha512-a/KwXZUMuN0N2aqT/nuvYp6mg1zKg8OfvovbIlh4ByLw+BJ4sDrJwQM/iSOd567gx+yS0pQixA4EnxBlHgrL6A=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"
        integrity="sha512-5AcaBUUUU/lxSEeEcruOIghqABnXF8TWqdIDXBZ2SNEtrTGvD408W/ShtKZf0JNjQUfOiRBJP+yHk6Ab2eFw3Q=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
        integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.2/simplebar.min.js"
        integrity="sha512-t5ONTEmbf892tq6YhM2eSBdDALGVbnQgqSy5fez2Dki/raOHJxKuf1DWSyHs8qvXoNDg2aJ9RdukRj0lRspfAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/17.3.1/lazyload.min.js"
        integrity="sha512-lVcnjCLGjJTaZU55wD7H3f8SJVi6VV5cQRcmGuYcyIY607N/rzZGEl90lNgsiEhKygATryG/i6e5u2moDFs5kQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
<script src="https://www.google.com/recaptcha/api.js?hl=ru" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/mobile-detect@1.4.4/mobile-detect.min.js"></script>
<script src="{{ asset('/js/inputmask.js') }}"></script>
<script src="{{ asset('/js/dest/layout.js') }}?v={{ENV('JS_VERSION',0)}}"></script>
<script src="{{ asset('/js/main.js') }}?v={{ENV('JS_VERSION',0)}}"></script>
<script>
    $( document ).ready(function(){
        $(document).on('submit','#report-form',function(e){
            ym(82365286,'reachGoal','error');
            gtag('event', 'click', {'event_category': 'error', 'event_action': 'click'});
        })
    });
</script>
@if(Auth::guest())
    <script>
        $('#log-in-form-popup').submit(function(e) {
            e.preventDefault();
            ym(82365286, 'reachGoal', 'lk');
            gtag('event', 'send', {'event_category': 'lk', 'event_action': 'send'});
            let url = $(this).attr('action'),
                msgs = $(this).find('.logmsg'),
                form_groups = $(this).find('.form-group');
            msgs.empty();
            form_groups.removeClass('error');
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {
                    'phone': $(this).find('#log-in-phone-input').inputmask('unmaskedvalue'),
                    'password': $(this).find('#log-in-password-input').val(),
                    '_token': $(this).find('[name="_token"]').val()
                },
                success: function(data) {
                    location.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        msgs.append('<p class="error">' + value + '</p>');
                    });
                    form_groups.addClass('error');
                }
            });
        });
    </script>
@endif
@yield('scripts')
</body>
</html>
