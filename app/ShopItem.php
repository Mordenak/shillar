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

	public function shop()
		{
		return $this->belongsTo('App\Shop', 'shops_id')->first();
		}

	public function get_cost($charisma)
		{
		if ($this->price)
			{
			$pre_cost = round($this->price / $charisma, 0);
			}
		else
			{
			$pre_cost = round(($this->item()->value * $this->markup) / $charisma, 0);
			}
		// Things are a minimum of 1:
		$after_cost = $pre_cost > 0 ? $pre_cost : 1;
		return $after_cost;
		}
}
