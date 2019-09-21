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

	public function welcome()
		{
		return view('welcome');
		}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
		{
		$Characters = Character::where('users_id', auth()->user()->id);
		return view('home', ['characters' => $Characters->get(), 'admin_level' => auth()->user()->admin_level]);
		}
}
