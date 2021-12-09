<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('achievements')->insert([
            'id'=>1,
            'title' => "First Lesson Watched",
            'group' => "lesson",
            'number' => 1,
        ]);

        DB::table('achievements')->insert([
            'id'=>2,
            'title' => "5 Lessons Watched",
            'group' => "lesson",
            'number' => 5,
        ]);

        DB::table('achievements')->insert([
            'id'=>3,
            'title' => "10 Lessons Watched",
            'group' => "lesson",
            'number' => 10,
        ]);

        DB::table('achievements')->insert([
            'id'=>4,
            'title' => "25 Lessons Watched",
            'group' => "lesson",
            'number' => 25,
        ]);

        DB::table('achievements')->insert([
            'id'=>5,
            'title' => "50 Lessons Watched",
            'group' => "lesson",
            'number' => 50,
        ]);

        DB::table('achievements')->insert([
            'id'=>6,
            'title' => "First Comment Written",
            'group' => "comment",
            'number' => 1,
        ]);

        DB::table('achievements')->insert([
            'id'=>7,
            'title' => "3 Comments Written",
            'group' => "comment",
            'number' => 3,
        ]);

        DB::table('achievements')->insert([
            'id'=>8,
            'title' => "5 Comments Written",
            'group' => "comment",
            'number' => 5,
        ]);

        DB::table('achievements')->insert([
            'id'=>9,
            'title' => "10 Comment Written",
            'group' => "comment",
            'number' => 10,
        ]);

        DB::table('achievements')->insert([
            'id'=>10,
            'title' => "20 Comment Written",
            'group' => "comment",
            'number' => 20,
        ]);
    }
}
