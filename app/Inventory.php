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

	public function inventory_items()
		{
		return $this->hasMany('App\InventoryItems');
		}

	public function character_items()
		{
		return $this->hasMany('App\InventoryItems')->get();
		}

	public function grouped_items()
		{
		// TODO:
		return true;
		}

	public function removeItem($item_id)
		{
		$has_item = $this->inventory_items()->where(['items_id' => $item_id])->first();

		if ($has_item)
			{
			$has_item->delete();
			}
		else
			{
			// error, we don't have the item?
			return false;
			}

		return true;
		}

	public function addItem($item_id)
		{
		// Add an items_to_inventories record:;
		$has_item = $this->inventory_items()->where(['items_id' => $item_id])->first();

		$InventoryItems = new InventoryItems;
		// die('..:'.$this->id);
		$InventoryItems->fill(['inventory_id' => $this->id, 'items_id' => $item_id, 'quantity' => 1]);
		$InventoryItems->save();

		return true;
		}
}
