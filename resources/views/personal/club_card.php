<?php

function echoCard($club,$type = 'published'){
    if($type == 'published'){
        $cart =  '<a href="'.url('clubs/'.$club->id.'/'.$club->url).'" class="club_card">';
    }else{
        $cart =  '<a class="club_card">';
    }
   $editForm = '
    <form action="'.url('personal/club/'.$club->id.'/edit').'" method="get">
        <button type="submit" class="club_edit">Редактировать</button>
    </form> ';
    $photo = ($club->main_preview_photo != null) ? $club->main_preview_photo  : asset('/img/default-club-preview-image.svg');
    $cart .=  '<div class="search_club_img_wrapper">
        <div class="search_club_img">
            <img src="'.$photo.'" alt="club">
        </div>';
        if($club->qty_vip_pc > 0 || $club->food_drinks =='1' || $club->alcohol =='1'){
        $cart .=  ' 
        <div class="club_services">';
           if($club->qty_vip_pc > 0)
            $cart .=  '  <img src="'.asset('/img/vip.svg').'" alt="icon">';
           if($club->food_drinks =='1')
            $cart .=  '  <img src="'.asset('/img/fastfood.svg').'" alt="icon">';
           if($club->alcohol =='1')
            $cart .=  '  <img src="'.asset('/img/drink.svg').'" alt="icon">';

       $cart .=  '  </div>';
        }
        if($club->marketing_event == '1'){
          $cart.= '<div class="club_promotion">
                    <span>Акция</span>
                </div>';
        }
        
    $cart .=  '</div>
            <div class="search_club_info">
                <div class="club_name">
                    <span>'.htmlspecialchars($club->club_name).'</span>
                </div>
                <div class="rating_wrapper">
                    <div class="rating_stars">
                        <img src="'.asset('/img/star.svg').'" alt="star">
                        <img src="'.asset('/img/star.svg').'" alt="star">
                        <img src="'.asset('/img/star.svg').'" alt="star">
                        <img src="'.asset('/img/star.svg').'" alt="star">
                        <img src="'.asset('/img/star0.svg').'" alt="star">
                    </div>
                    <div class="reviews_qty">
                        <span>47 отзывов</span>
                    </div>
                </div>';
                if($club->club_metro != null  && $club->metro != null){
                    $cart .=  '
                        <div class="club_subway_wrapper">
                            <div class="subway_img_wrapper" style="--subway-color: #'.$club->metro->color.'">
                                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-svg-subway"></use>
                                </svg>
                            </div>
                                <div class="subway_station">
                                    <span>'.$club->metro->name.'</span>
                                </div>
                        </div>';
                    }
                   
            $cart .=  '
                
                <div class="club_address_wrapper">
                    <div class="address_img_wrapper">
                        <img src="'.asset('/img/point-red.svg').'" alt="location">
                    </div>
                    <div class="club_address">
                    '.$club->club_address.'
                    </div>
                </div>';

                if($type == 'published'){
                    $hiddenProb = ($club->hidden_at == null) ? '' : 'checked';
                    $cart .=  ' <form action="'.url('personal/club/'.$club->id.'/toggle').'" method="get" class="hide-from-search-form">
                    <div class="checkbox_wrapper">
                        <label>
                            <input type="checkbox" name="hide_from_search" '.$hiddenProb.'>
                            <span class="activator"><span></span></span>
                            <span>Скрыть из поиска</span>
                        </label>
                    </div>
                </form>
                <div class="club_price_wrapper">
                    <div class="club_price"></div>
                    '.$editForm .'
                </div>';
                }elseif ($type == 'under_edit') {
                    $cart.= '<div class="club_status_wrapper">
                    <img src="'.asset('/img/time-slot.svg').'" alt="icon">
                    <span>На модерации</span>
                </div>
                <div class="club_price_wrapper">
                '.$editForm .'
                </div>';
                }elseif($type == 'draft'){
                    $cart .='<div class="club_status_wrapper">
                    <img src="'.asset('/img/draft.svg').'" alt="icon">
                    <span>Черновик</span>
                </div>
                <div class="club_price_wrapper">
                    <div class="club_price"></div>
                    '.$editForm .'
                </div>';
                }
                
                $cart .=  '</div>
                        </a>';
        echo $cart;

}


?>