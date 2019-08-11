<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Npc;

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
		return view('npc.edit', ['npc' => Npc::findOrFail($id)]);
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
