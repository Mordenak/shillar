<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceRacialModifier extends Model
	{
	protected $table = 'race_racial_modifiers';

	protected $fillable = ['racial_modifiers_id', 'races_id', 'value'];

	public function modifier()
		{
		return $this->belongsTo('App\RacialModifier', 'racial_modifiers_id');
		}

	public function race()
		{
		return $this->belongsTo('App\Race');
		}
	}
