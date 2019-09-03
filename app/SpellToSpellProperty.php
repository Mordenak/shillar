<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpellToSpellProperty extends Model
	{
	// protected $table = 'zone_properties';

	protected $fillable = ['spell_properties_id', 'spells_id', 'data'];

	public function spell()
		{
		return $this->belongsTo('App\Spell');
		}

	public function property()
		{
		return $this->belongsTo('App\SpellProperty', 'spell_properties_id');
		}

	public function get_data()
		{
		// Somehow return data properly for everything?
		// Should there be a common method for this?
		}

	public function show_data()
		{
		return true;
		}

	public function decode()
		{
		return json_decode($this->data, true);
		}
	}
