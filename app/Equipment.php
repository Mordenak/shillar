<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
    protected $fillable = ['characters_id', 'head', 'chest', 'legs', 'weapon'];

    public function character()
		{
		return $this->belongsTo('App\Character', 'characters_id');
		}
}
