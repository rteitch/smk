<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // fungsi untuk mengubah status login user ke on
        $id = Auth::user()->id;
        if (Auth::check()) {
            $user = \App\Models\User::find($id);
            $user->status = "on";
            $user->save();
        }

        return view('backend.home');
    }
}
