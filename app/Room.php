<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $fillable = ['zones_id', 'title', 'description', 'north_rooms_id', 'east_rooms_id', 'south_rooms_id', 'west_rooms_id'];

   	public function zone()
   		{
   		return $this->belongsTo('App\Zone', 'zones_id')->first();
   		}
}
