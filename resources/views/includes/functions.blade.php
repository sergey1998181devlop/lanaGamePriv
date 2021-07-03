<?php
function admin($rules = 1){
 if(Auth::check()){
     if(Auth::user()->rules >= $rules )return true;
 }
 return false;
}
  function timelabe($oldtime,$iftime = true){
	$ru_month = array( '01'=>'янв', '02'=>'фев', '03'=>'мар', '04'=>'апр', '05'=>'май', '06'=>'июн', '07'=>'июл', '08'=>'авг', '09'=>'сен', '10'=>'окт', '11'=>'ноя','12'=> 'дек' );
    $current = strtotime(date("Y-m-d"));
    $oldtime1 = strtotime($oldtime);
    $datediff = $oldtime1 - $current;
     $difference = floor($datediff/(60*60*24));
     if ($iftime==true){
         $timestring=strtotime($oldtime);
         $timestring  = 'в '.date("h:i", $timestring);}else{
            $timestring="";
         }
     if($difference==0)
     {
        return 'сегодня '.$timestring;
     }
     else if($difference == 1)
     {
        return 'завтра '.$timestring;
     }
     else if($difference == -1)
     {
        return 'вчера '.$timestring;
     }
     else if($difference == -2)
     {
        return 'Два дня назад '.$timestring;
     }
     else{
		 $year=(date('Y',strtotime($oldtime )) != date('Y')) ? ' '.date('Y',strtotime($oldtime )) : "";
		 return  date("d", strtotime($oldtime)).' '.$ru_month[date("m", strtotime($oldtime))].$year.' '.$timestring;
        
     }
}
?>