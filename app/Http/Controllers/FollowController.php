<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Http\Controllers\Controller;

class FollowController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        auth()->user()->followers()->attach($request->uid);
        $followedUser = User::findOrFail($request->uid);
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => auth()->user()->name . ' Followed ' . $followedUser->name,
            'activity_type' => 'followed_user'
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->followers()->detach($id);
        $unfollowedUser = User::findOrFail($id);
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => auth()->user()->name . ' Unfollowed ' . $unfollowedUser->name,
            'activity_type' => 'unfollowed_user'
        ]);

        return redirect()->back();
    }
}
