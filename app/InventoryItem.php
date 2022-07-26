<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
	{
	protected $fillable = ['inventory_id', 'items_id', 'quantity'];

	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id')->first();
		}

	public function inventory()
		{
		return $this->belongsTo('App\Inventory', 'inventory_id')->first();
		}

	public function properties()
		{
		return $this->hasMany('App\InventoryItemToItemProperty', 'inventory_items_id');
		}

	public function get_property(string $property_name = null)
		{
		$ItemProperty = ItemProperty::where(['name' => $property_name])->first();
		if (!$ItemProperty)
			{
			return false;
			}
		if ($this->properties()->get())
			{
			return $this->properties()->where(['item_properties_id' => $ItemProperty->id])->first();
			}
		return false;
		}

	public function has_property(string $property_name)
		{
		if ($this->properties()->get())
			{
			return $this->get_property($property_name) ? true : false;
			}
		return false;
		}

	public function get_name()
		{
		if ($this->has_property('RENAME_ITEM'))
			{
			return $this->get_property('RENAME_ITEM')->decode()['name'];
			}

		return $this->item()->name;
		}
	}
