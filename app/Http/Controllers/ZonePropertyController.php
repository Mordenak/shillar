<?php

namespace App\Http\Controllers;
use App\ZoneProperty;
use Session;

use Illuminate\Http\Request;

class ZonePropertyController extends Controller
	{
	public function create()
		{
		$ZoneProperties = ZoneProperty::all();
		return view('zone_property.edit');
		}

	public function all(Request $request)
		{
		$ZoneProperties = ZoneProperty::all();
		return view('zone_property.all', ['zone_properties' => $ZoneProperties]);
		}

	public function edit($id)
		{
		$ZoneProperty = ZoneProperty::findOrFail($id);
		// return view('spell.edit', ['spell' => $Spell]);
		return view('zone_property.edit', ['zone_property' => $ZoneProperty]);
		}

	public function delete(Request $request)
		{
		// clear out shop items:
		$ZoneProperty = ZoneProperty::findOrFail($request->id);
		$ZoneProperty->delete();
		Session::flash('success', 'ZoneProperty Deleted!');
		return redirect()->action('ZonePropertyController@all');
		}

	public function save(Request $request)
		{
		$ZoneProperty = new ZoneProperty;

		if ($request->id)
			{
			$ZoneProperty = ZoneProperty::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name,
			'description' => $request->description,
			'format' => $request->format,
			'custom_view' => $request->custom_view
			];

		$ZoneProperty->fill($values);
		$ZoneProperty->save();

		Session::flash('success', 'ZoneProperty Updated!');
		return redirect()->action('ZonePropertyController@edit', ['id' => $ZoneProperty->id]);
		}
	}
