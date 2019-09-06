<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardTable extends Model
{
	protected $fillable = ['creatures_id', 'award_xp', 'xp_variation', 'award_gold', 'gold_variation'];

	public function creature()
		{
		return $this->belongsTo('App\Creature', 'creatures_id')->first();
		}
}
