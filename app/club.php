<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
class club extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lastAdminEdit()
    {
        return $this->belongsTo(User::class,'last_admin_edit');
    }
    public function whoUnPublished()
    {
        return $this->belongsTo(User::class,'unpublished_by');
    }
    public function comments()
    {
        return $this->hasMany(comment::class)->orderBy('created_at','DESC');;
    }


    public function scopeSelectCartFeilds($query)
    {
        return $query->select('id','lat','lon','club_name','marketing_event','url','club_metro','club_address','qty_vip_pc','food_drinks','alcohol','hidden_at','main_preview_photo','rating');
    }
    public function scopeSelectCartFeilds4Home($query, $lat, $lon)
    {
        return $query->select('id','lat','lon','club_name','club_city','marketing_event','url','club_metro','club_address','qty_vip_pc','food_drinks','alcohol','qty_pc','qty_vr','main_preview_photo','rating','qty_simulator','qty_console','club_min_price','work_time','work_time_days', club::raw('round(1.6 * ( 3959 * acos( cos( radians("'.$lat.'") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians("'.$lon.'") ) + sin( radians("'.$lat.'") ) * sin( radians( lat ) ) ) ),1) AS nearby'));
    }
    public function scopeCorrentUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
    public function scopeDraft($query)
    {
        return $query->where('draft', '1');
    }
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }
    public function scopeUnderEdit($query)
    {
        return $query->where('draft', '0')->whereNull('published_at');
    }

    public function scopeHidded($query)
    {
        return $query->where('draft', '0')->whereNull('published_at')->whereNotNull('unpublished_at');
    }
    
    public function scopeCorrentCity($query)
    {
        return $query->where('club_city', city(true)['id']);
    }

    public function city()
    {
        return $this->belongsTo('App\city','club_city');
    }
    public function metro()
    {
        return $this->belongsTo(metro::class,'club_metro');
    }
    public static function boot() {
        parent::boot();
        static::deleting(function($club) {
            if($club->club_price_file!=''){
                $path_to_file = explode('storage/',$club->club_price_file);
                if(isset($path_to_file[1])){
                    $path_to_file = $path_to_file[1];
                    if(file_exists(storage_path('app/public/'.$path_to_file))){
                        unlink(storage_path('app/public/'.$path_to_file));}
                }
             }
             if($club->club_photos!=''){
                 $images = explode(',',$club->club_photos);
                foreach($images as $link){
                    $path_to_file = explode('storage/',$link);
                        if(isset($path_to_file[1])){
                            $path_to_file = $path_to_file[1];
                            if(file_exists(storage_path('app/public/'.$path_to_file))){
                                unlink(storage_path('app/public/'.$path_to_file));
                            }
                        }
                }
             }
        }
    );
    }
}
