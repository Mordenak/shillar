<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemWeapon extends Model
{
	protected $fillable = ['items_id', 'name', 'equipment_slot', 'weapon_types_id', 'damage_low', 'damage_high', 'fatigue_use', 'accuracy', 'attack_text', 'required_stat', 'required_amount'];

	public function item()
		{
		return $this->belongsTo('App\Item');
		}
}
