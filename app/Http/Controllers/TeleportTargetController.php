<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\TeleportTarget;
class TeleportTargetController extends Controller
	{
	public function create()
		{
		return view('teleport.edit');
		}

	public function all(Request $request)
		{
		$teleports = TeleportTarget::all();
		return view('teleport.all', ['teleports' => $teleports]);
		}

	public function edit($id)
		{
		$TeleportTarget = TeleportTarget::findOrFail($id);
		return view('teleport.edit', ['teleport' => $TeleportTarget]);
		}

	public function delete(Request $request)
		{
		// clear out shop items:
		$TeleportTarget = TeleportTarget::findOrFail($request->id);
		$TeleportTarget->delete();
		Session::flash('success', 'TeleportTarget Deleted!');
		return redirect()->action('TeleportTargetController@all');
		}

	public function save(Request $request)
		{
		$TeleportTarget = new TeleportTarget;

		if ($request->id)
			{
			$TeleportTarget = TeleportTarget::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name,
			'rooms_id' => $request->rooms_id,
			'level_req' => $request->level_req,
			'wisdom_req' => $request->wisdom_req
			];

		$TeleportTarget->fill($values);
		$TeleportTarget->save();

		Session::flash('success', 'TeleportTarget Updated!');
		return redirect()->action('TeleportTargetController@edit', ['id' => $TeleportTarget->id]);
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

	}
