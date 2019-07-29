<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\PlayerClass;
use App\PlayerRace;
use App\CharacterStats;

class CharacterController extends Controller
{
	public function show($id)
		{
		return view('character.profile', ['character' => Character::findOrFail($id)]);	
		}

	public function create()
		{	
		return view('character.create', ['classes' => PlayerClass::all(), 'races' => PlayerRace::all()]);
		}

	public function save(Request $request)
		{
		// Do something
		// die(print_r($request->all()));

		// die(print_r(auth()->user()->id));

		$Character = new Character;

		$Character->users_id = auth()->user()->id;
		$Character->name = $request->character_name;
		$Character->player_races_id = $request->selected_race;
		$Character->player_classes_id = $request->selected_class;
		$Character->last_rooms_id = 1;
		$Character->save();

		// Create a stats entry as well:

		$values = [
			'characters_id' => $Character->id,
			'level' => 1,
			'xp' => 0,
			'health' => 10,
			'max_health' => 10,
			'mana' => 5,
			'max_mana' => 5,
			'ward' => 0,
			'max_ward' => 0,
			'strength' => 1,
			'dexterity' => 1,
			'intelligence' => 1,
			'vitality' => 1,
			'guard' => 1,
			'wisdom' => 1,
			'brute' => 1,
			'finesse' => 1,
			'insight' => 1
			];

		$CharacterStats = new CharacterStats;
		$CharacterStats->fill($values);
		$CharacterStats->save();

		// $validator = Validator::make($request->all(), [
		// 		'name' => 'required'
		// 	]);

		// if ($validator->fails())
		// 	{
		// 	return redirect('/home')->withInput()->withErrors($validator);
		// 	}
		// return true;
		// return view('home');

		// $Characters = Character::find(['users_id' => auth()->user()->id]);
    	// Other ways?
    	$Characters = Character::where('users_id', auth()->user()->id);
    	// die(print_r($Characters->get()));
        return view('home', ['characters' => $Characters->get()]);
		}
}
