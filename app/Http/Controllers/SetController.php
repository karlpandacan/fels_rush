<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Set;
use App\Models\Category;
use Auth;
use Session;
use Config;

class SetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->isAdmin()) {
            return view('sets.admin-home', [
                'sets' => Set::with('user')->paginate(6)
            ]);
        } else {
            return view('sets.home', [
                'sets' => auth()->user()->sets()->with('words')->paginate(6),
                'followed_sets' => auth()->user()->getSetsFollowed()->toArray()
            ]);
        }
    }

    public function recommendedIndex()
    {
        $user = auth()->user();
        if(!$user->isAdmin()) {
            return view('sets.recommended', [
                'followed_sets' => $user->getSetsFollowed()->toArray(),
                'recommendedSets' => Set::where('recommended', 1)->with('user')->get()
            ]);
        }

        return view('sets.admin-recommended', [
            'sets' => Set::where('recommended', 0)->with('user')->get(),
            'recommendedSets' => Set::where('recommended', 1)->with('user')->get()
        ]);
    }

    public function recommendationStore($id)
    {
        Set::find($id)->update(['recommended' => 1]);
        return redirect()->back();
    }

    public function recommendationDestroy($id)
    {
        Set::find($id)->update(['recommended' => 0]);
        return redirect()->back();
    }

    public function create()
    {
        return view('sets.add', [
            'categories' => Category::first()->listCategories(),
            'visibilities' => config('enums.visibility_types')
        ]);
    }

    public function store(Request $request)
    {
        $set = new Set;
        $request->request->add(['user_id' => auth()->id()]);
        $set->assignValues($request);
        session()->flash('set_id', auth()->user()->sets()->lastUserInsert()->id);

        return redirect('questions/create');
    }

    public function show($id)
    {
        $set = Set::findOrFail($id);
        $user = auth()->user();
        $learnedWordsArr = $user->getLearnedWordsIds()->toArray();
        $learnedWords = $user->learnedWords()->count();
        $followers = $user->followees()->notAdmin()->count();
        $following = $user->followers()->notAdmin()->count();
        return view('sets.view')
            ->with('set', $set)
            ->with('user', $user)
            ->with('followers', $followers)
            ->with('following', $following)
            ->with('learnedWords', $learnedWords)
            ->with('learnedWordsArr', $learnedWordsArr);
    }

    public function edit(Request $request, $set_id)
    {
        $user = auth()->user();
        if($user->isAdmin()) {
            $set = Set::find($set_id);
        } else {
            $set = $user->sets()->where('id', $set_id)->first();
        }

        if($set == null) {
            return redirect()->back();
        }

        return view(($user->isAdmin() ? 'sets.admin-edit' : 'sets.edit'), [
            'users' => $user->getUserIds(),
            'categories' => Category::first()->listCategories(),
            'visibilities' => config('enums.visibility_types'),
            'set' => $set
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $request->request->add([
            'user_id' => $user->id,
            'set_id' => $id
        ]);

        Set::find($id)->assignValues($request);
        if(!$user->isAdmin()) {
            auth()->user()->sets->find($id)->assignValues($request);
        }

        return redirect('sets');
    }

    public function destroy(Request $request, $id)
    {
        auth()->user()->sets()->findOrFail($id)->delete();

        return redirect('sets');
    }

    public function search(Request $request)
    {
        $user = auth()->user();

        $learnedWords = $user->learnedWords()->count();
        $followers = $user->followees()->notAdmin()->count();
        $following = $user->followers()->notAdmin()->count();
        $followingIds = $user->followers()->lists('follows.follower_id');
        $followingIds->push($user->id);
        // Eloquent of sets
        $setsIni = Set::where('name', 'LIKE', '%'.$request->q.'%')->with('words');
        if(isset($request->category) and $request->category != 'all') {
            $setsIni = $setsIni->where('category_id', $request->category);
        }

        if($user->isAdmin()) {
            $setsIni = $setsIni
                ->latest()
                ->paginate(10);
        }else {
            $setsIni = $setsIni
                ->availableSets($followingIds, $user->id)
                ->latest()
                ->paginate(10);
        }

        $sets = $setsIni;
        $categories = Category::lists('name', 'id');
        $categories['all'] = 'All';
        return view('sets/search',[
            'sets' => $sets,
            'user' => $user,
            'followers' => $followers,
            'following' => $following,
            'learnedWords' => $learnedWords,
            'wildcard' => $request->q,
            'categories' => $categories,
            'followedSets' => $user->studies()->lists('sets.id')->toArray(),
            'selectedCategory' => $request->category
        ]);
    }
}
