<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Zone;
use App\Room;

class RoomController extends Controller
	{
	public function create()
		{
		$zones = Zone::all();
		return view('room.edit', ['zones' => $zones]);
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

	public function delete(Request $request)
		{
		// clear out shop items:
		$Room = Room::findOrFail($request->id);
		$Room->delete();
		Session::flash('success', 'Room Deleted!');
		// return $this->all($request);
		return redirect()->action('RoomController@all');
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
			'zone_areas_id' => $request->zone_areas_id,
			'uid' => $request->uid,
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
			'northeast_rooms_id' => $request->northeast_rooms_id,
			'southeast_rooms_id' => $request->southeast_rooms_id,
			'southwest_rooms_id' => $request->southwest_rooms_id,
			'northwest_rooms_id' => $request->northwest_rooms_id,
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

		if ($request->northeast_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->northeast_rooms_id);
			$LinkRoom->southwest_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		if ($request->southeast_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->southeast_rooms_id);
			$LinkRoom->northwest_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		if ($request->southwest_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->southwest_rooms_id);
			$LinkRoom->northeast_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		if ($request->northwest_room_link)
			{
			$LinkRoom = Room::findOrFail($Room->northwest_rooms_id);
			$LinkRoom->southeast_rooms_id = $Room->id;
			$LinkRoom->save();
			}

		// return view('admin/main');
		return redirect()->action('RoomController@all');
		}

	public function lookup(Request $request)
		{
		if (preg_match("/zone:(.+)/", $request->term, $matches))
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
