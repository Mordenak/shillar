<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KillCount extends Model
{
	protected $fillable = ['characters_id', 'npcs_id', 'count'];

	public function npc()
		{
		return $this->belongsTo('App\Npc', 'npcs_id')->first();
		}
}
