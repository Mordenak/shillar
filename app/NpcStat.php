<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NpcStat extends Model
{
	protected $fillable = ['npcs_id', 'health', 'armor', 'damage_low', 'damage_high', 'attacks_per_round'];

	public function npc()
		{
		return $this->belongsTo('App\Npc', 'npcs_id')->first();
		}
}
