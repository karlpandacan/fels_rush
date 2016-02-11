<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\LessonWord;

class LearnedWordController extends Controller
{
    public function store(Request $request)
    {
        auth()->user()->learnedWords()->create(['word_id' => $request->id]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        auth()->user()->learnedWords()->where('word_id', $id)->first()->delete();
        return redirect()->back();
    }
}
