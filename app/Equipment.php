<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Equipment extends Model
{
	protected $fillable = ['characters_id', 'head', 'chest', 'legs', 'weapon', 'hands', 'feet', 'neck', 'left_ring', 'right_ring', 'amulet', 'bracelet'];

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id');
		}

	public function weapon()
		{
		// Weapon = InventoryItem record, items_id.
		return $this->hasOne('App\InventoryItem', 'id', 'weapon')->first()->item()->actual_item();
		}

	public function remove_all()
		{
		$this->weapon = null;
		$this->shield = null;
		$this->head = null;
		$this->neck = null;
		$this->chest = null;
		$this->legs = null;
		$this->hands = null;
		$this->feet = null;
		$this->amulet = null;
		$this->left_ring = null;
		$this->right_ring = null;
		$this->bracelet = null;

		$this->save();

		$this->refresh_equip();

		return true;
		}

	public function get_all()
		{
		if (!Cache::get($this->characters_id . '_equipment'))
			{
			$this->refresh_equip();
			}
		return Cache::get($this->characters_id . '_equipment');
		}

	public function refresh_equip()
		{
		$arr = [
			$this->weapon,
			$this->shield,
			$this->head,
			$this->neck,
			$this->chest,
			$this->legs,
			$this->hands,
			$this->feet,
			$this->amulet,
			$this->left_ring,
			$this->right_ring,
			$this->bracelet
			];
		Cache::put($this->characters_id . '_equipment', $arr);
		
		return $arr;
		}

	public function calculate_armor()
		{
		$total_armor = 3;

		if ($this->shield)
			{
			$InventoryItem = InventoryItem::findOrFail($this->shield);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		if ($this->head)
			{
			$InventoryItem = InventoryItem::findOrFail($this->head);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		if ($this->neck)
			{
			$InventoryItem = InventoryItem::findOrFail($this->neck);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		if ($this->chest)
			{
			$InventoryItem = InventoryItem::findOrFail($this->chest);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		if ($this->hands)
			{
			$InventoryItem = InventoryItem::findOrFail($this->hands);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		if ($this->legs)
			{
			$InventoryItem = InventoryItem::findOrFail($this->legs);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		if ($this->feet)
			{
			$InventoryItem = InventoryItem::findOrFail($this->feet);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		return $total_armor;
		}

	public function retrieve_stats()
		{
		if (!Cache::get($this->characters_id . '_stats'))
			{
			$this->calculate_stats();
			}
		return Cache::get($this->characters_id . '_stats');
		}

	// TODO: Performance pass!
	public function calculate_stats()
		{
		$bonus_stats = [
			'light_level' => 0,
			'strength' => 0,
			'dexterity' => 0,
			'constitution' => 0,
			'wisdom' => 0,
			'intelligence' => 0,
			'charisma' => 0,
			];

		$slots = ['shield', 'head', 'neck', 'chest', 'hands', 'legs', 'feet', 'amulet', 'left_ring', 'right_ring', 'bracelet'];

		foreach ($slots as $slot)
			{
			if ($this[$slot])
				{
				// die(print_r($this[$slot]));
				$InventoryItem = InventoryItem::findOrFail($this[$slot]);
				// die(print_r($InventoryItem->item()->get_bonus_stats()));
				$bonus = $InventoryItem->item()->get_bonus_stats();
				if ($bonus)
					{
					// die(print_r($bonus));
					foreach ($bonus as $stat => $value)
						{
						$bonus_stats[$stat] = $bonus_stats[$stat] + $value;
						}
					}
				}
			}

		// die(print_r($bonus_stats));
		Cache::put($this->characters_id . '_stats', $bonus_stats);

		return $bonus_stats;
		}
}
