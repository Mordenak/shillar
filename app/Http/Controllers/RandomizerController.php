<?php

namespace App\Http\Controllers;
use App\Randomizer;
use Session;

use Illuminate\Http\Request;

class RandomizerController extends Controller
	{
	public function create()
		{
		return view('randomizer.edit');
		}

	public function all()
		{
		// admin command:
		$Randomizers = Randomizer::all();

		return view('randomizer.all', ['randomizers' => $Randomizers]);
		}

	public function edit($id)
		{
		return view('randomizer.edit', ['randomizer' => Randomizer::findOrFail($id)]);
		}

	public function save(Request $request)
		{
		$Randomizer = new Randomizer;
		if ($request->id)
			{
			$Randomizer = Randomizer::findOrFail($request->id);
			}

		$values = [
			'id' => $Randomizer->id,
			'uid' => $request->uid,
			'rooms_id' => $request->rooms_id,
			'zones_id' => $request->zones_id,
			'zone_areas_id' => $request->zone_areas_id,
			'creatures_id' => $request->creatures_id,
			'creature_groups_id' => $request->creature_groups_id,
			'rotation_hours' => $request->rotation_hours,
			];

		$Randomizer->fill($values);
		$Randomizer->save();

		Session::flash('success', 'Randomizer Updated!');
		return $this->edit($Randomizer->id);
		}
	}
