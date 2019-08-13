<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAccessory extends Model
{
	protected $fillable = ['items_id', 'name', 'equipment_slot', 'armor'];

	public function item()
		{
		return $this->belongsTo('App\Item');
		}
}
