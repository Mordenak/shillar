<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	protected $fillable = ['rooms_id', 'name', 'description', 'buys_weapons', 'buys_armors', 'buys_accessories', 'buys_consumables', 'buys_others'];

	public function room()
		{
		return $this->belongsTo('App\Room')->first();
		}

	public function shop_items()
		{
		return $this->hasMany('App\ShopItem', 'shops_id')->get();
		}
}
