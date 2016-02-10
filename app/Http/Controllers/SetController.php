<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Set;
use App\Models\Category;
use Auth;
use Session;

class SetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('sets.home', ['sets' => auth()->user()->sets]);
    }

    public function create()
    {
        return view('sets.add', ['categories' => Category::first()->listCategories()]);
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

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
