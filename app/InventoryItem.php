<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
	{
	protected $fillable = ['inventory_id', 'items_id', 'quantity'];

	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id')->first();
		}
	}
