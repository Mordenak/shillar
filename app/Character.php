<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    //
	public function playerrace()
		{
		return $this->belongsTo('App\PlayerRace');
		}

	public function playerclass()
		{
		return $this->belongsTo('App\PlayerClass');
		}
}
