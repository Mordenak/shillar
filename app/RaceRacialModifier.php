<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceRacialModifier extends Model
	{
	protected $table = 'race_racial_modifiers';

	protected $fillable = [];

	public function modifier()
		{
		return $this->belongsTo('App\RacialModifier');
		}

	public function race()
		{
		return $this->belongsTo('App\Race');
		}
	}
