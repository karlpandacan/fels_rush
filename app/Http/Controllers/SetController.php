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
        Session::flash('set_id', auth()->user()->sets->last()->id);

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
        $request->request->add([
            'user_id' => auth()->id(),
            'set_id' => $id
        ]);

        Set::find($id)->assignValues($request);
        Session::flash('set_id', auth()->user()->sets->last()->id);

        return redirect('sets');
        // return redirect('questions/create');
    }

    public function destroy(Request $request, $id)
    {
        auth()->user()->sets()->findOrFail($id)->delete();

        return redirect('sets');
    }
}
