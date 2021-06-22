<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForgeRecipe extends Model
{
	protected $fillable = ['item_weapons_id', 'item_armors_id', 'item_foods_id', 'item_jewels_id', 'item_dusts_id', 'name', 'result_items_id'];

	public function result_item()
		{
		return $this->belongsTo('App\Item', 'result_items_id')->first();
		}

	public function weapon()
		{
		return $this->belongsTo('App\Item', 'item_weapons_id')->first();
		}

	public function armor()
		{
		return $this->belongsTo('App\Item', 'item_armors_id')->first();
		}

	public function food()
		{
		return $this->belongsTo('App\Item', 'item_foods_id')->first();
		}

	public function jewel()
		{
		return $this->belongsTo('App\Item', 'item_jewels_id')->first();
		}

	public function dust()
		{
		return $this->belongsTo('App\Item', 'item_dusts_id')->first();
		}
	
}
