<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class club extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(comment::class)->orderBy('created_at','DESC');;
    }

    
    public function scopeSelectCartFeilds($query)
    {
        return $query->select('id','club_name','marketing_event','url','club_metro','club_address','qty_vip_pc','food_drinks','alcohol','hidden_at','main_preview_photo');
    }
    public function scopeSelectCartFeilds4Home($query)
    {
        return $query->select('id','club_name','marketing_event','url','club_metro','club_address','qty_vip_pc','food_drinks','alcohol','qty_pc','qty_vr','main_preview_photo','qty_simulator','qty_console','club_min_price');
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
}
