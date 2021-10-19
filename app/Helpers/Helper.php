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
function cityApi($city){

    if($city != ''){
        $city = App\city::where('id',$city)->first();
        session()->put('city',$city);
        session()->save();
    }
     else{
        $city = App\city::where('en_name','moskva')->first();
         session()->put('city',$city);
         session()->save();
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
function canBeUnserialized($string) {
    if (@unserialize($string) === false) {
        return false;
    }
    return true;
}
function notVerifed(){
    if(Auth::check()){
        if(Auth::user()->email_verified_at != null )return false;
    }
    return true;
}
function jsonValidationException($errors = []){
    header('Content-type: application/json');
    \http_response_code(422);
    echo json_encode(['status'=>false,'errors'=>$errors]);
    exit();
}
function player(){
    if(!Auth::guest() && Auth::user()->type == App\User::USER_PLAYER){
        return true;
    }
    return false;
}
function owner(){
    if(!Auth::guest() && Auth::user()->type == App\User::USER_OWNER){
        return true;
    }
    return false;
}
?>
