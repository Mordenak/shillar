<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
	//
	public function characters()
		{
		return $this->hasMany('App\Character');
		}

	public function modifiers()
		{
		return $this->hasMany('App\RaceRacialModifier', 'races_id');
		}
}
