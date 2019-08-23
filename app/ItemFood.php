<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemFood extends Model
{
	protected $fillable = ['items_id', 'name', 'potency'];

	public function item()
		{
		return $this->belongsTo('App\Item');
		}
}
