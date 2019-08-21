<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
	protected $fillable = ['shops_id', 'items_id', 'price', 'markup'];

	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id')->first();
		}
}
