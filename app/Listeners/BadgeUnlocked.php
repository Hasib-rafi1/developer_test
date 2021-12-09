<?php
namespace App\Listeners;

use App\Events\BadgeUnlockedEvent;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;


class BadgeUnlocked
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BadgeUnlockedEvent $event
     * @return void
     */
    public function handle(BadgeUnlockedEvent $event)
    {
        // Access the order using $event->order...
        $user = $event->user;


        $numberOfAchivement = $user->achievementComments()->count() + $user->achievementLesson()->count() ;


       $badge = "Beginner";
       if($numberOfAchivement ==4){
           $badge =  "Intermediate";
       }elseif ($numberOfAchivement ==8){
           $badge =  "Advanced";
       }elseif ($numberOfAchivement ==10){
           $badge =  "Master";
       }else{
           $badge = $user->badge;
       }
       $user->badge = $badge;

       $user->save();




    }
}
