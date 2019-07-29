<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterStats extends Model
{
	//
	protected $fillable = ['characters_id', 'level', 'xp', 'health', 'max_health', 'mana', 'max_mana', 'ward', 'max_ward', 'strength', 'dexterity', 'intelligence', 'vitality', 'guard', 'wisdom', 'brute', 'finesse', 'insight'];
}
