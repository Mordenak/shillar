<?php

namespace App;

use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

// use App\InventoryItems;

class Inventory extends Model
	{
	protected $fillable = ['characters_id'];

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id');
		}

	public function character_direct()
		{
		return $this->belongsTo('App\Character', 'characters_id')->first();
		}

	public function inventory_items()
		{
		return $this->hasMany('App\InventoryItems');
		}

	public function character_items()
		{
		return $this->hasMany('App\InventoryItems')->orderby('id')->get();
		}

	public function unequipped_items()
		{
		// die(print_r($this->hasMany('App\InventoryItems')->whereNotIn('items_id', $this->character()->first()->equipment()->equipment_list())));
		return $this->character_items()->whereNotIn('id', $this->character_direct()->equipment_list());
		}

	public function has_item_property(string $property_name)
		{
		// die('test');
		foreach ($this->inventory_items()->get() as $inventory_item)
			{
			// die(print_r(var_dump($inventory_item)));
			if ($inventory_item->item()->has_property($property_name))
				{
				return true;
				}
			}

		return false;
		}

	public function remove_all()
		{
		$this->inventory_items()->delete();

		return true;
		}

	public function remove_inventory_item($inventory_item_id)
		{
		$has_item = $this->get_inventory_item($inventory_item_id);

		if ($has_item)
			{
			$has_item->quantity = $has_item->quantity - 1;
			// todo: if 0?
			if ($has_item->quantity <= 0)
				{
				$has_item->delete();
				$this->cache_items();
				return true;
				}
			$has_item->save();
			$this->cache_items();
			}
		else
			{
			// error, we don't have the item?
			return false;
			}

		return true;
		}

	public function remove_item($item_id)
		{
		$has_item = $this->get_item($item_id);

		if ($has_item)
			{
			$has_item->quantity = $has_item->quantity - 1;
			// todo: if 0?
			if ($has_item->quantity <= 0)
				{
				$has_item->delete();
				$this->cache_items();
				return true;
				}
			$has_item->save();
			$this->cache_items();
			}
		else
			{
			// error, we don't have the item?
			return false;
			}

		return true;
		}

	public function retrieve_items()
		{
		if (!Cache::get($this->characters_id . '_items'))
			{
			$this->cache_items();
			}
		return Cache::get($this->characters_id . '_items');
		}

	public function cache_items()
		{
		Cache::put($this->characters_id . '_items', $this->character_items());
		$this->get_current_weight();

		return true;
		}

	public function get_inventory_item($inventory_item_id)
		{
		return $this->retrieve_items()->find($inventory_item_id);
		}

	public function has_inventory_item($inventory_item_id)
		{
		return $this->get_inventory_item($inventory_item_id) ? true : false;
		}

	public function get_item($item_id)
		{
		return $this->retrieve_items()->where('items_id', $item_id)->first();
		}

	public function has_item($item_id)
		{
		return $this->get_item($item_id) ? true : false;
		}

	// public function max_weight()
	// 	{
	// 	$inventory_size = $this->character()->first()->stats()['strength'];
	// 	$racial_modifier = $this->character()->first()->race()->modifiers()->where(['racial_modifiers_id' => 1])->first();
	// 	if ($racial_modifier)
	// 		{
	// 		$inventory_size = floor($inventory_size * $racial_modifier->value);
	// 		}

	// 	return $inventory_size;
	// 	}

	public function current_weight()
		{
		if (!Cache::get($this->characters_id . '_weight'))
			{
			$this->get_current_weight();
			}
		return Cache::get($this->characters_id . '_weight');
		}

	/**
	 * This function is expensive!
	 */
	public function get_current_weight()
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

		Cache::put($this->characters_id . '_weight', $total_weight);

		return $total_weight;
		}

	public function add_item($item_id, $quantity = 1)
		{
		$start_timer = microtime(true);
		// Add an items_to_inventories record:;
		$Item = Item::findOrFail($item_id);

		if (($this->current_weight() + $Item->weight) > $this->character_direct()->max_weight())
			{
			return false;
			}

		$has_item = $this->retrieve_items()->where('items_id', $item_id)->first();

		if ($has_item && $Item->is_stackable)
			{
			$has_item->quantity = $has_item->quantity + $quantity;
			$has_item->save();
			}
		else
			{
			$InventoryItems = new InventoryItems;
			$values = [
				'inventory_id' => $this->id,
				'items_id' => $item_id
				];
			if ($Item->is_stackable)
				{
				$values['quantity'] = $quantity;
				}
			$InventoryItems->fill($values);
			$InventoryItems->save();
			}

		$finish_timer = round(microtime(true) - $start_timer, 3) * 1000;
		Session::push('perf_log', ['add_item' => $finish_timer]);

		$this->cache_items();

		return true;
		}
	}
