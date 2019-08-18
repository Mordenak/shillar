<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomPropertiesRoom extends Model
{
	public function room()
		{
		return $this->hasMany('App\Room', 'rooms_id')->first();
		}

	public function room_property()
		{
		return $this->hasMany('App\RoomProperty', 'room_properties_id')->first();
		}
}
