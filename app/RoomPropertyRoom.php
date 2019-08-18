<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomPropertyRoom extends Model
{
	public function room()
		{
		return $this->belongsTo('App\Room', 'rooms_id')->first();
		}

	public function room_property()
		{
		return $this->belongsTo('App\RoomProperty', 'room_properties_id')->first();
		}
}
