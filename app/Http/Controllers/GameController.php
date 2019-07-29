<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\CharacterStats;
use App\Room;

class GameController extends Controller
{
    //
    public function index(Request $request)
    	{
    	// The request should have a character for us:
    	// die(print_r($request->all()));
    	// $Character = Character::findOrFail($request->character_id);
    	$Character = Character::where(['characters.id' => $request->character_id])
    		->join('character_stats', 'characters.id', '=', 'character_stats.characters_id')->first();
    		// ->select('character_stats.id as character_stats_id, *');

    	$Room = Room::findOrFail($Character->last_rooms_id);

    	// die(print_r($Character->playerrace()->name()))s;

    	// $CharacterStats = CharacterStats::where(['characters_id' => $Character->id])
    	// 	->join('character_stats', 'characters.id', '=', 'character_stats.character_id');

    	// $character = array_merge($Character->pluck(), $CharacterStats->pluck());

    	return view('game/main', ['character' => $Character, 'room' => $Room]);
    	}

    public function move(Request $request)
    	{
    	// Move the character:
    	// return $request->room_id;
    	// return $request->character_id;
    	// return "test";

    	$Character = Character::findOrFail($request->character_id);

    	// $Character->set(['last_rooms_id' => $request->room_id]);
    	$Character->last_rooms_id = $request->room_id;
    	$Character->save();

    	// return true;

    	$Character = Character::where(['characters.id' => $request->character_id])
    		->join('character_stats', 'characters.id', '=', 'character_stats.characters_id')->first();

    	$Room = Room::findOrFail($Character->last_rooms_id);

    	return view('game/main', ['character' => $Character, 'room' => $Room]);
    	}
}
