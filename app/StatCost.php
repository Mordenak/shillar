<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatCost extends Model
	{
	protected $fillable = ['races_id', 'strength_cost', 'dexterity_cost', 'constitution_cost', 'wisdom_cost', 'intelligence_cost', 'charisma_cost'];

	public function race()
		{
		return $this->belongsTo('App\Race');
		}
	}
