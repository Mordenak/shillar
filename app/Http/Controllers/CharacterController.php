<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\PlayerClass;
use App\PlayerRace;
use App\Wallet;
use App\Equipment;
use App\Inventory;
use App\StartingStat;
use Session;

class CharacterController extends Controller
{
	public function show($id)
		{
		return view('character.profile', ['character' => Character::findOrFail($id)]);
		}

	public function create()
		{	
		return view('character.create', ['races' => PlayerRace::where('gender', '=', 'Male')->orderby('name')->get()]);
		}

	public function all()
		{
		// admin command:
		$Characters = Character::all();

		return view('character.all', ['characters' => $Characters]);
		}

	public function edit($id)
		{
		return view('character.edit', ['character' => Character::findOrFail($id)]);
		}

	public function save(Request $request)
		{
		// Do something
		// die(print_r($request->all()));

		// die(print_r(auth()->user()->id));

		if ($request->id)
			{
			$Character = Character::findOrFail($request->id);
			$values = [
				'name' => $request->name,
				'player_races_id' => $request->player_races_id,
				'last_rooms_id' => $request->last_rooms_id,
				'health' => $request->health,
				'mana' => $request->mana,
				'fatigue' => $request->fatigue,
				'xp' => $request->xp,
				'gold' => $request->gold,
				'bank' => $request->bank,
				'strength' => $request->strength,
				'dexterity' => $request->dexterity,
				'constitution' => $request->constitution,
				'wisdom' => $request->wisdom,
				'intelligence' => $request->intelligence,
				'charisma' => $request->charisma
				];
			// $NpcStat->fill($stat_values);
			$Character->fill($values);
			$Character->save();

			$Character->calcQuickStats();
			$Character->refreshScore();

			Session::flash('success', 'Character Updated!');
			return $this->edit($Character->id);
			}
		else
			{
			$Character = new Character;

			$selected_race = $request->selected_race;
			if ($request->selected_gender == 'female')
				{
				$selected_race = $selected_race + 17;
				}

			$values = [
				'users_id' => auth()->user()->id,
				'player_races_id' => $selected_race,
				'name' => $request->name,
				'last_rooms_id' => 1,
				'xp' => 0,
				'gold' => 0,
				'bank' => 0,
				'health' => 0,
				'max_health' => 0,
				'mana' => 0,
				'max_mana' => 0,
				'fatigue' => 0,
				'max_fatigue' => 0,
				];

			$StartingStat = StartingStat::where(['player_races_id' => $request->selected_race])->first();

			if ($StartingStat)
				{
				$values['strength'] = $StartingStat->strength;
				$values['dexterity'] = $StartingStat->dexterity;
				$values['constitution'] = $StartingStat->constitution;
				$values['wisdom'] = $StartingStat->wisdom;
				$values['intelligence'] = $StartingStat->intelligence;
				$values['charisma'] = $StartingStat->charisma;
				}

			// Get bonus stats:
			$values[$request->bonus_stats_1] = $values[$request->bonus_stats_1] + 5;
			$values[$request->bonus_stats_2] = $values[$request->bonus_stats_2] + 5;
			$values[$request->bonus_stats_3] = $values[$request->bonus_stats_3] + 5;
			$values[$request->bonus_stats_4] = $values[$request->bonus_stats_4] + 5;
			$values[$request->bonus_stats_5] = $values[$request->bonus_stats_5] + 5;
			$values[$request->bonus_stats_6] = $values[$request->bonus_stats_6] + 5;

			$values['score'] = $values['strength'] + $values['dexterity'] + $values['constitution'] + $values['wisdom'] + $values['intelligence'] + $values['charisma'];

			$health_calc = $values['strength'] + $values['constitution'] + $values['dexterity'];
			$values['health'] = $health_calc;
			$values['max_health']= $health_calc;
			$mana_calc = $values['wisdom'] + $values['intelligence'] + $values['charisma'];
			$values['mana'] = $mana_calc;
			$values['max_mana'] = $mana_calc;
			$fatigue_calc = $values['dexterity'] + $values['constitution'] + $values['wisdom'];
			$values['fatigue'] = $fatigue_calc;
			$values['max_fatigue'] = $fatigue_calc;

			$Character->fill($values);
			$Character->save();

			$Equipment = new Equipment;
			$Equipment->fill(['characters_id' => $Character->id]);
			$Equipment->save();

			$Inventory = new Inventory;
			$Inventory->fill(['characters_id' => $Character->id, 'max_size' => 100, 'max_weight' => 100]);
			$Inventory->save();

			$Characters = Character::where('users_id', auth()->user()->id);
			// die(print_r($Characters->get()));
			return view('home', ['characters' => $Characters->get()]);
			}
		}
}
