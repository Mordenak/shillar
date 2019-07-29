<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerRace extends Model
{
    //
    public function characters()
		{
		return $this->hasMany('App\Character');
		}
}
