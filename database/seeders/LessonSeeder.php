<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('lesson_user')->insert([
            'user_id' => User::select('id')->orderByRaw("RAND()")->first()->id,
            'lesson_id' => Lesson::select('id')->orderByRaw("RAND()")->first()->id,
            'watched' => rand(0, 1) == 1,
        ]);
    }
}
