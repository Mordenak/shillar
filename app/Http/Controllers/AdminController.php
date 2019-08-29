<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\Item;
use App\Zone;
use App\Room;

class AdminController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
		{
		$this->middleware('auth');
		}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
		{
		if (!isset(auth()->user()->admin_level))
			{
			// error
			return view('home');
			}

		return view('admin/main');
		}

	public function zone_editor()
		{
		if (!isset(auth()->user()->admin_level))
			{
			// error
			return view('home');
			}

		return view('admin.zone-editor');
		}

	// TODO: Deprecated now?
	public function process(Request $request)
		{
		if (!isset(auth()->user()->admin_level))
			{
			// error
			return view('home');
			}
		// figure out where to go:
		if ($request->create)
			{
			// die('.'.print_r($request->create).'/create');
			// return view($request->create.'/create');
			if ($request->create == 'room')
				{
				return redirect()->action('RoomController@create');
				}

			if ($request->create == 'zone')
				{
				return redirect()->action('ZoneController@create');
				}

			if ($request->create == 'item')
				{
				return redirect()->action('ItemController@create');
				}

			if ($request->create == 'creature')
				{
				return redirect()->action('CreatureController@create');
				}
			}

		if ($request->edit)
			{
			return view($request->create.'/edit');
			}

		if ($request->delete)
			{
			return view($request->create.'/delete');
			}
		return true;
		}

	public function give_item(Request $request)
		{
		if ($request->characters_id)
			{
			if ($request->items_id)
				{
				$Character = Character::findOrFail($request->characters_id);
				$Item = Item::findOrFail($request->items_id);
				if ($Item->is_stackable && $request->quantity)
					{
					$Character->inventory()->add_item($Item->id, $request->quantity);
					}
				else
					{
					$Character->inventory()->add_item($Item->id);
					}
				}
			}

		return view('admin/give_item');
		}

	public function zone_builder(Request $request)
		{
		$Zone = Zone::findOrFail($request->zones_id);
		// Get last room id:
		$Room = Room::orderBy('id', 'desc')->first();

		$next_id = $Room->id + 1;
		foreach ($request->new_rooms as $room_obj)
			{
			$Room = new Room;
			$Room->zones_id = $request->zones_id;
			$Room->save(); 
			}
		foreach ($request->new_rooms as $room_obj)
			{
			$directions = json_decode($room_obj['dirs'], true);

			$Room = Room::findOrFail($room_obj['id'] + $next_id);

			$room_values = [
				'north_rooms_id' => isset($directions['north']) ? $directions['north'] + $next_id : null,
				'east_rooms_id' => isset($directions['east']) ? $directions['east'] + $next_id : null,
				'south_rooms_id' => isset($directions['south']) ? $directions['south'] + $next_id : null,
				'west_rooms_id' => isset($directions['west']) ? $directions['west'] + $next_id : null,
				'northeast_rooms_id' => isset($directions['northeast']) ? $directions['northeast'] + $next_id : null,
				'southeast_rooms_id' => isset($directions['southeast']) ? $directions['southeast'] + $next_id : null,
				'southwest_rooms_id' => isset($directions['southwest']) ? $directions['southwest'] + $next_id : null,
				'northwest_rooms_id' => isset($directions['northwest']) ? $directions['northwest'] + $next_id : null,
				'up_rooms_id' => isset($directions['up']) ? $directions['up'] + $next_id : null,
				'down_rooms_id' => isset($directions['down']) ? $directions['down'] + $next_id : null,
				];

			if ($room_obj['id'] == 0)
				{
				$room_values['title'] = 'Builder Starting Point';
				}

			if ($room_obj['id'] == (count($request->new_rooms) -1))
				{
				$room_values['title'] = 'Builder Ending Point';
				}


			$Room->fill($room_values);
			$Room->save();
			}
		return view('admin.zone-editor');
		}
}
