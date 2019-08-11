<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
	protected $fillable = ['name'];

	public function rooms()
		{
		return $this->hasMany('App\Rooms');
		}
}
