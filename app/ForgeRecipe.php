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
}
