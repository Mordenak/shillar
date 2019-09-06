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

	public function zone_select(Request $request)
		{
		$Zone = Zone::findOrFail($request->zones_id);

		$Rooms = $Zone->rooms_q()->orderBy('id', 'desc')->get();

		return $Rooms;
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
		// $next_id = $Room->id + 1;
		$Room = null;

		$new_rooms = [];
		if (isset($request->new_rooms))
			{
			// TODO: Hmm, perhaps we don't need to pre-create these rooms?
			foreach ($request->new_rooms as $room_obj)
				{
				$Room = new Room;
				$Room->zones_id = $Zone->id;
				$Room->save();
				$json = json_decode($room_obj['data'], true);
				$new_rooms[$json['id']] = $Room->id;
				}
			
			foreach ($request->new_rooms as $room_obj)
				{
				if (!isset($room_obj['data']))
					{
					// wtf was submitted?
					return $this->error('No Data provided.');
					}

				$json = json_decode($room_obj['data'], true);
				$Room = Room::findOrFail($new_rooms[$json['id']]);

				$room_values = [];
				foreach ($json as $field => $value)
					{
					// Sanitize?
					if ($field != 'id' && $field != 'zones_id')
						{
						$room_values[$field] = $value;
						}

					if (is_numeric($value) && in_array($value, array_keys($new_rooms)))
						{
						$room_values[$field] = $new_rooms[$value];
						}
					}

				$Room->fill($room_values);
				$Room->save();
				}
			}

		if (isset($request->existing_rooms))
			{
			foreach ($request->existing_rooms as $room_obj)
				{
				if (!isset($room_obj['data']))
					{
					// wtf was submitted?
					return $this->error('No Data provided.');
					}

				$json = json_decode($room_obj['data'], true);
				$Room = Room::findOrFail($json['id']);

				$room_values = [];
				foreach ($json as $field => $value)
					{
					// Sanitize?
					if ($field != 'id' && $field != 'zones_id')
						{
						$room_values[$field] = $value;
						}

					if (is_numeric($value) && in_array($value, array_keys($new_rooms)))
						{
						$room_values[$field] = $new_rooms[$value];
						}
					}

				$Room->fill($room_values);

				$Room->zones_id = $Zone->id;

				$Room->save();
				}
			}

		// return view('admin.zone-editor');
		// return $this->redirect()->action(zone_editor);
		return redirect()->action('AdminController@zone_editor');
		// return $this->zone_editor();
		}
}
