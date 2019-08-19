<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $fillable = ['zones_id', 'title', 'description', 'img_src', 'spawns_enabled', 'north_rooms_id', 'east_rooms_id', 'south_rooms_id', 'west_rooms_id', 'up_rooms_id', 'down_rooms_id'];

   	public function zone()
   		{
   		return $this->belongsTo('App\Zone', 'zones_id')->first();
   		}

	public function properties()
		{
		return $this->hasMany('App\RoomPropertyRoom', 'rooms_id')->get();
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

}
