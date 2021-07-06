$(function() {
    var md = new MobileDetect(window.navigator.userAgent);
    if (md.mobile()){
        navigator.geolocation.getCurrentPosition(        
            function(position) {
                document.cookie = "lat=" + position.coords.latitude;
                document.cookie = "lon=" + position.coords.longitude;        
            },
            function(error) { 
                //доступ закрыт к координатам браузера. оставляем координаты от яндекса в куках
            }
        );
    }else{
        $(".club_distance").hide();
        $(".sort_by_options a").last().hide();
    }
});