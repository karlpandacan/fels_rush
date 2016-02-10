<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Set;
use Auth;

class SetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('sets.home');
    }

    public function create()
    {
        return view('sets.add');
    }

    public function store(Request $request)
    {
        return dd(auth()->user()->sets()->assignValues($request));
        auth()->user()->sets->assignValues($request);
        return redirect('sets');
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
