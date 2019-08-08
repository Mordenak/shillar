<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// use App\InventoryItems;

class Inventory extends Model
{
    //
    protected $fillable = ['characters_id', 'max_size', 'max_weight'];

    public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id');
		}

	public function items()
		{
		return $this->hasMany('App\InventoryItems');
		}

	public function addItem($item_id)
		{
		// Add an items_to_inventories record:
		// items_to_inventories
		// ItemsToInventory
		// $ItemsToInventory = ItemsToInventory::where(['inventories_id' => $this->id, 'characters_id' => $this->characters])
		// die($item_id);
		$has_item = $this->items()->where(['items_id' => $item_id])->first();

		if ($has_item)
			{
			// die('we has');
			$has_item->quantity = $has_item->quantity + 1;
			$has_item->save();
			}
		else
			{
			$InventoryItems = new InventoryItems;
			// die('..:'.$this->id);
			$InventoryItems->fill(['inventory_id' => $this->id, 'items_id' => $item_id, 'quantity' => 1]);
			$InventoryItems->save();
			}

		return true;
		}
}
