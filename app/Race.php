<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
	protected $fillable = ['name', 'gender'];

	public function characters()
		{
		return $this->hasMany('App\Character');
		}

	public function stat_costs()
		{
		return $this->hasMany('App\StatCost', 'races_id');
		}

	public function starting_stats()
		{
		return $this->hasOne('App\StartingStat', 'races_id');
		}

	public function modifiers()
		{
		return $this->hasMany('App\RaceRacialModifier', 'races_id');
		}
}
