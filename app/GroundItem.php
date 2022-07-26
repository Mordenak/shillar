<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroundItem extends Model
	{
	protected $fillable = ['rooms_id', 'characters_id', 'items_id', 'expires_on', 'quantity'];

	public function room()
		{
		return $this->belongsTo('App\Room', 'rooms_id')->first();
		}

	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id')->first();
		}

	public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id')->first();
		}

	public function properties()
		{
		return $this->hasMany('App\GroundItemToItemProperty', 'ground_items_id');
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
