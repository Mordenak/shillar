<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
	protected $fillable = ['characters_id', 'head', 'chest', 'legs', 'weapon', 'hands', 'feet', 'neck', 'left_ring', 'right_ring'];

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id');
		}

	public function weapon()
		{
		// Weapon = InventoryItem record, items_id.
		return $this->hasOne('App\InventoryItem', 'id', 'weapon')->first()->item()->actual_item();
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

	public function calculate_stats()
		{
		$bonus_stats = [];

		if ($this->shield)
			{
			$InventoryItem = InventoryItem::findOrFail($this->shield);
			}

		if ($this->head)
			{
			$InventoryItem = InventoryItem::findOrFail($this->head);
			}

		if ($this->neck)
			{
			$InventoryItem = InventoryItem::findOrFail($this->neck);
			}

		if ($this->chest)
			{
			$InventoryItem = InventoryItem::findOrFail($this->chest);
			}

		if ($this->hands)
			{
			$InventoryItem = InventoryItem::findOrFail($this->hands);
			}

		if ($this->legs)
			{
			$InventoryItem = InventoryItem::findOrFail($this->legs);
			}

		if ($this->feet)
			{
			$InventoryItem = InventoryItem::findOrFail($this->feet);
			}

		if ($this->amulet)
			{
			$InventoryItem = InventoryItem::findOrFail($this->feet);
			$InventoryItem->get_bonus_stats();
			}

		if ($this->left_ring)
			{
			$InventoryItem = InventoryItem::findOrFail($this->feet);
			$InventoryItem->get_bonus_stats();
			}

		if ($this->right_ring)
			{
			$InventoryItem = InventoryItem::findOrFail($this->feet);
			$InventoryItem->get_bonus_stats();
			}

		if ($this->bracelet)
			{
			$InventoryItem = InventoryItem::findOrFail($this->feet);
			$InventoryItem->get_bonus_stats();
			}

		return $bonus_stats;
		}
}
