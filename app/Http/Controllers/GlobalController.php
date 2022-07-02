<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDO;

class GlobalController extends Controller
{
    public function index()
    {
        return view("layouts.global");
    }

    public function bukuPanduan(){
        return view('frontend.buku-panduan');
    }
}
