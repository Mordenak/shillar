<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;

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
    	// $Characters = Character::find(['users_id' => auth()->user()->id]);
    	// Other ways?
    	$Characters = Character::where('users_id', auth()->user()->id);
    	// die(print_r($Characters->get()));
        return view('home', ['characters' => $Characters->get()]);
    }
}
