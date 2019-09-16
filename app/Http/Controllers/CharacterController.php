<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\CharacterSetting;
use App\Race;
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
		return view('character.create', ['races' => Race::where('gender', '=', 'Male')->orderby('name')->get()]);
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
		if ($request->id)
			{
			$Character = Character::findOrFail($request->id);
			$values = [
				'name' => $request->name,
				'races_id' => $request->races_id,
				'alignments_id' => $request->alignments_id,
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
			// $CreatureStat->fill($stat_values);
			$Character->fill($values);
			$Character->save();

			$Character->calc_quick_stats();
			$Character->refresh_score();

			Session::flash('success', 'Character Updated!');
			return $this->edit($Character->id);
			}
		else
			{
			if (!$request->name)
				{
				Session::flash('create_failed', 'Please enter a character name...');
				return $this->create();	
				}
			if (Character::where(['name' => $request->name])->count() > 0)
				{
				Session::flash('create_failed', 'This character name is already taken, please choose another.');
				return $this->create();
				}

			$Character = new Character;

			$selected_race = $request->selected_race;
			if ($request->selected_gender == 'female')
				{
				$selected_race = $selected_race + 17;
				}

			$values = [
				'users_id' => auth()->user()->id,
				'races_id' => $selected_race,
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

			$StartingStat = StartingStat::where(['races_id' => $request->selected_race])->first();

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
			$Inventory->fill(['characters_id' => $Character->id]);
			$Inventory->save();

			// Creating a settings entry:
			$CharacterSetting = new CharacterSetting;
			$CharacterSetting->characters_id = $Character->id;
			$CharacterSetting->save();

			$Characters = Character::where('users_id', auth()->user()->id);
			// die(print_r($Characters->get()));
			// return view('home', ['characters' => $Characters->get()]);
			return redirect()->action('HomeController@index');
			}
		}

	public function update_settings(Request $request)
		{
		$Character = Character::findOrFail($request->character_id);

		$new_values = [
			'refresh_rate' => $request->refresh_rate,
			'brief_mode' => $request->brief_mode == '1' ? true : false,
			'life_gauge' => $request->life_gauge == '1' ? true : false,
			'mana_gauge' => $request->mana_gauge == '1' ? true : false,
			'fatigue_gauge' => $request->fatigue_gauge == '1' ? true : false,
			'food_sort' => $request->food_sort,
			'number_commas' => $request->number_commas == '1' ? true : false,
			'creature_images' => $request->creature_images == '1' ? true : false
			];

		// $Character->settings()->fill($new_values);
		// $Character->settings()->save();
		$CharacterSetting = CharacterSetting::where(['characters_id' => $Character->id])->first();
		$CharacterSetting->fill($new_values);
		$CharacterSetting->save();

		Session::flash('settings', 'Settings updated!');

		return view('character.settings', ['character' => $Character, 'settings' => $CharacterSetting->fresh()]);
		}
	}
