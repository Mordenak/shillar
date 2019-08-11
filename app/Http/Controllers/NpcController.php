<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Npc;
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

		// return view('admin/main');
		return redirect()->action('AdminController@index');
		}
}
