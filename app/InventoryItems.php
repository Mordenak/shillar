<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryItems extends Model
{
    //
    protected $fillable = ['inventory_id', 'items_id', 'quantity'];

    public function item()
    	{
    	return $this->belongsTo('App\Item');
    	}
}
