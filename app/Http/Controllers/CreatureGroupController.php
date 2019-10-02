<?php

namespace App\Http\Controllers;

use Session;
use View;
use Illuminate\Http\Request;
use App\Creature;
use App\CreatureGroup;
use App\CreatureToCreatureGroup;
use App\SpawnRule;
use App\Zone;
use App\ZoneArea;

class CreatureGroupController extends Controller
	{
	public function create()
		{
		return view('creature_group.edit');
		}

	public function all(Request $request)
		{
		$creature_groups = CreatureGroup::all();
		return view('creature_group.all', ['creature_groups' => $creature_groups]);
		}

	public function edit($id)
		{
		// $zones = Zone::all();
		$CreatureGroup = CreatureGroup::findOrFail($id);
		// Remove?

		// $SpawnRules = SpawnRule::where(['creatures_id' => $Creature->id])->get();
		// $LootTables = LootTable::where(['creatures_id' => $Creature->id])->get();

		return view('creature_group.edit', ['creature_group' => $CreatureGroup]);
		}

	public function save(Request $request)
		{
		$CreatureGroup = new CreatureGroup;

		// die(print_r($request->all()));

		if ($request->id)
			{
			$CreatureGroup = CreatureGroup::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name,
			'description' => $request->description
			];

		$CreatureGroup->fill($values);
		$CreatureGroup->save();

		foreach ($request->creature_tables as $creature_entry)
			{
			$CreatureToCreatureGroup = new CreatureToCreatureGroup;

			if (isset($creature_entry['id']))
				{
				$CreatureToCreatureGroup = CreatureToCreatureGroup::findOrFail($creature_entry['id']);
				if (!$creature_entry['creatures_id'])
					{
					$CreatureToCreatureGroup->delete();
					continue;
					}
				}

			if (!$creature_entry['creatures_id'])
				{
				continue;
				}

			$values = [
				'creatures_id' => $creature_entry['creatures_id'],
				'weight' => $creature_entry['weight'],
				'creature_groups_id' => $CreatureGroup->id
				];

			$CreatureToCreatureGroup->fill($values);
			$CreatureToCreatureGroup->save();
			}

		foreach ($request->spawns as $spawn)
			{
			// die(print_r($spawn));
			$SpawnRule = new SpawnRule;

			if (isset($spawn['id']))
				{
				$SpawnRule = SpawnRule::findOrFail($spawn['id']);

				if (!$spawn['zones_id'] && !$spawn['rooms_id'])
					{
					$SpawnRule->delete();
					continue;
					}
				}

			if (!$spawn['zones_id'] && !$spawn['zone_areas_id'] && !$spawn['rooms_id'])
				{
				continue;
				}

			$values = [
				'zones_id' => $spawn['zones_id'],
				'zone_areas_id' => $spawn['zone_areas_id'],
				'zone_level' => $spawn['zone_level'],
				'rooms_id' => $spawn['rooms_id'],
				'creature_groups_id' => $CreatureGroup->id,
				];

			$SpawnRule->fill($values);
			$SpawnRule->save();
			}

		Session::flash('success', 'Creature Updated!');
		return redirect()->action('CreatureGroupController@edit', ['id' => $CreatureGroup->id]);
		}
	}