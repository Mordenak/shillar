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
			'darkness_level' => $request->darkness_level,
			'img_src' => $request->img_src,
			];

		$Zone->fill($values);
		$Zone->save();

		// return view('admin/main');
		return redirect()->action('AdminController@index');
		}
}
