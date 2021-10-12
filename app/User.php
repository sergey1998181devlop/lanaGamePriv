<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use App\club;
use DB;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
//    use Notifiable,HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','user_position',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function clubs()
    {
        return $this->hasMany('App\club','user_id');
    }

    public function clubsPublished()
    {
        return $this->clubs()->whereNotNull('published_at');
    }
    public function clubsUnderEdit()
    {
        return $this->clubs()->UnderEdit();
    }
    public function clubsDraft()
    {
        return $this->clubs()->Draft();
    }
    public static function boot() {
        parent::boot();
        static::deleting(function($user) {
            $user->clubs()->each(function($club) {
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
                $club->forceDelete();
             });
             DB::table('sms_codes')->where('phone',$user->phone)->delete();
             DB::table('users_verify')->where('user_id',$user->id)->delete();
        });
    }
}
