<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpawnRule extends Model
{
	public function zone()
		{
		return $this->belongsTo('App\Zone', 'zones_id')->first();
		}

	public function room()
		{
		return $this->belongsTo('App\Room', 'rooms_id')->first();
		}
}
