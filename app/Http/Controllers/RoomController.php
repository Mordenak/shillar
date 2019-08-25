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
			'img_src' => $request->img_src,
			'spawns_enabled' => $request->spawns_enabled ? true : false,
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

	public function lookup(Request $request)
		{
		if ($request->term == 'has:title')
			{
			$Rooms = Room::whereNotNull('title')->get();
			}
		elseif (preg_match("/zone:(.+)/", $request->term, $matches))
			{
			if (is_numeric($matches[1]))
				{
				$Zone = Zone::findOrFail($matches[1]);
				}
			else
				{
				$Zone = Zone::where('name', 'ilike', "%$matches[1]%")->first();
				if ($Zone->count === 0)
					{
					return [];
					}

				}
			$Rooms = $Zone->rooms();
			}
		else
			{
			$Rooms = Room::where('title', 'ilike', "%$request->term%")->get();	
			}

		$arr = [];

		if ($Rooms)
			{
			foreach ($Rooms as $Room)
				{
				$title = $Room->title ? $Room->title : '-- No Title --';
				if ($Room->uid)
					{
					$title = $title . ' ['. $Room->uid . '] ';
					}
				$label = "($Room->id) $title in ".$Room->zone()->name;
				// $label = '('.$Room->id.') '.$title.' ['.$Room->zone()->name.']';
				$arr[] = [
					'label' => $label,
					'value' => $Room->id,
					];
				}
			}

		// All check the uids:
		$Rooms = Room::where('uid', 'ilike', "%$request->term%")->get();

		foreach ($Rooms as $Room)
			{
			$title = $Room->title ? $Room->title : '-- No Title --';
			if ($Room->uid)
				{
				$title = $title . ' ['. $Room->uid . '] ';
				}
			$label = "($Room->id) $title in ".$Room->zone()->name;
			// $label = '('.$Room->id.') '.$title.' ['.$Room->zone()->name.']';
			$arr[] = [
				'label' => $label,
				'value' => $Room->id,
				];
			}

		// Also search IDs:
		if (is_numeric($request->term))
			{
			$Rooms = Room::where('id', '=', $request->term)->get();

			if ($Rooms)
				{
				foreach ($Rooms as $Room)
					{
					$title = $Room->title ? $Room->title : '-- No Title --';
					if ($Room->uid)
						{
						$title = $title . ' ['. $Room->uid . '] ';
						}
					$label = "($Room->id) $title in ".$Room->zone()->name;
					$arr[] = [
						'label' => $label,
						'value' => $Room->id,
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
