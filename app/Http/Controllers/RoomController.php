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

	public function delete($id)
		{
		Room::delete($id);
		return $this->action('RoomController@all');
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
			'custom_img' => $request->custom_img,
			'spawns_enabled' => $request->spawns_enabled,
			'north_rooms_id' => $request->north_room_id,
			'east_rooms_id' => $request->east_room_id,
			'south_rooms_id' => $request->south_room_id,
			'west_rooms_id' => $request->west_room_id,
			'up_rooms_id' => $request->up_room_id,
			'down_rooms_id' => $request->down_room_id,
			];

		$Room->fill($values);
		$Room->save();

		if ($request->north_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->north_rooms_id);
			$LinkRoom->south_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		if ($request->east_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->east_rooms_id);
			$LinkRoom->west_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		if ($request->south_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->south_rooms_id);
			$LinkRoom->north_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		if ($request->west_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->west_rooms_id);
			$LinkRoom->east_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		if ($request->up_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->up_rooms_id);
			$LinkRoom->down_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		if ($request->down_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->down_rooms_id);
			$LinkRoom->up_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		// return view('admin/main');
		return redirect()->action('RoomController@all');
		}
}
