<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::factory()
            ->count(20)
            ->create();

        $users = User::factory()
            ->count(20)
            ->create();

        $comments = Comment::factory()
            ->count(20)
            ->create();
        $count= 50;
        while($count>0){
            $this->call([
                LessonSeeder::class,
            ]);
            $count=$count-1;
        }
        $this->call([
            AchievementSeeder::class,
        ]);

    }
}
