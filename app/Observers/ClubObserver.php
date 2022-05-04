<?php

namespace App\Observers;

use App\club;
use App\User;
use Carbon\Carbon;

class ClubObserver
{
    /**
     * Handle the club "created" event.
     *
     * @param  \App\club  $club
     * @return void
     */
    public function created(club $club)
    {
        //
    }

    /**
     * Handle the club "updated" event.
     *
     * @param  \App\club  $club
     * @return void
     */
    public function updated(club $club)
    {

    }

    /**
     * Handle the club "updating" event.
     *
     * @param  \App\club  $club
     * @return void
     */
    public function updating(club $club){
        //при публикации клуба  - активирую автоматически акаунт пользователя
        if($club->published_at){
            User::where('id' , $club->user_id)->update([
                'email_verified_at' => Carbon::now()->toDateTimeString()
            ]);
        }
    }
    /**
     * Handle the club "deleted" event.
     *
     * @param  \App\club  $club
     * @return void
     */
    public function deleted(club $club)
    {
        //
    }

    /**
     * Handle the club "restored" event.
     *
     * @param  \App\club  $club
     * @return void
     */
    public function restored(club $club)
    {
        //
    }

    /**
     * Handle the club "force deleted" event.
     *
     * @param  \App\club  $club
     * @return void
     */
    public function forceDeleted(club $club)
    {
        //
    }
}
