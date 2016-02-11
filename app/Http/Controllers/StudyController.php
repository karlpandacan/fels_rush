<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Models\Activity;
use App\Models\Set;
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
        $sets = Set::userFollowedSets($user)
            ->where('name', 'LIKE', '%'.$request->q.'%')
            ->paginate(15);
        // $sets = $user->studies()->where('name', 'LIKE', '%'.$request->q.'%')->paginate(15);
        $learnedWords = $user->learnedWords()->count();
        $followers = $user->followees()->notAdmin()->count();
        $following = $user->followers()->notAdmin()->count();
        $followingIds = $user->followers()->lists('follows.follower_id');
        $followingIds->push($user->id);
        $activitiesFollow = Activity::userIds($followingIds)->follow()->take(10)->latest()->get();
        $recommendedSets = Set::where('recommended', 1)->paginate(5);
        return view('studies.index',[
            'sets' => $sets,
            'user' => auth()->user(),
            'followers' => $followers,
            'following' => $following,
            'learnedWords' => $learnedWords,
            'activitiesFollow' => $activitiesFollow,
            'followed_sets' => $user->getSetsFollowed()->toArray(),
            'recommendedSets' => $recommendedSets
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
        return redirect()->back();
    }
}
