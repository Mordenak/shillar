<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpawnRule extends Model
{
	protected $fillable = ['zones_id', 'rooms_id', 'npcs_id', 'chance'];

	public function zone()
		{
		return $this->belongsTo('App\Zone', 'zones_id')->first();
		}

	public function room()
		{
		return $this->belongsTo('App\Room', 'rooms_id')->first();
		}

	public function npc()
		{
		return $this->belongsTo('App\Npc', 'npcs_id')->first();
		}
}
