<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Zone;
use App\ZoneProperty;
use App\ZoneToZoneProperty;

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
		$Zone = Zone::findOrFail($id);
		$ZoneProperty = ZoneProperty::all();
		return view('zone.edit', ['zone' => $Zone, 'zone_properties' => $Zone->properties()->get(), 'properties' => $ZoneProperty]);
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

		foreach ($request->zone_properties as $zone_property)
			{
			$ZoneToZoneProperty = new ZoneToZoneProperty;

			if (isset($zone_property['id']))
				{
				$ZoneToZoneProperty = ZoneToZoneProperty::findOrFail($zone_property['id']);
				if ($zone_property['zone_properties_id'] == 'null' && !$zone_property['data'])
					{
					$ZoneToZoneProperty->delete();
					continue;
					}
				}

			if ($zone_property['zone_properties_id'] == 'null')
				{
				continue;
				}

			$values = [
				'zones_id' => $Zone->id,
				'zone_properties_id' => $zone_property['zone_properties_id'],
				'data' => $zone_property['data'],
				];

			$ZoneToZoneProperty->fill($values);
			$ZoneToZoneProperty->save();
			}

		Session::flash('success', 'Zone Updated!');
		return redirect()->action('ZoneController@edit', ['id' => $Zone->id]);
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
