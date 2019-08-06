<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterStat extends Model
{
    //
    protected $fillable = ['characters_id', 'xp', 'gold', 'health', 'max_health', 'mana', 'max_mana', 'fatigue', 'max_fatigue', 'strength', 'dexterity', 'constitution', 'wisdom', 'intelligence', 'charisma', 'score'];
}
