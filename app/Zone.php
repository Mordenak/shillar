<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
	protected $fillable = ['name', 'description', 'darkness_level', 'img_src'];

	public function rooms()
		{
		return $this->hasMany('App\Room', 'zones_id')->get();
		}
}
