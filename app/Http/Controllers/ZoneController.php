<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;

class ZoneController extends Controller
{
	public function create()
		{
		// $zones = Zone::all();
		return view('zone.create');
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
			];

		$Zone->fill($values);
		$Zone->save();

		// return view('admin/main');
		return redirect()->action('AdminController@index');
		}
}
