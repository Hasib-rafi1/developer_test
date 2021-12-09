<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{

    // badges to get info
    public $badges= [
        0 => "Beginner",
        4 => "Intermediate",
        8 => "Advanced",
        10 => "Master"
    ];
    // final remaining value from next step
    public $remaining = 0;
    // By default the next badge is Intermediate. but will change later based on achievements
    public $next_badge = "Intermediate";

    public function index(User $user)
    {
        // unlocked achievements will be here in this variable from the magical function
        $unlocked_achievements = $this->unlocked_achievements($user);
        // next available achievements will be here in this variable from the magical function
        $next_available_achievements = $this->next_available_achievements($user);
        // number of achievement done by the user
        $totalAchivement = $user->achievementComments()->count() + $user->achievementLesson()->count();
        // magical function that will change the next badge status and remaining value
        $this->next_badge($totalAchivement);

        return response()->json([
            'unlocked_achievements' => $unlocked_achievements,
            'next_available_achievements' => $next_available_achievements,
            'current_badge' => $user->badge,
            'next_badge' => $this->next_badge,
            'remaing_to_unlock_next_badge' => $this->remaining
        ]);
    }

    //Return the unlocked list

    public function unlocked_achievements(User $user){
        // getting title of achievements from lesson completion
        $achievementLessons = $user->achievementLesson()->get(['title']);

        // an empty array i will return after filling it
        $stack = array();
        //filling the array with unlocked achievements from lesson completion
        foreach ($achievementLessons as $achievementLesson){

            array_push($stack, $achievementLesson->title);
        }
        // getting title of achievements from comments
        $achievementComments = $user->achievementComments()->get(['title']);
        //filling the array with unlocked achievements from comments done
        foreach ($achievementComments as $achievementComment){

            array_push($stack, $achievementComment->title);
        }
        return $stack;
    }

    // next available achievement
    public function next_available_achievements(User $user){
        // have and achievement table where achievement_id is listed sorted by the lesson and comments. from 1 to 5 is by lesson and 6 to 10 is grouped by comments

        // getting the last achievement id from the lesson group and adding 1 also checking if it is the last one making sure there is no next list
        $achievementLessons = $user->achievementLesson()->get(['achievement_id'])->last();
        if($achievementLessons){
            $achievementLessons = $achievementLessons->achievement_id +1  ;
        }else{
            $achievementLessons = 1;
        }
        $stack = array();
        if($achievementLessons<6){
            $nextAchievementLessons = Achievement::where('id', $achievementLessons)->first();

            array_push($stack, $nextAchievementLessons->title);
        }

        // getting the last achievement id from the comment group and adding 1 also checking if it is the last one making sure there is no next list
        $achievementComments = $user->achievementComments()->get(['achievement_id'])->last();
        if($achievementComments ){
            $achievementComments = $achievementComments->achievement_id +1  ;
        }else{
            $achievementComments = 6;
        }
        if($achievementLessons<11){
            $nextAchievementComments = Achievement::where('id', $achievementComments)->first();
            array_push($stack, $nextAchievementComments->title);
        }
        return $stack;
    }
    // setting the next badge status and remaining achievements
    public function next_badge($total){
        // checking the next badge and getting the remaining value
        foreach ($this->badges as $key => $node){
            if($key>$total){
                $this->next_badge = $node;
                $this->remaining = $key - $total;
                return;
            }
        }
        // I am a Master nothing is after me
        $this->next_badge = "";
        $this->remaining = 0 ;
    }
}
