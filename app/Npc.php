<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Npc extends Model
{
	protected $fillable = ['name', 'img_src', 'is_hostile', 'health', 'armor', 'damage_low', 'damage_high', 'attacks_per_round', 'award_xp', 'xp_variation', 'award_gold', 'gold_variation'];

	public function spawn_rules()
		{
		return $this->hasMany('App\SpawnRule', 'npcs_id')->get();
		}

	public function loot_tables()
		{
		return $this->hasMany('App\LootTable', 'npcs_id')->get();
		}
}
