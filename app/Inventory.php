<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = ['characters_id', 'max_size', 'max_weight'];

    public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id');
		}
}
