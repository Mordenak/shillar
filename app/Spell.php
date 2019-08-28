<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spell extends Model
{
	protected $fillable = ['name', 'training_cost', 'description', 'formula', 'duration'];

	public function property()
		{
		return $this->belongsTo('App\SpellProperty', 'spells_id')->first();
		}

	public function has_property(string $property_uid = null)
		{
		if ($this->spell_properties_id)
			{
			if (!$property_uid)
				{
				return true;
				}
			return $this->property()->uid == $property_uid ? true : false;
			}
		return false;
		}
}