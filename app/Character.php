<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    //
	public function playerrace()
		{
		return $this->belongsTo('App\PlayerRace', 'player_races_id');
		}

	public function inventory()
		{
		return $this->hasOne('App\Inventory', 'characters_id');
		}
}
