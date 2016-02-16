<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Users;
use App\Models\Sets;

class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $set = new Set();
        $user = auth()->user();
        $followingIds = $user->followers()->lists('follows.follower_id');
        $followingIds->push($user->id);
        if(auth()->user()->isAdmin()) {
            $recommendedSets = $set->where('recommended', 1)->paginate(5);
        } else {
            $recommendedSets = $set->where('recommended', 1)->availableSets($followingIds, $user->id)->paginate(5);
        }
        $view->with('recommendedSets', $recommendedSets);
    }
}