<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreatureToCreatureGroup extends Model
	{
	// protected $table = 'creature_to_creature_groups';

	protected $fillable = ['creatures_id', 'creature_groups_id', 'weight'];

	public function creature()
		{
		return $this->belongsTo('App\Creature', 'creatures_id')->first();
		}

	public function creature_group()
		{
		return $this->belongsTo('App\CreatureGroup')->first();
		}
	}
