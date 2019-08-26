<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
	protected $fillable = ['rooms_id', 'name', 'description', 'trades_weapons', 'trades_armors', 'trades_accessories', 'trades_jewels', 'trades_dusts', 'trades_consumables', 'trades_others'];

	public function room()
		{
		return $this->belongsTo('App\Room', 'rooms_id')->first();
		}

	public function trader_items()
		{
		return $this->hasMany('App\TraderItem', 'traders_id');
		}

	public function will_trade($item_type_id)
		{
		switch ($item_type_id)
			{
			case 1:
				return $this->trades_weapons ? true : false;
				break;
			case 2:
				return $this->trades_armors ? true : false;
				break;
			case 3:
				return $this->trades_accessories ? true : false;
				break;
			case 4:
				return $this->trades_jewels ? true : false;
				break;
			case 5:
				return $this->trades_dusts ? true : false;
				break;
			case 6:
				return $this->trades_consumables ? true : false;
				break;
			case 7:
				return $this->trades_others ? true : false;
				break;
			}
		return false;
		}
}
