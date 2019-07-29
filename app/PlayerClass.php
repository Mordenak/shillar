<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerClass extends Model
{
	//
	public function characters()
		{
		return $this->hasMany('App\Character');
		}
}
