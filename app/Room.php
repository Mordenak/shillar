<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
   	public function zone()
   		{
   		return $this->belongsTo('App\Zone', 'zones_id');
   		}
}
