<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
	protected $fillable = ['name', 'description', 'darkness_level', 'custom_img'];

	public function rooms()
		{
		return $this->hasMany('App\Rooms');
		}
}
