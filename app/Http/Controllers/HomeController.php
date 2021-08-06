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
		$this->middleware('guest');
		}

	public function welcome()
		{

		return view('welcome');
		}
	}
