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
		return view('npc.create');
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
		// Should be only one:
		// $RewardTable = RewardTable::where(['npcs_id' => $Npc->id])->first();
		$SpawnRules = SpawnRule::where(['npcs_id' => $Npc->id])->get();
		$LootTables = LootTable::where(['npcs_id' => $Npc->id])->get();
		// die(print_r($SpawnRules->count()));
		return view('npc.edit', ['npc' => $Npc, 'spawn_rules' => $SpawnRules, 'loot_tables' => $LootTables, 'zones' => $zones, 'items' => $items]);
		}

	public function save(Request $request)
		{
		$Npc = new Npc;

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

		return $this->edit($Npc->id);
		// return redirect()->action('AdminController@index');
		}

	public function save_stats(Request $request)
		{
		$NpcStat = new NpcStat;

		if ($request->id)
			{
			$NpcStat = NpcStat::findOrFail($request->id);
			}

		$values = [
			'health' => $request->health,
			'armor' => $request->armor,
			'damage_low' => $request->damage_low,
			'damage_high' => $request->damage_high,
			'attacks_per_round' => $request->attacks_per_round,
			];

		$NpcStat->fill($values);
		$NpcStat->save();

		if ($request->ajax())
			{
			$view = $this->edit($NpcStat->npc()->id);
			$sections = $view->renderSections();
			Session::flash('success', 'NPC Updated!');
			// $sections['messages'] = View::make('partials/flash-messages')->renderSections();
			$sections['messages'] = view('partials/flash-messages')->renderSections()['messages'];
			// die(print_r($test));
			return $sections;
			}
		// return action('NpcController@edit', $NpcStat->npc()->id);
		return $this->edit($NpcStat->npc()->id);
		}

	public function save_rewards(Request $request)
		{
		$RewardTable = new RewardTable;

		if ($request->id)
			{
			$RewardTable = RewardTable::findOrFail($request->id);
			}

		$values = [
			'npcs_id' => $request->npc_id,
			'award_xp' => $request->award_xp,
			'xp_variation' => $request->xp_variation,
			'award_gold' => $request->award_gold,
			'gold_variation' => $request->gold_variation,
			];

		$RewardTable->fill($values);
		$RewardTable->save();

		if ($request->ajax())
			{
			$view = $this->edit($RewardTable->npc()->id);
			$sections = $view->renderSections();
			Session::flash('success', 'NPC Updated!');
			// $sections['messages'] = View::make('partials/flash-messages')->renderSections();
			$sections['messages'] = view('partials/flash-messages')->renderSections()['messages'];
			// die(print_r($test));
			return $sections;
			}
		// return action('NpcController@edit', $NpcStat->npc()->id);
		return $this->edit($RewardTable->npc()->id);
		}

	public function save_spawns(Request $request)
		{
		$SpawnRule = new SpawnRule;

		if ($request->id)
			{
			$SpawnRule = SpawnRule::findOrFail($request->id);
			}

		$zone = null;
		if ($request->zone_id != 'null')
			{
			$zone = $request->zone_id;
			}

		$room = null;
		if ($request->room_id != 'null')
			{
			$room = $request->room_id;
			}

		$values = [
			'zones_id' => $zone,
			'rooms_id' => $room,
			'npcs_id' => $request->npc_id,
			'chance' => $request->chance,
			];

		$SpawnRule->fill($values);
		$SpawnRule->save();

		if ($request->ajax())
			{
			$view = $this->edit($SpawnRule->npc()->id);
			$sections = $view->renderSections();
			Session::flash('success', 'NPC Updated!');
			// $sections['messages'] = View::make('partials/flash-messages')->renderSections();
			$sections['messages'] = view('partials/flash-messages')->renderSections()['messages'];
			// die(print_r($test));
			return $sections;
			}

		return $this->edit($SpawnRule->npc()->id);
		}

	public function save_loot(Request $request)
		{
		$LootTable = new LootTable;

		if ($request->id)
			{
			$LootTable = LootTable::findOrFail($request->id);
			}

		// $zone = null;
		// if ($request->zone_id != 'null')
		// 	{
		// 	$zone = $request->zone_id;
		// 	}

		$values = [
			// 'zones_id' => $zone,
			'npcs_id' => $request->npc_id,
			'items_id' => $request->item_id,
			'chance' => $request->chance,
			];

		$LootTable->fill($values);
		$LootTable->save();

		if ($request->ajax())
			{
			$view = $this->edit($LootTable->npc()->id);
			$sections = $view->renderSections();
			Session::flash('success', 'NPC Updated!');
			// $sections['messages'] = View::make('partials/flash-messages')->renderSections();
			$sections['messages'] = view('partials/flash-messages')->renderSections()['messages'];
			// die(print_r($test));
			return $sections;
			}
		// return action('NpcController@edit', $NpcStat->npc()->id);
		return $this->edit($LootTable->npc()->id);
		}
}
