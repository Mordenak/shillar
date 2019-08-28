<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpellPropertySpell extends Model
{
	protected $fillable = ['spells_id', 'spell_property_id'];

	public function property()
		{
		return $this->belongsTo('App\SpellProperty', 'spell_property_id')->first();
		}
}	