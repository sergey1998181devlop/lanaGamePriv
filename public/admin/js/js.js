 
 
 if($( window ).width()< 769){
     $('.navbar-nav').addClass('toggled');
 }
 
 jQuery('input[type="tel"]').inputmask({
    mask: '+7 (999) 999-99-99',
    removeMaskOnSubmit: true,
    }
);