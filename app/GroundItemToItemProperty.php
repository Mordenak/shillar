<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroundItemToItemProperty extends Model
{
	protected $fillable = ['ground_items_id', 'item_properties_id', 'data'];

	public function ground_item()
		{
		return $this->belongsTo('App\GroundItem');
		}

	public function property()
		{
		return $this->belongsTo('App\ItemProperty', 'item_properties_id');
		}

	public function get_data()
		{
		// Somehow return data properly for everything?
		// Should there be a common method for this?
		}

	public function show_data()
		{
		return true;
		}

	public function decode()
		{
		return json_decode($this->data, true);
		}
}
