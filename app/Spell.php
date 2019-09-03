<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spell extends Model
	{
	protected $fillable = ['name', 'description', 'formula', 'duration'];

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
	}