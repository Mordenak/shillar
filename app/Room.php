<?php

namespace App;
use Session;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $fillable = ['zones_id', 'zone_areas_id', 'zone_level', 'uid', 'title', 'description', 'img_src', 'spawns_enabled', 'north_rooms_id', 'east_rooms_id', 'south_rooms_id', 'west_rooms_id', 'up_rooms_id', 'down_rooms_id', 'northeast_rooms_id', 'southeast_rooms_id', 'southwest_rooms_id', 'northwest_rooms_id', 'room_properties_id'];

	// doc?
	public function zone()
		{
		return $this->belongsTo('App\Zone', 'zones_id')->first();
		}

	public function property()
		{
		return $this->belongsTo('App\RoomProperty', 'room_properties_id')->first();
		}

	// TODO Different ways?
	public function zone_level()
		{
		return $this->belongsTo('App\ZoneLevel', 'zones_id', 'zone_level')->first();
		}

	public function zone_area()
		{
		return $this->belongsTo('App\ZoneArea', 'zone_areas_id')->first();
		}

	public function shop()
		{
		return $this->hasOne('App\Shop', 'rooms_id')->first();
		}

	public function trader()
		{
		return $this->hasOne('App\Trader', 'rooms_id')->first();
		}

	public function room_actions()
		{
		return $this->hasOne('App\RoomAction', 'rooms_id')->first();
		}

	public function can_train()
		{
		return $this->has_property('CAN_TRAIN');
		}

	public function has_shop()
		{
		return $this->shop() ? true : false;
		}

	public function has_trader()
		{
		return $this->trader() ? true : false;
		}

	public function has_property(string $property_name = null)
		{
		if ($this->room_properties_id)
			{
			if (!$property_name)
				{
				return true;
				}
			return $this->property()->name == $property_name ? true : false;
			}
		return false;
		}

	public function directions()
		{
		$arr = [
			'north_rooms_id' => $this->north_rooms_id,
			'east_rooms_id' => $this->east_rooms_id,
			'south_rooms_id' => $this->south_rooms_id,
			'west_rooms_id' => $this->west_rooms_id,
			'up_rooms_id' => $this->up_rooms_id,
			'down_rooms_id' => $this->down_rooms_id,
			'northeast_rooms_id' => $this->northeast_rooms_id,
			'southeast_rooms_id' => $this->southeast_rooms_id,
			'southwest_rooms_id' => $this->southwest_rooms_id,
			'northwest_rooms_id' => $this->northwest_rooms_id,
			];

		return $arr;
		}

	public function get_color_scheme()
		{
		$scheme = '';

		if ($this->zone()->bg_img)
			{
			$scheme = 'background-image: url(' . asset('bgs/' . $this->zone()->bg_img) . ');';
			}

		if ($this->zone()->bg_color)
			{
			$scheme = 'background-color: ' . $this->zone()->bg_color . ';';
			}

		if ($this->zone()->font_color)
			{
			$scheme = $scheme . 'color: ' . $this->zone()->font_color . ';';
			}

		if ($this->zone_area())
			{
			if ($this->zone_area()->bg_img)
				{
				$scheme = 'background-image: url(' . asset('bgs/' . $this->zone_area()->bg_img) . ');';
				}

			if ($this->zone_area()->bg_color)
				{
				$scheme = 'background-color: ' . $this->zone_area()->bg_color . ';';
				}

			if ($this->zone_area()->font_color)
				{
				$scheme = $scheme . 'color: ' . $this->zone_area()->font_color . ';';
				}
			}

		return $scheme;
		}

	public function generate_directions($Character, $request)
		{
		$directions = [];

		if ($this->zone()->has_property('SCRAMBLE_DIRECTIONS') && !$Character->inventory()->has_item_property('COMPASS'))
			{
			// Get current valid directions:
			$valid_dirs = [$this->id];
			foreach ($this->directions() as $col => $room_id)
				{
				if ($room_id)
					{
					$valid_dirs[] = $room_id;
					}
				}

			$get_dirs = $this->directions();
			unset($get_dirs['up_rooms_id']);
			unset($get_dirs['down_rooms_id']);
			$poss_dirs = array_keys($get_dirs);
			
			// TODO: Should we force at least 1 valid direction every time?
			// Map the valids?
			// foreach ($valid_dirs as $valid_dir)
			// 	{
			// 	$directions[] = [$poss_dirs[array_rand($poss_dirs)] => $valid_dir];
			// 	}
			// Then generate random ones up to... 5? ::

			// TODO: better

			if (rand(0,100) >= 0)
				{
				$directions[] = [$poss_dirs[array_rand($poss_dirs)] => $valid_dirs[array_rand($valid_dirs)]];
				}

			if (rand(0,100) >= 0)
				{
				$directions[] = [$poss_dirs[array_rand($poss_dirs)] => $valid_dirs[array_rand($valid_dirs)]];
				}

			if (rand(0,100) >= 40)
				{
				$directions[] = [$poss_dirs[array_rand($poss_dirs)] => $valid_dirs[array_rand($valid_dirs)]];
				}

			if (rand(0,100) >= 60)
				{
				$directions[] = [$poss_dirs[array_rand($poss_dirs)] => $valid_dirs[array_rand($valid_dirs)]];
				}

			if (rand(0,100) >= 80)
				{
				$directions[] = [$poss_dirs[array_rand($poss_dirs)] => $valid_dirs[array_rand($valid_dirs)]];
				}

			shuffle($directions);

			if (count(array_unique(array_map(function ($i) { return key($i); }, $directions))) == 1)
				{
				// TODO: Random chance of treasure actually showing, using Character skill level
				// Was unique groupings:
				if (rand(0,100 >= 50))
					{
					Session::put('has_treasure', true);
					$num_dirs = count($directions);
					$expiresAt = Carbon::now()->addMinutes(5);
					Cache::put('room-treasure-'.$this->id, $num_dirs, $expiresAt);
					}
				}
			}
		else
			{
			foreach ($this->directions() as $col => $room_id)
				{
				if ($room_id)
					{
					if ($this->room_actions())
						{
						if (!$request->unlock_direction && in_array($col, array_keys($this->room_actions()->blocked_dirs())))
							{
							// better have character record:
							$CharacterRoomAction = CharacterRoomAction::where(['characters_id' => $Character->id, 'room_actions_id' => $this->room_actions()->id])->first();
							if ($CharacterRoomAction)
								{
								$directions[] = [$col => $room_id];
								}
							}
						else
							{
							$directions[] = [$col => $room_id];
							}
						}
					else
						{
						$directions[] = [$col => $room_id];
						}
					}
				else
					{

					}
				}
			}

		// When we generate directions, store something on the server for that room:
		// Cache::put()
		return $directions;
		}

	public function is_reachable($room_id)
		{
		// check every direction?
		if ($this->north_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->east_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->south_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->west_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->up_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->down_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->northeast_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->southeast_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->southwest_rooms_id == $room_id)
			{
			return true;
			}
		if ($this->northwest_rooms_id == $room_id)
			{
			return true;
			}
		return false;
		}

	public function current_characters()
		{
		$Characters = Character::where(['last_rooms_id' => $this->id])->get();

		if ($Characters->count() == 0)
			{
			return false;
			}

		return $Characters;
		}

}
