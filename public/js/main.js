navigator.geolocation.getCurrentPosition(
    function(position) {
        document.cookie = "lat=" + position.coords.latitude;
        document.cookie = "lon=" + position.coords.longitude;        
    },
    function(error) { 
        //доступ закрыт к координатам браузера. оставляем координаты от яндекса в куках
    }
);