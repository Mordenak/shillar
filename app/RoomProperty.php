<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomProperty extends Model
{
	protected $fillable = ['name', 'custom_view', 'description'];

	public function room()
		{
		return $this->hasOne('App\Room', 'rooms_id')->first();
		}
}
