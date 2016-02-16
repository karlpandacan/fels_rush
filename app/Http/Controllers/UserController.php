<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Set;
use App\Models\Activity;
use App\Http\Requests\UserRequest;
use App\Http\Requests;
use Session;
use Exemption;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
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
    public function index()
    {
        return redirect('/users/search');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        try {
            $user = new User;
            $user->avatar = $user->uploadImage($request);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
        } catch (Exception $e) {
            session()->flash('flash_error', 'Adding of User failed.');
        }

        return redirect('/users/search');
    }

    public function show(User $user)
    {
        $activities = ($user->isAdmin() ? Activity::orderBy('id', 'desc') : $user->activities()->latest());
        $activities = $activities->paginate(15);

        $learnedWords = $user->learnedWords()->count();
        if (auth()->user()->id == $user->id) {
            $follow = 'self';
        } else {
            $follow = auth()->user()->followers()->where('follower_id',
                $user->id)->exists();
            $follow = $follow ? 'following' : 'not following';
        }

        $followers = $user->followees()->count();
        $following = $user->followers()->count();
        return view('users.view')
            ->with('activities', $activities)
            ->with('follow', $follow)
            ->with('user', $user)
            ->with('learnedWords', $learnedWords)
            ->with('followers', $followers)
            ->with('following', $following)
            ->with('followed_sets', $user->getSetsFollowed()->toArray())
            ->with('recommendedSets', Set::where('recommended', 1)->paginate(5));
    }

    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:255'
            ]);
            $user->avatar = $user->uploadImage($request);
            $user->name = $request->name;
            $user->save();
            session()->flash('flash_success', 'Update successful!');
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_error',
                'Update failed. The word you are trying to update cannot be found.');
        }

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            session()->flash('message_success', 'Delete successful!');
        } catch (ModelNotFoundException $e) {
            session()->flash('message_failed',
                'Delete failed. The word you are trying to delete cannot be found.');
        }
        return redirect('/users/search');
    }

    public function search(Request $request)
    {
        $wildcard = $request->q;
        if (!auth()->user()->isAdmin()) {
            $tab = isset($request->t) ? $request->t : 'NF';
            $user = auth()->user();
            $followingIds = $user->followers()->lists('follows.follower_id');
            $followingIds->push($user->id);
            $usersNotFollowing = User::ofNotIds($followingIds)->findUser($wildcard)->notAdmin()->get();
            $usersFollowing = $user->followers()->findUser($wildcard)->notAdmin()->get();
            $usersFollowers = $user->followees()->findUser($wildcard)->notAdmin()->get();
//            dd($usersFollowers->lists('id'));
            $learnedWords = $user->learnedWords()->count();
            $followers = $user->followees()->notAdmin()->count();
            $following = $user->followers()->notAdmin()->count();
            $activitiesFollow = Activity::userIds($followingIds)->follow()->take(10)->latest()->get();
            return view('users.search')
                ->with('tab', $tab)
                ->with('user', $user)
                ->with('followers', $followers)
                ->with('following', $following)
                ->with('learnedWords', $learnedWords)
                ->with('activitiesFollow', $activitiesFollow)
                ->with('usersFollowers', $usersFollowers)
                ->with('usersFollowing', $usersFollowing)
                ->with('usersNotFollowing', $usersNotFollowing)
                ->with('followed_sets', $user->getSetsFollowed()->toArray());
//                ->with('recommendedSets', Set::where('recommended', 1)->paginate(5));
        } else {
            $users = User::findUser($wildcard)->get();
            return view('users.search')
                ->with('users', $users);
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        try {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6'
            ]);
            $user->password = bcrypt($request->password);
            $user->save();
            session()->flash('flash_success', 'Update Password    successful!');
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_error',
                'Update Unsuccessful Please Try Again.');
        }
        return redirect()->back();
    }
}
