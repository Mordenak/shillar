<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $fillable = ['name', 'item_types_id', 'value', 'weight', 'is_stackable'];

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

		if ($this->type()->name == 'Jewel')
			{
			return ItemJewel::where(['items_id' => $this->id])->first();
			}

		if ($this->type()->name == 'Dust')
			{
			return ItemDust::where(['items_id' => $this->id])->first();
			}

		if ($this->type()->name == 'Other')
			{
			return ItemOthers::where(['items_id' => $this->id])->first();
			}
		}

	public function get_bonus_stats()
		{
		$arr = [];

		// Must be 2 (armor) or 3 (accessory)
		if ($this->item_types_id == 2 || $this->items_types_id == 3)
			{
			$arr = [
				'strength' => $this->actual_item()->strength_bonus,
				'dexterity' => $this->actual_item()->dexterity_bonus,
				'constitution' => $this->actual_item()->constitution_bonus,
				'wisdom' => $this->actual_item()->wisdom_bonus,
				'intelligence' => $this->actual_item()->intelligence_bonus,
				'charisma' => $this->actual_item()->charisma_bonus,
				];
			}

		return $arr;
		}
}
