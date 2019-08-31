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

		return $Zone->rooms_q()->orderBy('id', 'desc')->get();
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

		$existing_records = [];
		$next_id = $Room->id + 1;
		foreach ($request->new_rooms as $room_obj)
			{
			if (!isset($room_obj['in_db']))
				{
				$Room = new Room;
				$Room->zones_id = $request->zones_id;
				$Room->save(); 
				error_log('Created '.$Room->id);
				}
			else
				{
				$existing_records[] = $room_obj['in_db'];
				}
			}
		foreach ($request->new_rooms as $room_obj)
			{
			if (!isset($room_obj['dirs']))
				{
				// wtf was submitted?
				error_log('What happened here?');
				error_log(print_r($room_obj));
				continue;
				}
			$directions = json_decode($room_obj['dirs'], true);

			$insert_id = $next_id;
			if (isset($room_obj['in_db']))
				{
				$Room = Room::findOrFail($room_obj['in_db']);
				// $next_id = 0;
				}
			else
				{
				$cap = $room_obj['id'] + $next_id;
				error_log('Loking for: '.$cap);
				$Room = Room::findOrFail($room_obj['id'] + $next_id);
				}

			$dir_list = ['north', 'east', 'south', 'west', 'northeast', 'southeast', 'southwest', 'northwest', 'up', 'down'];

			$room_values = [];

			foreach ($directions as $key => $dir)
				{
				// die(print_r($request->new_rooms));
				if (in_array($key, $dir_list))
					{
					if (isset($key))
						{
						if (in_array($dir, $existing_records))
							{
							$room_values[$key.'_rooms_id'] = $directions[$key];
							}
						else
							{
							$room_values[$key.'_rooms_id'] = $directions[$key] + $next_id;
							}
						}
					else
						{
						$room_values[$key.'_rooms_id'] = null;
						}
					}
				else
					{
					// Else it's a normal param???
					$room_values[$key] = $dir;
					}
				}

			if (!isset($room_obj['in_db']))
				{
				if ($room_obj['id'] == 0)
					{
					$room_values['title'] = 'Builder Starting Point';
					}

				if ($room_obj['id'] == (count($request->new_rooms) -1))
					{
					$room_values['title'] = 'Builder Ending Point';
					}
				}


			$Room->fill($room_values);
			$Room->save();
			}
		return view('admin.zone-editor');
		}
}
