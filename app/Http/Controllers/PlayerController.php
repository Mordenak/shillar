<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    //
    public function show($id)
    	{
    	return view('player.profile', ['player' => Player::findOrFail($id)]);
    	}
}
