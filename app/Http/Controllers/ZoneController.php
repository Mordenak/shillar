<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;

class ZoneController extends Controller
{
	public function create()
		{
		// $zones = Zone::all();
		return view('zone.edit');
		}

	public function all(Request $request)
		{
		$zones = Zone::all();
		return view('zone.all', ['zones' => $zones]);
		}

	public function edit($id)
		{
		// $zones = Zone::all();
		return view('zone.edit', ['zone' => Zone::findOrFail($id)]);
		}

	public function save(Request $request)
		{
		$Zone = new Zone;

		if ($request->id)
			{
			$Zone = Zone::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name,
			'description' => $request->description,
			'travel_text' => $request->travel_text,
			];

		$Zone->fill($values);
		$Zone->save();

		// return view('admin/main');
		return redirect()->action('ZoneController@all');
		}

	public function lookup(Request $request)
		{
		$Zones = Zone::where('name', 'ilike', "%$request->term%")->get();	

		$arr = [];

		if ($Zones)
			{
			foreach ($Zones as $Zone)
				{
				$label = "($Zone->id) ".$Zone->name;
				$arr[] = [
					'label' => $label,
					'value' => $Zone->id,
					];
				}
			}

		// Also search IDs:
		if (is_numeric($request->term))
			{
			$Zones = Zone::where('id', '=', $request->term)->get();

			if ($Zones)
				{
				foreach ($Zones as $Zone)
					{
					$label = "($Zone->id) ".$Zone->name;
					$arr[] = [
						'label' => $label,
						'value' => $Zone->id,
						];
					}
				}
			}

		if (empty($arr))
			{
			$arr[] = ['label' => 'No Results', 'value' => $request->term];
			}

		echo (json_encode($arr));;
		header('Content-type: application/json');
		}
}
