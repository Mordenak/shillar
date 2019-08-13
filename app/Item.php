<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $fillable = ['name', 'item_types_id'];

	public function type()
		{
		return $this->belongsTo('App\ItemType', 'item_types_id')->first();
		}

	public function actual_item()
		{
		if ($this->type()->name == 'Consumable')
			{
			return ItemConsumable::where(['items_id' => $this->id])->first();
			}

		if ($this->type()->name == 'Weapon')
			{
			return ItemWeapon::where(['items_id' => $this->id])->first();
			}

		if ($this->type()->name == 'Armor')
			{
			return ItemArmor::where(['items_id' => $this->id])->first();
			}

		if ($this->type()->name == 'Accessories')
			{
			return ItemAccessory::where(['items_id' => $this->id])->first();
			}

		if ($this->type()->name == 'Other')
			{
			return ItemOthers::where(['items_id' => $this->id])->first();
			}
		}
}
