<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Race;
use App\StatCost;
use App\RaceRacialModifier;
use App\RacialModifier;
use App\StartingStat;
use App\Gender;

class RaceController extends Controller
	{
	public function all(Request $request)
		{
		$races = Race::all();
		return view('race.all', ['races' => $races]);
		}

	public function create()
		{
		$RacialModifiers = RacialModifier::all();
		return view('race.edit', ['racial_modifiers' => $RacialModifiers]);
		}

	public function edit($id)
		{
		// $StatCosts = StatCosts::where(['races_id' => ])
		$Race = Race::findOrFail($id);

		$RacialModifiers = RacialModifier::all();

		// die(print_r($Race->stat_costs()->get()));
		// die(print_r($Race->modifiers()->get()));

		return view('race.edit', ['race' => Race::findOrFail($id), 'male_costs' => $Race->stat_costs()->where('genders_id', 1)->first(), 'female_costs' => $Race->stat_costs()->where('genders_id', 2)->first() , 'starting_stats' => $Race->starting_stats()->first(), 'racial_modifiers' => $RacialModifiers, 'modifiers' => $Race->modifiers()->get()]);
		}

	public function save(Request $request)
		{
		$Race = new Race;

		if ($request->id)
			{
			$Race = Race::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name
			];

		$Race->fill($values);
		$Race->save();

		// die(print_r($_REQUEST));

		// Starting Stats:
		$StartingStat = new StartingStat;

		if ($request->id)
			{
			$StartingStat = $Race->starting_stats()->first();
			}

		$starting_values = [
			'races_id' => $Race->id,
			'strength' => $request->starting_strength,
			'dexterity' => $request->starting_dexterity,
			'constitution' => $request->starting_constitution,
			'wisdom' => $request->starting_wisdom,
			'intelligence' => $request->starting_intelligence,
			'charisma' => $request->starting_charisma,
			];

		$StartingStat->fill($starting_values);
		$StartingStat->save();

		// Stat Costs:
		$Genders = Gender::all();

		foreach ($Genders as $Gender)
			{
			$StatCost = new StatCost;

			if ($request->id)
				{
				$StatCost = $Race->stat_costs()->where('genders_id', $Gender->id)->first();
				}

			$stat_values = [
				'races_id' => $Race->id,
				'genders_id' => $Gender->id,
				'strength_cost' => $request->strength_cost[$Gender->id],
				'dexterity_cost' => $request->dexterity_cost[$Gender->id],
				'constitution_cost' => $request->constitution_cost[$Gender->id],
				'wisdom_cost' => $request->wisdom_cost[$Gender->id],
				'intelligence_cost' => $request->intelligence_cost[$Gender->id],
				'charisma_cost' => $request->charisma_cost[$Gender->id],
				];

			$StatCost->fill($stat_values);
			$StatCost->save();
			}

		foreach ($request->racial_modifiers as $racial_modifier)
			{
			$RaceRacialModifier = new RaceRacialModifier;

			if (isset($racial_modifier['id']))
				{
				$RaceRacialModifier = $RaceRacialModifier::findOrFail($racial_modifier['id']);

				if ($racial_modifier['racial_modifiers_id'] == 'null' && !$racial_modifier['value'])
					{
					$RaceRacialModifier->delete();
					continue;
					}				
				}

			if ($racial_modifier['racial_modifiers_id'] == 'null')
				{
				continue;
				}

			$values = [
				'races_id' => $Race->id,
				'racial_modifiers_id' => $racial_modifier['racial_modifiers_id'],
				'value' => $racial_modifier['value']
				];

			$RaceRacialModifier->fill($values);
			$RaceRacialModifier->save();
			}

		Session::flash('success', 'Race Upodated!');
		return redirect()->action('RaceController@edit', ['id' => $Race->id]);
		}

	public function delete(Request $request)
		{
		$Race = Race::findOrFail($request->id);
		$Race->delete();
		Session::flash('success', 'Race Deleted!');
		return redirect()->action('RaceController@all');
		}
	}