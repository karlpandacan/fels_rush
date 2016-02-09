<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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
        $followedUser = auth()->user()->find($request->uid)->first();
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => 'Followed ' . $followedUser->name . ' with email ' . $followedUser->email,
            'activity_type' => config()->get('activity_type.FOLLOWED_USER')
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
        $unfollowedUser = auth()->user()->find($id)->first();
        auth()->user()->activities()->create([
            'lesson_id' => 0,
            'content'   => 'Unfollowed ' . $unfollowedUser->name . ' with email ' . $unfollowedUser->email,
            'activity_type' => config()->get('activity_type.FOLLOWED_USER')
        ]);

        return redirect()->back();
    }
}
