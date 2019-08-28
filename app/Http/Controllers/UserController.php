<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	public function show($id)
		{
		return view('user.profile', ['user' => Character::findOrFail($id)]);
		}

	public function create()
		{	
		return view('user.create');
		}

	public function all()
		{
		// admin command:
		$Users = User::all();

		return view('user.all', ['users' => $Users]);
		}

	public function edit($id)
		{
		return view('user.edit', ['user' => User::findOrFail($id)]);
		}

	public function save(Request $request)
		{

		}
}
