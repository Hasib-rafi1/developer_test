<?php
namespace App\Listeners;

use App\Events\CommentWritten;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;


class AchievementUnlocked
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
     * @param  \App\Events\CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event)
    {
        // Access the order using $event->order...
        $comment = $event->comment;
        $user = $comment->user();

        $comments = $user->comments();
        $numberOfComments = $comments->count();

        $achievement = DB::table('achievements')
            ->where('number', $numberOfComments)
            ->where('group', 'comment')
            ->first();
        if (!$achievement) {
            DB::table('achievement_users')->insert(
                ['user_id' => $user->id, 'achievement_id' => $achievement->id, 'group' => $achievement->group]
            );
        }



    }
}
