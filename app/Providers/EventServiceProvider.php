<?php

namespace App\Providers;

use App\Events\BadgeUnlockedEvent;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listeners\AchievementUnlocked;
use App\Listeners\LessonAchievementUnlocked;
use App\Listeners\BadgeUnlocked;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            //
            AchievementUnlocked::class,
        ],
        LessonWatched::class => [
            //
            LessonAchievementUnlocked::class,
        ],
        BadgeUnlockedEvent::class => [
            //
            BadgeUnlocked::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
