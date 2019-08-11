<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\Room;

class RoomController extends Controller
{
	public function create()
		{
		$zones = Zone::all();
		return view('room.create', ['zones' => $zones]);
		}

	public function all(Request $request)
		{
		$rooms = Room::all();
		return view('room.all', ['rooms' => $rooms]);
		}

	public function edit($id)
		{
		$zones = Zone::all();
		return view('room.edit', ['room' => Room::findOrFail($id), 'zones' => $zones]);
		}

	public function save(Request $request)
		{
		$Room = new Room;

		if ($request->id)
			{
			$Room = Room::findOrFail($request->id);
			}

		$values = [
			'zones_id' => $request->selected_zone,
			'title' => $request->title,
			'description' => $request->description,
			'north_rooms_id' => $request->north_room_id,
			'east_rooms_id' => $request->east_room_id,
			'south_rooms_id' => $request->south_room_id,
			'west_rooms_id' => $request->west_room_id,
			];



		$Room->fill($values);
		$Room->save();

		// return view('admin/main');
		return redirect()->action('AdminController@index');
		}
}
