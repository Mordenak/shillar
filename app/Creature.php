<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
	protected $fillable = ['name', 'img_src', 'is_hostile', 'is_blocking', 'health', 'armor', 'damage_low', 'damage_high', 'attacks_per_round', 'magic_resistance', 'scroll_resistance', 'alignments_id', 'alignment_strength', 'award_xp', 'xp_variation', 'award_gold', 'gold_variation'];

	public function spawn_rules()
		{
		return $this->hasMany('App\SpawnRule', 'creatures_id')->get();
		}

	public function loot_tables()
		{
		return $this->hasMany('App\LootTable', 'creatures_id')->get();
		}
}
