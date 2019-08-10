<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LootTable extends Model
{
    //
	public function item()
		{
		return $this->belongsTo('App\Item', 'items_id');
		}
}
