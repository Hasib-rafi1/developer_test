<?php
namespace App\Listeners;

use App\Events\LessonWatched;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;


class LessonAchievementUnlocked
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
     * @param  LessonWatched $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        // Access the order using $event->order...
        $lesson = $event->lesson;
        $user = $event->user;

        $watched = $user->watched();
        $numberOfWatched = $watched->count();

        $achievement = DB::table('achievements')
            ->where('number', $numberOfWatched)
            ->where('group', 'lesson')
            ->first();
        if (!$achievement) {
            DB::table('achievement_users')->insert(
                ['user_id' => $user->getKey(), 'achievement_id' => $achievement->id, 'group' => $achievement->group]
            );
        }



    }
}
