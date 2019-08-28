<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAccessory extends Model
	{
	protected $fillable = ['items_id', 'equipment_slot', 'light_level', 'strength_bonus', 'dexterity_bonus', 'constitution_bonus', 'wisdom_bonus', 'intelligence_bonus', 'charisma_bonus'];

	public function item()
		{
		return $this->belongsTo('App\Item');
		}
	}
