<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $fillable = ['zones_id', 'title', 'description', 'img_src', 'spawns_enabled', 'north_rooms_id', 'east_rooms_id', 'south_rooms_id', 'west_rooms_id', 'up_rooms_id', 'down_rooms_id', 'northeast_rooms_id', 'southeast_rooms_id', 'southwest_rooms_id', 'northwest_rooms_id'];

	// doc?
	public function zone()
		{
		return $this->belongsTo('App\Zone', 'zones_id')->first();
		}

	public function properties()
		{
		return $this->hasMany('App\RoomPropertyRoom', 'rooms_id')->get();
		}

	public function shop()
		{
		return $this->hasOne('App\Shop', 'rooms_id')->first();
		}

	public function can_train()
		{
		foreach ($this->properties() as $prop)
			{
			if ($prop->room_property()->name == 'CAN_TRAIN')
				{
				return true;
				}
			}
		return false;
		}

	public function has_shop()
		{
		if ($this->shop())
			{
			return true;
			}
		return false;
		}

	public function has_property(string $property_name)
		{
		foreach ($this->properties() as $prop)
			{
			if ($prop->room_property()->name == $property_name)
				{
				return true;
				}
			}
		return false;
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

}
