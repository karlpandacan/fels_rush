<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Study;
use App\Models\Set;
use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $followingIds = $user->followers()->lists('follows.follower_id');
        $followingIds->push($user->id);
        $followeeIds = $user->followeeIds()->lists('followee_id');
        $followeeIds->push($user->id);
        if($user->isAdmin()){
            $activities = Activity::notFollow()->latest()->paginate(15);
            $activitiesFollow = Activity::follow()->take(10)->latest()->get();
            $recommendedSets = Set::where('recommended', 1)->simplePaginate(5);
        } else {
            $activities = Activity::userIds($followingIds)->notFollow()->latest()->paginate(15);
            $activitiesFollow = Activity::userIds($followingIds)->follow()->take(10)->latest()->get();
            $recommendedSets = Set::where('recommended', 1)
                ->availableSets($followingIds, $followeeIds, $user->id)
                ->simplePaginate(5);
        }

        $activities->load('user');
        $learnedWords = $user->learnedWords()->count();
        $followers = $user->followees()->notAdmin()->count();
        $following = $user->followers()->notAdmin()->count();
        return view('home')
            ->with('user', $user)
            // ->with('activities', $activities)
            ->with('followers', $followers)
            ->with('following', $following)
            ->with('learnedWords', $learnedWords)
            ->with('activitiesFollow', $activitiesFollow)
            ->with('followed_sets', $user->getSetsFollowed()->toArray())
            ->with('recommendedSets', $recommendedSets)
            ->with('studyProgress', $user->getStudyProgress()->get());
    }
}
