<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //
	public function rooms()
		{
		return $this->hasMany('App\Rooms');
		}
}
