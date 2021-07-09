$(function() {
    geo();
});
function geo(){
    var md = new MobileDetect(window.navigator.userAgent);
    if (md.mobile()){
        navigator.geolocation.getCurrentPosition(        
            function(position) {
                document.cookie = "lat=" + position.coords.latitude;
                document.cookie = "lon=" + position.coords.longitude;    
                $(".club_distance").css("display", "flex");    
            },
            function(error) { 
                //доступ закрыт к координатам браузера. оставляем координаты от яндекса в куках
                $(".sort_by_options a").last().on("click", function(){
                    if (!getCookie('show_geo_alert')) {
                        document.cookie = "show_geo_alert=1";
                        $("a[data-remodal-target=get_geo]").click();
                        $(".get_geo .remodal-close").on("click", function (){                          
                            window.location.href = $(".sort_by_options a").last().attr("href");
                        });
                        return false;
                    }else{
                        return true;
                    }
                });
            }            
        );
        $(".club_distance").css("display", "flex");
        $(".sort_by_options a").last().show();
    }
}
function getCookie(name) {

    var matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ))
    return matches ? decodeURIComponent(matches[1]) : undefined
}