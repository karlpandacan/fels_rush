<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Set;
use App\Models\Category;
use App\Models\Activity;
use App\Models\Study;
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
        $user = auth()->user();
        $followingIds = $user->followers()->lists('follows.follower_id');
        $followingIds->push($user->id);
        $activities = Activity::notFollow()->latest()->paginate(15);
        $activities->load('user');
        $learnedWords = $user->learnedWords()->count();
        $followers = $user->followees()->notAdmin()->count();
        $following = $user->followers()->notAdmin()->count();
        if(auth()->user()->isAdmin()) {
            $recommendedSets = Set::where('recommended', 1)->paginate(5);
            $sets = Set::with('user')->paginate(20);
            return view('sets.admin-home', [
                'user' => $user,
                'activities' => $activities,
                'followers' => $followers,
                'following' => $following,
                'learnedWords' => $learnedWords,
                'recommendedSets' => $recommendedSets,
                'sets' => $sets
            ]);
        } else {
            $recommendedSets = Set::where('recommended', 1)->availableSets($followingIds, $user->id)->paginate(5);
            $sets = auth()->user()->sets()->with('words')->paginate(20);
            $sets->load('users');
            return view('sets.home', [
                'user' => $user,
                'activities' => $activities,
                'followers' => $followers,
                'following' => $following,
                'learnedWords' => $learnedWords,
                'recommendedSets' => $recommendedSets,
                'sets' => $sets,
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
        $user = auth()->user();
        return view($user->isAdmin() ? 'sets.admin-add' : 'sets.add', [
            'users' => $user->getUserIds(),
            'categories' => Category::first()->listCategories(),
            'visibilities' => config('enums.visibility_types'),
        ]);
    }

    public function store(Request $request)
    {
        $set = new Set;
        $request->request->add(['user_id' => auth()->id()]);
        $set->assignValues($request);
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => auth()->user()->name . ' created a set: ' . $request->input('set_name'),
            'activity_type' => config('enums.activity_types.SET_CREATED')
        ]);
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
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => auth()->user()->name . ' updated a set: ' . $request->input('set_name'),
            'activity_type' => config('enums.activity_types.SET_UPDATED')
        ]);

        return redirect('sets');
    }

    public function destroy(Request $request, $id)
    {
        $set = auth()->user()->sets()->findOrFail($id);
        $set->delete();
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => auth()->user()->name . ' deleted a set: ' . $set->name,
            'activity_type' => config('enums.activity_types.SET_DELETED')
        ]);

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
        if(!$user->isAdmin()) {
            $setsIni = $setsIni->availableSets($followingIds, $user->id);
        }
        if(isset($request->filter) and $request->filter != 'latest'){
            if($request->filter == 'pop') {
                $setsIni = $setsIni->where('name', 'LIKE', '%'.$request->q.'%')
                    ->leftJoin('studies', 'sets.id', '=', 'studies.set_id')
                    ->selectRaw('count(studies.set_id) as total, studies.*, sets.*')
                    ->groupBy('sets.id')
                    ->orderBy('total', 'desc');
            } else {
                $setsIni = $setsIni->where('recommended', 1)->latest();
            }
        } else {
            $setsIni = $setsIni->latest();
        }
        $setsIni = $setsIni
            ->paginate(20);

        $sets = $setsIni;
//        dd($sets);
        $categories = Category::lists('name', 'id');
        $categories['all'] = 'All Category';
        return view('sets/search',[
            'sets' => $sets,
            'user' => $user,
            'followers' => $followers,
            'following' => $following,
            'learnedWords' => $learnedWords,
            'wildcard' => $request->q,
            'categories' => $categories,
            'followedSets' => $user->studies()->lists('sets.id')->toArray(),
            'selectedCategory' => $request->category,
            'filter' => $request->filter
        ]);
    }
}
