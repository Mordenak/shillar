<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\ZoneArea;
use App\Zone;

class ZoneAreaController extends Controller
{
	public function create()
		{
		$zones = Zone::orderBy('id')->get();
		return view('zone_area.edit', ['zones' => $zones]);
		}

	public function all(Request $request)
		{
		$zone_areas = ZoneArea::all();
		return view('zone_area.all', ['zone_areas' => $zone_areas]);
		}

	public function edit($id)
		{
		$zones = Zone::all();
		$ZoneArea = ZoneArea::findOrFail($id);
		return view('zone_area.edit', ['zone_area' => $ZoneArea, 'zones' => $zones]);
		}

	public function delete(Request $request)
		{
		// clear out shop items:
		$ZoneArea = ZoneArea::findOrFail($request->id);
		$ZoneArea->delete();
		Session::flash('success', 'ZoneArea Deleted!');
		return redirect()->action('ZoneAreaController@all');
		}

	public function save(Request $request)
		{
		$ZoneArea = new ZoneArea;

		if ($request->id)
			{
			$ZoneArea = ZoneArea::findOrFail($request->id);
			}

		$values = [
			'zones_id' => $request->zones_id,
			'name' => $request->name,
			'travel_text' => $request->travel_text,
			'img_src' => $request->img_src,
			'bg_color' => $request->bg_color,
			'font_color' => $request->font_color,
			'label_color' => $request->label_color,
			'description' => $request->description,
			];

		$ZoneArea->fill($values);
		$ZoneArea->save();

		Session::flash('success', 'ZoneArea Updated!');
		return redirect()->action('ZoneAreaController@edit', ['id' => $ZoneArea->id]);
		}

	public function placeholder(Request $request)
		{
		if ($request->id === 'null')
			{
			// This is our hacky select value workaround:
			return '{}';
			}
		// Given a property ID:
		$ZoneProperty = ZoneProperty::findOrFail($request->id);
		if ($ZoneProperty)
			{
			return $ZoneProperty->format;
			}
		return '{}';
		}

	public function lookup(Request $request)
		{
		$ZoneAreas = ZoneArea::where('name', 'ilike', "%$request->term%")->get();	

		$arr = [];

		if ($ZoneAreas)
			{
			foreach ($ZoneAreas as $ZoneArea)
				{
				$label = "($ZoneArea->id) ".$ZoneArea->name;
				$arr[] = [
					'label' => $label,
					'value' => $ZoneArea->id,
					];
				}
			}

		// Also search IDs:
		if (is_numeric($request->term))
			{
			$ZoneAreas = ZoneArea::where('id', '=', $request->term)->get();

			if ($ZoneAreas)
				{
				foreach ($ZoneAreas as $ZoneArea)
					{
					$label = "($ZoneArea->id) ".$ZoneArea->name;
					$arr[] = [
						'label' => $label,
						'value' => $ZoneArea->id,
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
