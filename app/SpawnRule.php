<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpawnRule extends Model
{
	protected $fillable = ['zones_id', 'zone_areas_id', 'zone_level', 'rooms_id', 'creature_groups_id', 'creatures_id', 'chance', 'score_req'];

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
