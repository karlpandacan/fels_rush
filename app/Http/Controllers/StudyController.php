<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Models\Activity;
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
        $setsIni = auth()
            ->user()
            ->studies()
            ->where('name', 'LIKE', '%'.$request->q.'%');
            if(isset($request->category) and $request->category != 'all') {
                $setsIni = $setsIni->where('category_id', $request->category);
            }
            $setsIni = $setsIni->with('words')->latest()->paginate(10);
        $sets = $setsIni;
        $learnedWords = auth()->user()->learnedWords()->count();
        $followers = auth()->user()->followees()->notAdmin()->count();
        $following = auth()->user()->followers()->notAdmin()->count();
        $followingIds = auth()->user()->followers()->lists('follows.follower_id');
        $followingIds->push(auth()->user()->id);
        $activitiesFollow = Activity::userIds($followingIds)->follow()->take(10)->latest()->get();
        $categories = Category::lists('name', 'id');
        $categories['all'] = 'All';
        return view('studies.index',[
            'sets' => $sets,
            'user' => auth()->user(),
            'wildcard' => $request->q,
            'selectedCategory' => $request->category,
            'followers' => $followers,
            'categories' => $categories,
            'following' => $following,
            'learnedWords' => $learnedWords,
            'activitiesFollow' => $activitiesFollow
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
