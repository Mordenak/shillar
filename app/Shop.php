<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	protected $fillable = ['rooms_id', 'name', 'description', 'buys_weapons', 'buys_armors', 'buys_accessories', 'buys_jewels', 'buys_dusts', 'buys_consumables', 'buys_others'];

	public function room()
		{
		return $this->belongsTo('App\Room', 'rooms_id')->first();
		}

	public function shop_items()
		{
		return $this->hasMany('App\ShopItem', 'shops_id')->get();
		}

	public function will_buy($item_type_id)
		{
		switch ($item_type_id)
			{
			case 1:
				return $this->buys_weapons ? true : false;
				break;
			case 2:
				return $this->buys_armors ? true : false;
				break;
			case 3:
				return $this->buys_accessories ? true : false;
				break;
			case 4:
				return $this->buys_jewels ? true : false;
				break;
			case 5:
				return $this->buys_dusts ? true : false;
				break;
			case 6:
				return $this->buys_consumables ? true : false;
				break;
			case 7:
				return $this->buys_others ? true : false;
				break;
			}
		return false;
		}
}
