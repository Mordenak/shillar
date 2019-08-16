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
		return $this->hasOne('App\ItemWeapon', 'weapon')->first();
		}

	public function calculate_armor()
		{
		$total_armor = 3;

		if ($this->head)
			{
			$InventoryItem = InventoryItem::findOrFail($this->head);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		if ($this->chest)
			{
			$InventoryItem = InventoryItem::findOrFail($this->chest);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		if ($this->legs)
			{
			$InventoryItem = InventoryItem::findOrFail($this->legs);
			$ItemArmor = $InventoryItem->item()->actual_item();
			$total_armor += $ItemArmor->armor;
			}

		return $total_armor;
		}
}
