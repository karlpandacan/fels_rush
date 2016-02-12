<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Word;
use App\Models\Category;
use App\Models\LearnedWord;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use Auth;

class WordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = [];

        if(Category::first() != null) {
            $categories = Category::first()->listCategories();
        }

        return view('words.home', [
            'words' => Word::paginate(20),
            'categories' => $categories,
            'status' => 'all',
            'category_id' => '1'
        ]);
    }

    public function create()
    {
        session()->keep('set_id');
        return view('words.add', [
            'categories' => Category::first()->listCategories()
        ]);
    }

    public function store(Request $request)
    {
        $setId = $request->input('set_id');

        try {
            Word::storeWords($request, $setId);
            session()->flash('flash_success', 'Adding of word successful!');
        } catch (Exception $e) {
            session()->flash('flash_error', 'Adding of word failed.');
        }

        return redirect('sets');
    }

    public function show()
    {

    }

    public function edit($id)
    {
        try {
            $word = Word::findOrFail($id);
            return view('words.edit',
                ['word' => $word, 'categories' => Category::first()->listCategories()]);
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_error',
                'Edit failed. The word you are trying to edit cannot be found.');
        }

        return redirect('/words');
    }

    public function update(Request $request, $setId)
    {
        try {
            Word::where('set_id', $setId)->delete();
            Word::storeWords($request, $setId);
            session()->flash('flash_success', 'Update successful!');
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_error',
                'Update failed. The word you are trying to update cannot be found.');
        }

        return redirect('/sets');
    }

    public function destroy($id)
    {
        try {
            $word = Word::findOrFail($id)->delete();
            session()->flash('flash_success', 'Delete successful!');
        } catch (ModelNotFoundException $e) {
            session()->flash('flash_error',
                'Delete failed. The word you are trying to delete cannot be found.');
        }

        return redirect()->back();
    }

    public function search(Request $request)
    {
        if(!empty($request->input('category')))  {
            $category = Category::findOrFail($request->input('category'));
        } else {
            $category = Category::first();
        }

        switch($request->input('status')) {
            case 1:
                $words = $category->words()->userLearnedWords(auth()->user())
                ->selectWords()->paginate(20);
                break;

            case 2:
                $words = $category->words()->userUnlearnedWords(auth()->user())
                ->selectWords()->paginate(20);
                break;

            default: // Default is all words
                $words = $category->words()->selectWords()->paginate(20);
                break;
        }

        return view('words.home', [
            'words' => $words,
            'categories' => $category->listCategories(),
            'status' => $request->input('status'),
            'category_id' => $category->id
        ]);
    }
}
