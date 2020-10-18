<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeleportTarget extends Model
	{
	protected $fillable = ['name', 'spells_id', 'rooms_id', 'level_req', 'wisdom_req'];

	public function room()
		{
		return $this->belongsTo('App\Room');
		}

	public function spell()
		{
		return $this->belongsTo('App\Spell', 'spells_id')->first();
		}

	}