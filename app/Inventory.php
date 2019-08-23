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

	public function removeItem($item_id)
		{
		$has_item = $this->inventory_items()->where(['items_id' => $item_id])->first();

		if ($has_item)
			{
			$has_item->quantity = $has_item->quantity - 1;
			// todo: if 0?
			if ($has_item->quantity <= 0)
				{
				$has_item->delete();
				return true;
				}
			$has_item->save();
			}
		else
			{
			// error, we don't have the item?
			return false;
			}

		return true;
		}

	public function currentWeight()
		{
		$total_weight = 0.0;
		foreach ($this->character_items() as $inv_item)
			{
			if ($inv_item->quantity > 1)
				{
				$total_weight += $inv_item->item()->weight * $inv_item->quantity;
				}
			else
				{
				$total_weight += $inv_item->item()->weight;
				}
			}
		return $total_weight;
		}

	public function addItem($item_id)
		{
		// Add an items_to_inventories record:;
		$Item = Item::findOrFail($item_id);

		if (($this->currentWeight() + $Item->weight) > $this->max_weight)
			{
			return false;
			}

		$has_item = $this->inventory_items()->where(['items_id' => $item_id])->first();

		if ($has_item && $Item->is_stackable)
			{
			$has_item->quantity = $has_item->quantity + 1;
			$has_item->save();
			}
		else
			{
			$InventoryItems = new InventoryItems;
			// die('..:'.$this->id);
			$InventoryItems->fill(['inventory_id' => $this->id, 'items_id' => $item_id]);
			$InventoryItems->save();
			}

		return true;
		}
}
