<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartingStat extends Model
	{
	protected $fillable = ['races_id', 'strength', 'dexterity', 'constitution', 'wisdom', 'intelligence', 'charisma'];

	public function race()
		{
		return $this->belongsTo('App\Race');
		}
	}