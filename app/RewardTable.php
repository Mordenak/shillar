<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardTable extends Model
{
	protected $fillable = ['npcs_id', 'award_xp', 'xp_variation', 'award_gold', 'gold_variation'];

	public function npc()
		{
		return $this->belongsTo('App\Npc', 'npcs_id')->first();
		}
}
