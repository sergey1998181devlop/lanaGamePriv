<?php


function city($all = false){
    if(session()->get('city')!=null){
        if($all) return session()->get('city');
        return session()->get('city')['en_name'];
    }
     else{
        $city = App\city::where('en_name','moskva')->first();
         session()->put('city',$city);
         session()->save();
        if($all) return $city;
         return $city->en_name;
     }
}


if(!function_exists('notReq')){
    function notReq($input){
        if(!isset($input) || empty($input)  ){
            return $input='';
        }
        else{return $input;}
    }
}

?>
