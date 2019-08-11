<?php

namespace App\Http\Controllers;

use Session;
use View;
use Illuminate\Http\Request;
use App\Npc;
use App\NpcStat;
use App\SpawnRule;
use App\LootTable;

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
		$SpawnRules = SpawnRule::where(['npcs_id' => $Npc->id])->get();
		$LootTables = LootTable::where(['npcs_id' => $Npc->id])->get();
		// die(print_r($Npc->stats()->first()));
		return view('npc.edit', ['npc' => $Npc, 'stats' => $Npc->stats()->first(), 'spawn_rules' => $SpawnRules, 'loot_tables' => $LootTables]);
		}

	public function save(Request $request)
		{
		$Npc = new Npc;

		if ($request->id)
			{
			$Npc = Npc::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name
			];

		$Npc->fill($values);
		$Npc->save();

		return redirect()->action('AdminController@index');
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
			// 'armor' => $request->armor,
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
			$sections['messages'] = view('partials/flash-messages')->renderSections();
			// die(print_r($test));
			return $sections;
			}
		// return action('NpcController@edit', $NpcStat->npc()->id);
		return $this->edit($NpcStat->npc()->id);
		}
}
