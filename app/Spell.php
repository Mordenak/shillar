<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spell extends Model
	{
	protected $fillable = ['name', 'description', 'display_text', 'rooms_id', 'is_combat', 'base_training_value'];

	public function properties()
		{
		return $this->hasMany('App\SpellToSpellProperty', 'spells_id');
		}

	public function type()
		{
		return $this->belongsTo('App\SpellType', 'spell_types_id')->first();
		}

	public function is_type(string $type_name = null)
		{
		if ($this->spell_types_id)
			{
			if (!$type_name)
				{
				return true;
				}
			return $this->type()->name == $type_name ? true : false;
			}
		return false;
		}

	public function get_property(string $property_name = null)
		{
		$SpellProperty = SpellProperty::where(['name' => $property_name])->first();
		if (!$SpellProperty)
			{
			return false;
			}
		if ($this->properties()->get())
			{
			return $this->properties()->where(['spell_properties_id' => $SpellProperty->id])->first();
			}
		return false;
		}

	public function has_property(string $property_name )
		{
		if ($this->properties()->get())
			{
			return $this->get_property($property_name) ? true : false;
			}
		return false;
		}
	}