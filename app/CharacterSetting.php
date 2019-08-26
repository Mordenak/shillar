<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterSetting extends Model
{
	protected $fillable = ['characters_id', 'refresh_rate', 'brief_mode', 'life_gauge', 'mana_gauge', 'fatigue_gauge', 'food_sort', 'number_commas', 'creature_images'];
}