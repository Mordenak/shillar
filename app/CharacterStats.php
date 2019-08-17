<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterStats extends Model
{
	protected $fillable = ['characters_id', 'xp', 'gold', 'health', 'max_health', 'mana', 'max_mana', 'fatigue', 'max_fatigue', 'strength', 'dexterity', 'constitution', 'wisdom', 'intelligence', 'charisma'];

}
