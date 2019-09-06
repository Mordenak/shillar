<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KillCount extends Model
{
	protected $fillable = ['characters_id', 'creatures_id', 'count'];

	public function creature()
		{
		return $this->belongsTo('App\Creature', 'creatures_id')->first();
		}
}
