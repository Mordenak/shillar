<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterSpell extends Model
{
	protected $fillable = ['spells_id', 'characters_id', 'level'];

	public function spell()
		{
		return $this->belongsTo('App\Spell', 'spells_id')->first();
		}
}
