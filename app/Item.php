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
		if ($this->item_types_id == 1)
			{
			return ItemWeapon::where(['items_id' => $this->id])->first();
			}

		if ($this->item_types_id == 2)
			{
			return ItemArmor::where(['items_id' => $this->id])->first();
			}

		if ($this->item_types_id == 3)
			{
			return ItemAccessory::where(['items_id' => $this->id])->first();
			}

		if ($this->item_types_id == 4)
			{
			return ItemFood::where(['items_id' => $this->id])->first();
			}

		if ($this->item_types_id == 5)
			{
			return ItemJewel::where(['items_id' => $this->id])->first();
			}

		if ($this->item_types_id == 6)
			{
			return ItemDust::where(['items_id' => $this->id])->first();
			}

		if ($this->item_types_id == 7)
			{
			return ItemOthers::where(['items_id' => $this->id])->first();
			}
		}

	public function get_bonus_stats()
		{
		$arr = [];

		// Must be 2 (armor) or 3 (accessory)
		if ($this->item_types_id == 2 || $this->item_types_id == 3)
			{
			$arr = [
				'light_level' => $this->actual_item()->light_level,
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
