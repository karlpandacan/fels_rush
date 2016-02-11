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
        return view('sets.home', [
            'sets' => auth()->user()->sets()->with('words')->paginate(6),
            'followed_sets' => auth()->user()->getSetsFollowed()->toArray()
        ]);
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

    public function show()
    {

    }

    public function edit(Request $request, $set_id)
    {
        $set = auth()->user()->sets()->where('id', $set_id)->first();
        if($set == null) {
            return redirect()->back();
        }

        return view('sets.edit', [
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

        auth()->user()->sets()->find($id)->assignValues($request);
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
