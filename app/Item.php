<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public function type()
    	{
    	return $this->belongsTo('App\ItemType', 'item_types_id');
    	}
}
