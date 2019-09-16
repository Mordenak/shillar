<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpawnRule extends Model
{
	protected $fillable = ['zones_id', 'rooms_id', 'creatures_id', 'chance'];

	public function zone()
		{
		return $this->belongsTo('App\Zone', 'zones_id')->first();
		}

	public function room()
		{
		return $this->belongsTo('App\Room', 'rooms_id')->first();
		}

	public function creature()
		{
		return $this->belongsTo('App\Creature', 'creatures_id')->first();
		}

	public function creature_group()
		{
		return $this->belongsTo('App\CreatureGroup', 'creature_groups_id')->first();
		}
}
