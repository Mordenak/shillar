<?php

namespace App\Http\Controllers;

use Session;
use View;
use Illuminate\Http\Request;
use App\Npc;
use App\NpcStat;
use App\RewardTable;
use App\SpawnRule;
use App\LootTable;
use App\Zone;
use App\Item;

class NpcController extends Controller
	{
	public function create()
		{
		// TODO: Fix this repeat:
		$zones = Zone::all();
		$items = Item::all();
		return view('npc.edit', ['zones' => $zones, 'items' => $items]);
		}

	public function all(Request $request)
		{
		$npcs = Npc::all();
		return view('npc.all', ['npcs' => $npcs]);
		}

	public function edit($id)
		{
		// $zones = Zone::all();
		$Npc = Npc::findOrFail($id);
		// Remove?
		$zones = Zone::all();
		$items = Item::all();

		$SpawnRules = SpawnRule::where(['npcs_id' => $Npc->id])->get();
		$LootTables = LootTable::where(['npcs_id' => $Npc->id])->get();

		return view('npc.edit', ['npc' => $Npc, 'spawn_rules' => $SpawnRules, 'loot_tables' => $LootTables, 'zones' => $zones, 'items' => $items]);
		}

	public function save(Request $request)
		{
		$Npc = new Npc;

		// die(print_r($request->all()));

		if ($request->id)
			{
			$Npc = Npc::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name,
			'img_src' => $request->img_src,
			'is_hostile' => isset($request->is_hostile) ? true : false,
			'health' => $request->health,
			'armor' => $request->armor,
			'damage_low' => $request->damage_low,
			'damage_high' => $request->damage_high,
			'attacks_per_round' => $request->attacks_per_round,
			'award_xp' => $request->award_xp,
			'xp_variation' => $request->xp_variation,
			'award_gold' => $request->award_gold,
			'gold_variation' => $request->gold_variation,
			];

		$Npc->fill($values);
		$Npc->save();

		// die(print_r($request->all()));
		// die(print_r($request->spawns));

		foreach ($request->spawns as $spawn)
			{
			// die(print_r($spawn));
			$SpawnRule = new SpawnRule;

			if (isset($spawn['id']))
				{
				$SpawnRule = SpawnRule::findOrFail($spawn['id']);

				if ($spawn['zone_id'] == 'null' && !$spawn['room_id'] && !$spawn['chance'])
					{
					$SpawnRule->delete();
					continue;
					}
				}

			if (!$spawn['chance'])
				{
				continue;
				}

			$zone = null;
			if (isset($spawn['zone_id']) && $spawn['zone_id'] != 'null')
				{
				$zone = $spawn['zone_id'];
				}

			$room = null;
			if (isset($spawn['room_id']) && $spawn['room_id'] != 'null')
				{
				$room = $spawn['room_id'];
				}

			$values = [
				'zones_id' => $zone,
				'rooms_id' => $room,
				'npcs_id' => $Npc->id,
				'chance' => $spawn['chance'],
				];

			$SpawnRule->fill($values);
			$SpawnRule->save();
			}

		foreach ($request->loot_tables as $loot_table)
			{
			$LootTable = new LootTable;

			if (isset($loot_table['id']))
				{
				$LootTable = LootTable::findOrFail($loot_table['id']);
				if ($loot_table['item_id'] == 'null' && !$loot_table['chance'])
					{
					$LootTable->delete();
					}
				}

			if (!$loot_table['item_id'] || !$loot_table['chance'])
				{
				continue;
				}

			$values = [
				'npcs_id' => $Npc->id,
				'items_id' => $loot_table['item_id'],
				'chance' => $loot_table['chance'],
				];

			$LootTable->fill($values);
			$LootTable->save();
			}

		Session::flash('success', 'NPC Updated!');

		return $this->edit($Npc->fresh()->id);
		}
	}