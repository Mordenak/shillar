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
		if (auth()->user()->admin_level != 3)
			{
			return redirect()->action('HomeController@index');
			}
		$Users = User::all();

		return view('user.all', ['users' => $Users]);
		}

	public function edit($id)
		{
		if (auth()->user()->admin_level != 3)
			{
			return redirect()->action('HomeController@index');
			}
		return view('user.edit', ['user' => User::findOrFail($id)]);
		}

	public function save(Request $request)
		{
		if (auth()->user()->admin_level != 3)
			{
			return redirect()->action('HomeController@index');
			}
		$User = User::findOrFail($request->id);

		$User->admin_level = $request->admin_level;

		$User->save();

		return redirect()->action('UserController@edit', ['id' => $User->id]);
		}
}
