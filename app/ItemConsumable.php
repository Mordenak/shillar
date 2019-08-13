<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemConsumable extends Model
{
	protected $fillable = ['items_id', 'name', 'effect', 'potency'];

	public function item()
		{
		return $this->belongsTo('App\Item');
		}
}
