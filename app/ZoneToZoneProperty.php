<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneToZoneProperty extends Model
	{
	// protected $table = 'zone_properties';

	protected $fillable = [];

	public function zone()
		{
		return $this->belongsTo('App\Zone');
		}

	public function property()
		{
		return $this->belongsTo('App\ZoneProperty', 'zone_properties_id');
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

	// TODO: This is going to be a mess, find an elegant solution
	public function decode()
		{
		return json_decode($this->data, true);
		// $bits = explode('|', $this->data);
		// if ($this->property()->first()->name === 'STAT_RESTRICTION')
		// 	{
		// 	return [$bits[0] => $bits[1]];
		// 	}
		// elseif ($this->property()->first()->name === 'ITEM_RESTRICTION')
		// 	{
		// 	return [$bits[0] => $bits[1]];
		// 	}
		// elseif ($this->property()->first()->name === 'HOSTILE_PER_CREATURE_KILL')
		// 	{
		// 	return ['creature_id' => $bits[0], 'stat' => $bits[1], 'multiplier' => $bits[2]];
		// 	}
		// elseif ($this->property()->first()->name === 'HEAT_DAMAGE')
		// 	{
		// 	return ['damage' => $bits[0], 'begin' => $bits[1], 'end' => $bits[2]];
		// 	}
		// elseif ($this->property()->first()->name === 'COLD_DAMAGE')
		// 	{
		// 	return [$bits[0] => $bits[1]];
		// 	}
		}
	}
