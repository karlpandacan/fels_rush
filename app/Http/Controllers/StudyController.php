<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Models\Activity;
use App\Models\Set;
use App\Models\Study;
use App\Http\Controllers\Controller;

class StudyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $learnedWords = $user->learnedWords()->count();
        $followers = $user->followees()->notAdmin()->count();
        $following = $user->followers()->notAdmin()->count();
        $followingIds = $user->followers()->lists('follows.follower_id');
        $followingIds->push($user->id);
        $followeeIds = $user->followeeIds()->lists('followee_id');
        $followeeIds->push($user->id);
        $activitiesFollow = Activity::userIds($followingIds)->follow()->take(10)->latest()->get();
        $categories = Category::lists('name', 'id');
        $categories['all'] = 'All';
        $recommendedSets = Set::where('recommended', 1)->with('user')->paginate(5);
        // Eloquent of sets
        $setsIni = $user->studies()
            ->availableSets($followingIds, $followeeIds, $user->id)
            ->where('name', 'LIKE', '%'.$request->q.'%');
        if(isset($request->category) and $request->category != 'all') {
            $setsIni = $setsIni->where('category_id', $request->category);
        }
        $setsIni = $setsIni
            ->latest()
            ->paginate(10);
        $sets = $setsIni;
        $sets->load('words', 'users');
        return view('studies.index',[
            'sets' => $sets,
            'user' => auth()->user(),
            'wildcard' => $request->q,
            'selectedCategory' => $request->category,
            'followers' => $followers,
            'categories' => $categories,
            'following' => $following,
            'learnedWords' => $learnedWords,
            'activitiesFollow' => $activitiesFollow,
            'followed_sets' => $user->getSetsFollowed()->toArray(),
            'recommendedSets' => $recommendedSets,
            'studyProgress' => $user->getStudyProgress()->with('words', 'users')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        auth()->user()->studies()->attach($request->sid);
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => auth()->user()->name . ' started studying set: ' . Set::find($request->sid)->name,
            'activity_type' => config('enums.activity_types.SET_FOLLOWED')
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->studies()->detach($id);
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => auth()->user()->name . ' stopped studying set: ' . Set::find($id)->name,
            'activity_type' => config('enums.activity_types.SET_FOLLOWED')
        ]);
        return redirect()->back();
    }
}
