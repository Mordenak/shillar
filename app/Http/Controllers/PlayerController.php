<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;

class PlayerController extends Controller
{
    //
    public function show($id)
    	{
    	return view('player.profile', ['player' => Player::findOrFail($id)]);	
    	}

    public function create()
    	{
    	return view('player.create');
    	}
}
